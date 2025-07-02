import os
from dotenv import load_dotenv

# Load environment variables
load_dotenv()

class Config:
    """Configuration class for PDF to MP3 conversion service"""
    
    # Service Configuration
    ENABLED = os.getenv('PDF_CONVERSION_ENABLED', 'true').lower() == 'true'
    BATCH_SIZE = int(os.getenv('PDF_CONVERSION_BATCH_SIZE', '1'))  # Changed to 1 file per batch
    MAX_RETRIES = int(os.getenv('PDF_CONVERSION_MAX_RETRIES', '3'))
    SAVE_TEXT_CONTENT = os.getenv('SAVE_TEXT_CONTENT', 'true').lower() == 'true'  # Save extracted text
    SAVE_TEXT_FILE = os.getenv('SAVE_TEXT_FILE', 'false').lower() == 'true'  # Save as text file
    
    # OpenAI Configuration
    OPENAI_API_KEY = os.getenv('OPENAI_API_KEY')
    OPENAI_TTS_MODEL = os.getenv('OPENAI_TTS_MODEL', 'tts-1')
    OPENAI_MAX_CHARS_PER_REQUEST = int(os.getenv('OPENAI_MAX_CHARS_PER_REQUEST', '4000'))
    OPENAI_RATE_LIMIT = int(os.getenv('OPENAI_RATE_LIMIT', '50'))
    
    # Google TTS Configuration (Fallback)
    GOOGLE_TTS_ENABLED = os.getenv('GOOGLE_TTS_ENABLED', 'true').lower() == 'true'
    GOOGLE_APPLICATION_CREDENTIALS = os.getenv('GOOGLE_APPLICATION_CREDENTIALS')
    GOOGLE_MAX_CHARS_PER_REQUEST = int(os.getenv('GOOGLE_MAX_CHARS_PER_REQUEST', '5000'))
    
    # Audio Configuration
    AUDIO_OUTPUT_FORMAT = os.getenv('AUDIO_OUTPUT_FORMAT', 'mp3')
    AUDIO_SAMPLE_RATE = int(os.getenv('AUDIO_SAMPLE_RATE', '22050'))
    AUDIO_BITRATE = os.getenv('AUDIO_BITRATE', '128k')
    AUDIO_CHUNK_DELAY = float(os.getenv('AUDIO_CHUNK_DELAY', '0.5'))
    
    # Storage Configuration
    PDF_STORAGE_PATH = os.getenv('PDF_STORAGE_PATH', 'storage/places/peraturan')
    MP3_STORAGE_PATH = os.getenv('MP3_STORAGE_PATH', 'storage/places/mp3')
    TEMP_STORAGE_PATH = os.getenv('TEMP_STORAGE_PATH', 'storage/temp')
    
    # Database Configuration
    DB_HOST = os.getenv('DB_HOST', 'localhost')
    DB_DATABASE = os.getenv('DB_DATABASE', 'jdih')
    DB_USERNAME = os.getenv('DB_USERNAME', 'root')
    DB_PASSWORD = os.getenv('DB_PASSWORD', '')
    DB_PORT = int(os.getenv('DB_PORT', '3306'))
    
    # Logging Configuration
    LOG_LEVEL = os.getenv('LOG_LEVEL', 'INFO')
    LOG_FILE = os.getenv('LOG_FILE', 'logs/pdf_converter.log')
    
    # Rate Limiting
    REQUEST_DELAY = float(os.getenv('REQUEST_DELAY', '2.0'))  # seconds between requests
    BATCH_DELAY = float(os.getenv('BATCH_DELAY', '3600.0'))  # 1 hour between batches (3600 seconds)
    
    @classmethod
    def validate(cls):
        """Validate required configuration"""
        required_vars = [
            'OPENAI_API_KEY',
            'DB_HOST',
            'DB_DATABASE',
            'DB_USERNAME',
            'DB_PASSWORD'
        ]
        
        missing_vars = []
        for var in required_vars:
            if not getattr(cls, var):
                missing_vars.append(var)
        
        if missing_vars:
            raise ValueError(f"Missing required environment variables: {', '.join(missing_vars)}")
        
        return True 