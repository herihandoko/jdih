import mysql.connector
import logging
from datetime import datetime
from typing import List, Dict, Optional
from config import Config

class DatabaseManager:
    """Database manager for PDF to MP3 conversion service"""
    
    def __init__(self):
        self.config = Config
        self.connection = None
        self.setup_logging()
    
    def setup_logging(self):
        """Setup logging"""
        logging.basicConfig(
            level=getattr(logging, self.config.LOG_LEVEL),
            format='%(asctime)s - %(name)s - %(levelname)s - %(message)s',
            handlers=[
                logging.FileHandler(self.config.LOG_FILE),
                logging.StreamHandler()
            ]
        )
        self.logger = logging.getLogger(__name__)
    
    def get_connection(self):
        """Get database connection"""
        if self.connection is None or not self.connection.is_connected():
            self.connection = mysql.connector.connect(
                host=self.config.DB_HOST,
                database=self.config.DB_DATABASE,
                user=self.config.DB_USERNAME,
                password=self.config.DB_PASSWORD,
                port=self.config.DB_PORT,
                autocommit=True
            )
        return self.connection
    
    def close_connection(self):
        """Close database connection"""
        if self.connection and self.connection.is_connected():
            self.connection.close()
            self.connection = None
    
    def get_pdf_documents_for_conversion(self) -> List[Dict]:
        """Get PDF documents that need conversion"""
        conn = self.get_connection()
        cursor = conn.cursor(dictionary=True)
        
        try:
            # Get latest year
            cursor.execute("""
                SELECT MAX(thn_peraturan) as latest_year 
                FROM produk_hukum_lists 
                WHERE thn_peraturan IS NOT NULL AND thn_peraturan != ''
            """)
            result = cursor.fetchone()
            latest_year = result['latest_year'] if result else None
            
            if not latest_year:
                self.logger.info("No regulation year found")
                return []
            
            # Get documents that need conversion
            query = """
            SELECT 
                id,
                judul_peraturan,
                file_peraturan,
                thn_peraturan,
                bahasa,
                created_at,
                status_tts,
                mp3_path,
                conversion_status,
                is_publish,
                is_deleted
            FROM produk_hukum_lists 
            WHERE thn_peraturan = %s
            AND file_peraturan IS NOT NULL 
            AND file_peraturan != ''
            AND (status_tts = 0 OR status_tts IS NULL)
            AND is_deleted = 0
            AND is_publish = 1
            ORDER BY created_at DESC
            LIMIT %s
            """
            
            cursor.execute(query, (latest_year, self.config.BATCH_SIZE))
            documents = cursor.fetchall()
            
            self.logger.info(f"Found {len(documents)} documents for conversion from year {latest_year}")
            return documents
            
        except Exception as e:
            self.logger.error(f"Error getting PDF documents: {str(e)}")
            return []
        finally:
            cursor.close()
    
    def add_to_queue(self, document: Dict) -> bool:
        """Add document to conversion queue"""
        conn = self.get_connection()
        cursor = conn.cursor()
        
        try:
            # Check if already in queue
            cursor.execute("""
                SELECT id FROM pdf_conversion_queue 
                WHERE produk_hukum_id = %s AND status IN ('pending', 'processing')
            """, (document['id'],))
            
            if cursor.fetchone():
                self.logger.info(f"Document {document['id']} already in queue")
                return False
            
            # Add to queue
            cursor.execute("""
                INSERT INTO pdf_conversion_queue 
                (produk_hukum_id, pdf_filename, judul_peraturan, priority, created_at)
                VALUES (%s, %s, %s, %s, %s)
            """, (
                document['id'],
                document['file_peraturan'],
                document['judul_peraturan'],
                2,  # Normal priority
                datetime.now()
            ))
            
            conn.commit()
            self.logger.info(f"Added document {document['id']} to queue")
            return True
            
        except Exception as e:
            self.logger.error(f"Error adding to queue: {str(e)}")
            return False
        finally:
            cursor.close()
    
    def get_queue_item(self) -> Optional[Dict]:
        """Get next item from queue"""
        conn = self.get_connection()
        cursor = conn.cursor(dictionary=True)
        
        try:
            cursor.execute("""
                SELECT 
                    q.*,
                    p.judul_peraturan,
                    p.file_peraturan,
                    p.thn_peraturan,
                    p.bahasa
                FROM pdf_conversion_queue q
                JOIN produk_hukum_lists p ON q.produk_hukum_id = p.id
                WHERE q.status = 'pending'
                ORDER BY q.priority ASC, q.created_at ASC
                LIMIT 1
            """)
            
            return cursor.fetchone()
            
        except Exception as e:
            self.logger.error(f"Error getting queue item: {str(e)}")
            return None
        finally:
            cursor.close()
    
    def update_queue_status(self, queue_id: int, status: str, **kwargs) -> bool:
        """Update queue item status"""
        conn = self.get_connection()
        cursor = conn.cursor()
        
        try:
            update_fields = ['status = %s']
            values = [status]
            
            if status == 'processing':
                update_fields.append('started_at = %s')
                values.append(datetime.now())
            elif status == 'completed':
                update_fields.append('completed_at = %s')
                values.append(datetime.now())
            
            # Add additional fields
            for key, value in kwargs.items():
                update_fields.append(f'{key} = %s')
                values.append(value)
            
            values.append(queue_id)
            
            query = f"""
                UPDATE pdf_conversion_queue 
                SET {', '.join(update_fields)}
                WHERE id = %s
            """
            
            cursor.execute(query, values)
            conn.commit()
            return True
            
        except Exception as e:
            self.logger.error(f"Error updating queue status: {str(e)}")
            return False
        finally:
            cursor.close()
    
    def update_produk_hukum_audio(self, produk_hukum_id: int, mp3_filename: str, text_content: str = None) -> bool:
        """Update produk_hukum_lists with MP3 file and text content"""
        conn = self.get_connection()
        cursor = conn.cursor()
        
        try:
            if text_content:
                # Update with both MP3 and text content
                cursor.execute("""
                    UPDATE produk_hukum_lists 
                    SET status_tts = 1, mp3_path = %s, conversion_status = 'completed', 
                        text_content = %s, text_length = %s
                    WHERE id = %s
                """, (mp3_filename, text_content, len(text_content), produk_hukum_id))
            else:
                # Update with MP3 only
                cursor.execute("""
                    UPDATE produk_hukum_lists 
                    SET status_tts = 1, mp3_path = %s, conversion_status = 'completed'
                    WHERE id = %s
                """, (mp3_filename, produk_hukum_id))
            
            conn.commit()
            self.logger.info(f"Updated produk_hukum_lists {produk_hukum_id} with MP3: {mp3_filename}")
            return True
            
        except Exception as e:
            self.logger.error(f"Error updating produk_hukum_lists: {str(e)}")
            return False
        finally:
            cursor.close()
    
    def get_queue_stats(self) -> Dict:
        """Get queue statistics"""
        conn = self.get_connection()
        cursor = conn.cursor(dictionary=True)
        
        try:
            cursor.execute("""
                SELECT 
                    status,
                    COUNT(*) as count
                FROM pdf_conversion_queue 
                GROUP BY status
            """)
            
            stats = {}
            for row in cursor.fetchall():
                stats[row['status']] = row['count']
            
            return stats
            
        except Exception as e:
            self.logger.error(f"Error getting queue stats: {str(e)}")
            return {}
        finally:
            cursor.close()
    
    def cleanup_failed_items(self, max_retries: int = 3) -> int:
        """Cleanup failed items that exceeded max retries"""
        conn = self.get_connection()
        cursor = conn.cursor()
        
        try:
            cursor.execute("""
                DELETE FROM pdf_conversion_queue 
                WHERE status = 'failed' AND retry_count >= %s
            """, (max_retries,))
            
            deleted_count = cursor.rowcount
            conn.commit()
            
            if deleted_count > 0:
                self.logger.info(f"Cleaned up {deleted_count} failed items")
            
            return deleted_count
            
        except Exception as e:
            self.logger.error(f"Error cleaning up failed items: {str(e)}")
            return 0
        finally:
            cursor.close() 