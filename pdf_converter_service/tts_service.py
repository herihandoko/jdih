import openai
import logging
import time
import os
import tempfile
from typing import List, Optional, Dict
from config import Config

class TTSService:
    """Text-to-Speech service with OpenAI and fallback providers"""
    
    def __init__(self):
        self.config = Config
        self.logger = logging.getLogger(__name__)
        
        # Initialize OpenAI
        if self.config.OPENAI_API_KEY:
            openai.api_key = self.config.OPENAI_API_KEY
        
        # Rate limiting counters
        self.request_count = 0
        self.last_request_time = 0
        self.daily_char_count = 0
        self.last_reset_date = time.strftime('%Y-%m-%d')
    
    def convert_text_to_speech(self, text: str, voice_settings: Dict = None) -> Optional[str]:
        """Convert text to speech with automatic chunking and provider rotation"""
        try:
            if not text or len(text.strip()) == 0:
                self.logger.warning("Empty text provided for TTS conversion")
                return None
            
            # Reset daily counter if new day
            self._reset_daily_counter()
            
            # Chunk text if too long
            chunks = self._chunk_text(text)
            self.logger.info(f"Split text into {len(chunks)} chunks")
            
            # Convert each chunk
            audio_files = []
            for i, chunk in enumerate(chunks):
                self.logger.info(f"Processing chunk {i+1}/{len(chunks)} ({len(chunk)} characters)")
                
                # Rate limiting
                self._rate_limit()
                
                # Try OpenAI first
                audio_file = self._convert_with_openai(chunk, voice_settings)
                
                # Fallback to other providers if OpenAI fails
                if not audio_file and self.config.GOOGLE_TTS_ENABLED:
                    audio_file = self._convert_with_google(chunk, voice_settings)
                
                if audio_file:
                    audio_files.append(audio_file)
                    self.daily_char_count += len(chunk)
                else:
                    self.logger.error(f"Failed to convert chunk {i+1}")
                    return None
                
                # Small delay between chunks
                if i < len(chunks) - 1:
                    time.sleep(self.config.AUDIO_CHUNK_DELAY)
            
            # Merge audio files if multiple chunks
            if len(audio_files) == 1:
                return audio_files[0]
            else:
                return self._merge_audio_files(audio_files)
                
        except Exception as e:
            self.logger.error(f"Error in text-to-speech conversion: {str(e)}")
            return None
    
    def _chunk_text(self, text: str) -> List[str]:
        """Split text into chunks based on provider limits"""
        max_chars = self.config.OPENAI_MAX_CHARS_PER_REQUEST
        
        # Split by sentences first
        sentences = self._split_into_sentences(text)
        chunks = []
        current_chunk = ""
        
        for sentence in sentences:
            # If adding this sentence would exceed limit, start new chunk
            if len(current_chunk) + len(sentence) > max_chars:
                if current_chunk:
                    chunks.append(current_chunk.strip())
                current_chunk = sentence
            else:
                current_chunk += " " + sentence if current_chunk else sentence
        
        # Add remaining chunk
        if current_chunk:
            chunks.append(current_chunk.strip())
        
        return chunks
    
    def _split_into_sentences(self, text: str) -> List[str]:
        """Split text into sentences"""
        import re
        
        # Split by sentence endings
        sentences = re.split(r'[.!?]+', text)
        return [s.strip() for s in sentences if s.strip()]
    
    def _convert_with_openai(self, text: str, voice_settings: Dict = None) -> Optional[str]:
        """Convert text to speech using OpenAI TTS"""
        try:
            # Check rate limits
            if self.request_count >= self.config.OPENAI_RATE_LIMIT:
                self.logger.warning("OpenAI rate limit reached, waiting...")
                time.sleep(60)  # Wait 1 minute
                self.request_count = 0
            
            # Prepare voice settings
            voice = voice_settings.get('voice', 'alloy') if voice_settings else 'alloy'
            language = voice_settings.get('language', 'id') if voice_settings else 'id'
            
            # Create temporary file
            temp_file = tempfile.NamedTemporaryFile(delete=False, suffix='.mp3')
            temp_file.close()
            
            # Call OpenAI TTS API
            response = openai.audio.speech.create(
                model=self.config.OPENAI_TTS_MODEL,
                voice=voice,
                input=text
            )
            
            # Save audio file
            with open(temp_file.name, 'wb') as f:
                f.write(response.content)
            
            self.request_count += 1
            self.logger.info(f"OpenAI TTS successful for {len(text)} characters")
            
            return temp_file.name
            
        except Exception as e:
            self.logger.error(f"OpenAI TTS failed: {str(e)}")
            return None
    
    def _convert_with_google(self, text: str, voice_settings: Dict = None) -> Optional[str]:
        """Convert text to speech using Google TTS (fallback)"""
        try:
            from gtts import gTTS
            
            # Prepare language settings
            language = voice_settings.get('language', 'id') if voice_settings else 'id'
            
            # Create temporary file
            temp_file = tempfile.NamedTemporaryFile(delete=False, suffix='.mp3')
            temp_file.close()
            
            # Convert with gTTS
            tts = gTTS(text=text, lang=language, slow=False)
            tts.save(temp_file.name)
            
            self.logger.info(f"Google TTS successful for {len(text)} characters")
            return temp_file.name
            
        except Exception as e:
            self.logger.error(f"Google TTS failed: {str(e)}")
            return None
    
    def _merge_audio_files(self, audio_files: List[str]) -> Optional[str]:
        """Merge multiple audio files into one"""
        try:
            from pydub import AudioSegment
            
            if not audio_files:
                return None
            
            # Load first audio file
            combined = AudioSegment.from_mp3(audio_files[0])
            
            # Add silence between chunks
            silence = AudioSegment.silent(duration=500)  # 0.5 seconds
            
            # Add remaining audio files
            for audio_file in audio_files[1:]:
                audio = AudioSegment.from_mp3(audio_file)
                combined += silence + audio
            
            # Create output file
            output_file = tempfile.NamedTemporaryFile(delete=False, suffix='.mp3')
            output_file.close()
            
            # Export combined audio
            combined.export(output_file.name, format='mp3', bitrate=self.config.AUDIO_BITRATE)
            
            # Clean up individual files
            for audio_file in audio_files:
                try:
                    os.unlink(audio_file)
                except:
                    pass
            
            self.logger.info(f"Merged {len(audio_files)} audio files")
            return output_file.name
            
        except Exception as e:
            self.logger.error(f"Error merging audio files: {str(e)}")
            return None
    
    def _rate_limit(self):
        """Implement rate limiting"""
        current_time = time.time()
        
        # Ensure minimum delay between requests
        if current_time - self.last_request_time < self.config.REQUEST_DELAY:
            sleep_time = self.config.REQUEST_DELAY - (current_time - self.last_request_time)
            time.sleep(sleep_time)
        
        self.last_request_time = time.time()
    
    def _reset_daily_counter(self):
        """Reset daily character counter"""
        current_date = time.strftime('%Y-%m-%d')
        if current_date != self.last_reset_date:
            self.daily_char_count = 0
            self.last_reset_date = current_date
            self.logger.info("Reset daily character counter")
    
    def get_usage_stats(self) -> Dict:
        """Get current usage statistics"""
        return {
            'daily_char_count': self.daily_char_count,
            'request_count': self.request_count,
            'last_reset_date': self.last_reset_date
        }
    
    def cleanup_temp_files(self):
        """Clean up temporary files"""
        temp_dir = tempfile.gettempdir()
        for filename in os.listdir(temp_dir):
            if filename.startswith('tmp') and filename.endswith('.mp3'):
                try:
                    os.unlink(os.path.join(temp_dir, filename))
                except:
                    pass 