import PyPDF2
import pdfplumber
import logging
import re
import os
from typing import Optional, List
from config import Config

class PDFExtractor:
    """PDF text extractor with support for large files"""
    
    def __init__(self):
        self.config = Config
        self.logger = logging.getLogger(__name__)
    
    def extract_text(self, pdf_path: str) -> Optional[str]:
        """Extract text from PDF file"""
        try:
            # Check if file exists
            full_path = os.path.join(self.config.PDF_STORAGE_PATH, pdf_path)
            if not os.path.exists(full_path):
                self.logger.error(f"PDF file not found: {full_path}")
                return None
            
            # Try pdfplumber first (better for complex layouts)
            text = self._extract_with_pdfplumber(full_path)
            
            # Fallback to PyPDF2 if pdfplumber fails
            if not text or len(text.strip()) < 100:
                self.logger.info(f"Falling back to PyPDF2 for {pdf_path}")
                text = self._extract_with_pypdf2(full_path)
            
            if text:
                # Clean and normalize text
                cleaned_text = self._clean_text(text)
                self.logger.info(f"Extracted {len(cleaned_text)} characters from {pdf_path}")
                return cleaned_text
            else:
                self.logger.error(f"No text extracted from {pdf_path}")
                return None
                
        except Exception as e:
            self.logger.error(f"Error extracting text from {pdf_path}: {str(e)}")
            return None
    
    def _extract_with_pdfplumber(self, pdf_path: str) -> Optional[str]:
        """Extract text using pdfplumber"""
        try:
            text_parts = []
            
            with pdfplumber.open(pdf_path) as pdf:
                for page_num, page in enumerate(pdf.pages):
                    try:
                        page_text = page.extract_text()
                        if page_text:
                            text_parts.append(page_text)
                        
                        # Log progress for large files
                        if (page_num + 1) % 10 == 0:
                            self.logger.info(f"Processed {page_num + 1} pages from {os.path.basename(pdf_path)}")
                            
                    except Exception as e:
                        self.logger.warning(f"Error extracting page {page_num + 1}: {str(e)}")
                        continue
            
            return '\n'.join(text_parts) if text_parts else None
            
        except Exception as e:
            self.logger.error(f"Error with pdfplumber: {str(e)}")
            return None
    
    def _extract_with_pypdf2(self, pdf_path: str) -> Optional[str]:
        """Extract text using PyPDF2"""
        try:
            text_parts = []
            
            with open(pdf_path, 'rb') as file:
                pdf_reader = PyPDF2.PdfReader(file)
                
                for page_num, page in enumerate(pdf_reader.pages):
                    try:
                        page_text = page.extract_text()
                        if page_text:
                            text_parts.append(page_text)
                        
                        # Log progress for large files
                        if (page_num + 1) % 10 == 0:
                            self.logger.info(f"Processed {page_num + 1} pages from {os.path.basename(pdf_path)}")
                            
                    except Exception as e:
                        self.logger.warning(f"Error extracting page {page_num + 1}: {str(e)}")
                        continue
            
            return '\n'.join(text_parts) if text_parts else None
            
        except Exception as e:
            self.logger.error(f"Error with PyPDF2: {str(e)}")
            return None
    
    def _clean_text(self, text: str) -> str:
        """Clean and normalize extracted text"""
        if not text:
            return ""
        
        # Remove excessive whitespace
        text = re.sub(r'\s+', ' ', text)
        
        # Remove page numbers and headers/footers
        text = re.sub(r'^\d+\s*$', '', text, flags=re.MULTILINE)
        
        # Remove common PDF artifacts
        text = re.sub(r'[^\w\s\.\,\;\:\!\?\(\)\[\]\{\}\-\+\=\*\/\@\#\$\%\&\|\<\>\~\`\'\"]', '', text)
        
        # Normalize line breaks
        text = re.sub(r'\n\s*\n', '\n\n', text)
        
        # Remove leading/trailing whitespace
        text = text.strip()
        
        return text
    
    def get_text_statistics(self, text: str) -> dict:
        """Get statistics about extracted text"""
        if not text:
            return {
                'char_count': 0,
                'word_count': 0,
                'sentence_count': 0,
                'paragraph_count': 0
            }
        
        # Character count
        char_count = len(text)
        
        # Word count
        words = text.split()
        word_count = len(words)
        
        # Sentence count (approximate)
        sentences = re.split(r'[.!?]+', text)
        sentence_count = len([s for s in sentences if s.strip()])
        
        # Paragraph count
        paragraphs = text.split('\n\n')
        paragraph_count = len([p for p in paragraphs if p.strip()])
        
        return {
            'char_count': char_count,
            'word_count': word_count,
            'sentence_count': sentence_count,
            'paragraph_count': paragraph_count
        }
    
    def estimate_processing_time(self, text_length: int) -> int:
        """Estimate processing time in seconds based on text length"""
        # Rough estimation: 1 second per 1000 characters
        base_time = text_length / 1000
        
        # Add overhead for TTS processing
        tts_overhead = text_length / 500  # 2 seconds per 1000 characters for TTS
        
        return int(base_time + tts_overhead) 