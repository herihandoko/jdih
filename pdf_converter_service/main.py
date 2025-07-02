#!/usr/bin/env python3
"""
PDF to MP3 Conversion Service
Main service script for converting PDF documents to MP3 audio files
"""

import os
import sys
import time
import logging
import shutil
from datetime import datetime
from typing import Optional

# Add current directory to path
sys.path.append(os.path.dirname(os.path.abspath(__file__)))

from config import Config
from database import DatabaseManager
from pdf_extractor import PDFExtractor
from tts_service import TTSService

class PDFToMP3Service:
    """Main service class for PDF to MP3 conversion"""
    
    def __init__(self):
        self.config = Config
        self.db = DatabaseManager()
        self.pdf_extractor = PDFExtractor()
        self.tts_service = TTSService()
        self.logger = logging.getLogger(__name__)
        
        # Validate configuration
        try:
            self.config.validate()
        except ValueError as e:
            self.logger.error(f"Configuration error: {e}")
            sys.exit(1)
        
        # Ensure directories exist
        self._ensure_directories()
    
    def _ensure_directories(self):
        """Ensure required directories exist"""
        directories = [
            self.config.PDF_STORAGE_PATH,
            self.config.MP3_STORAGE_PATH,
            self.config.TEMP_STORAGE_PATH,
            os.path.dirname(self.config.LOG_FILE)
        ]
        
        for directory in directories:
            os.makedirs(directory, exist_ok=True)
    
    def run(self):
        """Main service loop"""
        self.logger.info("Starting PDF to MP3 conversion service")
        
        try:
            while True:
                # Check if service is enabled
                if not self.config.ENABLED:
                    self.logger.info("Service is disabled, exiting")
                    break
                
                # Process queue
                self._process_queue()
                
                # Add new documents to queue
                self._add_documents_to_queue()
                
                # Cleanup
                self._cleanup()
                
                # Wait before next iteration (1 hour delay for cost optimization)
                self.logger.info("Waiting for next processing cycle (1 hour delay)...")
                time.sleep(self.config.BATCH_DELAY)
                
        except KeyboardInterrupt:
            self.logger.info("Service stopped by user")
        except Exception as e:
            self.logger.error(f"Service error: {str(e)}")
        finally:
            self._cleanup()
            self.db.close_connection()
    
    def _add_documents_to_queue(self):
        """Add new PDF documents to conversion queue"""
        try:
            documents = self.db.get_pdf_documents_for_conversion()
            
            if not documents:
                self.logger.info("No new documents to add to queue")
                return
            
            added_count = 0
            for document in documents:
                if self.db.add_to_queue(document):
                    added_count += 1
            
            self.logger.info(f"Added {added_count} documents to queue")
            
        except Exception as e:
            self.logger.error(f"Error adding documents to queue: {str(e)}")
    
    def _process_queue(self):
        """Process items in the conversion queue - 1 file per hour"""
        try:
            # Get queue statistics
            stats = self.db.get_queue_stats()
            self.logger.info(f"Queue status: {stats}")
            
            # Process items (limited to 1 file per batch for cost optimization)
            processed_count = 0
            while processed_count < self.config.BATCH_SIZE:
                queue_item = self.db.get_queue_item()
                
                if not queue_item:
                    self.logger.info("No items in queue to process")
                    break
                
                self.logger.info(f"Processing queue item {queue_item['id']}: {queue_item['judul_peraturan']}")
                
                if self._process_single_item(queue_item):
                    processed_count += 1
                else:
                    # Mark as failed and continue
                    self.db.update_queue_status(
                        queue_item['id'], 
                        'failed', 
                        retry_count=queue_item.get('retry_count', 0) + 1,
                        error_message="Processing failed"
                    )
                
                # Small delay between items
                time.sleep(1)
            
            if processed_count > 0:
                self.logger.info(f"Processed {processed_count} items from queue")
                
        except Exception as e:
            self.logger.error(f"Error processing queue: {str(e)}")
    
    def _process_single_item(self, queue_item: dict) -> bool:
        """Process a single queue item"""
        try:
            # Update status to processing
            self.db.update_queue_status(queue_item['id'], 'processing')
            
            # Extract text from PDF
            self.logger.info(f"Extracting text from {queue_item['pdf_filename']}")
            text = self.pdf_extractor.extract_text(queue_item['pdf_filename'])
            
            if not text:
                self.logger.error(f"Failed to extract text from {queue_item['pdf_filename']}")
                return False
            
            # Get text statistics
            stats = self.pdf_extractor.get_text_statistics(text)
            self.logger.info(f"Text statistics: {stats}")
            
            # Update queue with text content
            self.db.update_queue_status(
                queue_item['id'],
                'processing',
                text_content=text,
                text_length=stats['char_count'],
                chunk_count=len(text) // self.config.OPENAI_MAX_CHARS_PER_REQUEST + 1
            )
            
            # Convert text to speech
            self.logger.info("Converting text to speech")
            voice_settings = {
                'language': queue_item.get('bahasa', 'id'),
                'voice': 'alloy'
            }
            
            audio_file = self.tts_service.convert_text_to_speech(text, voice_settings)
            
            if not audio_file:
                self.logger.error("Failed to convert text to speech")
                return False
            
            # Move audio file to final location
            mp3_filename = self._save_audio_file(audio_file, queue_item['produk_hukum_id'])
            
            if not mp3_filename:
                self.logger.error("Failed to save audio file")
                return False
            
            # Save text content as text file (optional)
            text_filename = None
            if self.config.SAVE_TEXT_FILE:
                text_filename = self._save_text_file(text, queue_item['produk_hukum_id'])
                
                if not text_filename:
                    self.logger.error("Failed to save text file")
                    return False
            
            # Update database
            self.db.update_queue_status(
                queue_item['id'],
                'completed',
                mp3_filename=mp3_filename,
                tts_provider='openai'
            )
            
            # Update database with text content (optional)
            text_to_save = text if self.config.SAVE_TEXT_CONTENT else None
            self.db.update_produk_hukum_audio(queue_item['produk_hukum_id'], mp3_filename, text_to_save)
            
            self.logger.info(f"Successfully converted {queue_item['judul_peraturan']} to MP3")
            return True
            
        except Exception as e:
            self.logger.error(f"Error processing item {queue_item['id']}: {str(e)}")
            return False
    
    def _save_audio_file(self, temp_audio_file: str, produk_hukum_id: int) -> Optional[str]:
        """Save audio file to final location"""
        try:
            # Generate filename
            timestamp = int(time.time())
            mp3_filename = f"peraturan_{produk_hukum_id}_{timestamp}.mp3"
            
            # Full path
            mp3_path = os.path.join(self.config.MP3_STORAGE_PATH, mp3_filename)
            
            # Move file
            shutil.move(temp_audio_file, mp3_path)
            
            self.logger.info(f"Saved audio file: {mp3_filename}")
            return mp3_filename
            
        except Exception as e:
            self.logger.error(f"Error saving audio file: {str(e)}")
            return None
    
    def _save_text_file(self, text_content: str, produk_hukum_id: int) -> Optional[str]:
        """Save extracted text content as text file"""
        try:
            # Create text storage directory if not exists
            text_storage_path = os.path.join(self.config.MP3_STORAGE_PATH, 'text')
            os.makedirs(text_storage_path, exist_ok=True)
            
            # Generate filename
            timestamp = int(time.time())
            text_filename = f"peraturan_{produk_hukum_id}_{timestamp}.txt"
            
            # Full path
            text_path = os.path.join(text_storage_path, text_filename)
            
            # Save text file
            with open(text_path, 'w', encoding='utf-8') as f:
                f.write(text_content)
            
            self.logger.info(f"Saved text file: {text_filename}")
            return text_filename
            
        except Exception as e:
            self.logger.error(f"Error saving text file: {str(e)}")
            return None
    
    def _cleanup(self):
        """Cleanup temporary files and failed items"""
        try:
            # Cleanup temporary files
            self.tts_service.cleanup_temp_files()
            
            # Cleanup failed items that exceeded retry limit
            deleted_count = self.db.cleanup_failed_items(self.config.MAX_RETRIES)
            if deleted_count > 0:
                self.logger.info(f"Cleaned up {deleted_count} failed items")
                
        except Exception as e:
            self.logger.error(f"Error during cleanup: {str(e)}")

def main():
    """Main entry point"""
    service = PDFToMP3Service()
    service.run()

if __name__ == "__main__":
    main() 