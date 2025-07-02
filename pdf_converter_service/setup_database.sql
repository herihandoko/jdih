-- PDF to MP3 Conversion Service Database Setup

-- Create queue table
CREATE TABLE IF NOT EXISTS pdf_conversion_queue (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produk_hukum_id INT NOT NULL,
    pdf_filename VARCHAR(255) NOT NULL,
    judul_peraturan VARCHAR(500),
    status ENUM('pending', 'processing', 'completed', 'failed') DEFAULT 'pending',
    priority INT DEFAULT 2,
    text_content LONGTEXT,
    text_length INT DEFAULT 0,
    chunk_count INT DEFAULT 0,
    current_chunk INT DEFAULT 0,
    mp3_filename VARCHAR(255),
    tts_provider VARCHAR(50),
    retry_count INT DEFAULT 0,
    error_message TEXT,
    started_at TIMESTAMP NULL,
    completed_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_status_priority (status, priority),
    INDEX idx_created_at (created_at),
    FOREIGN KEY (produk_hukum_id) REFERENCES produk_hukum_lists(id)
);

-- Add text_content column to produk_hukum_lists if not exists
ALTER TABLE produk_hukum_lists 
ADD COLUMN IF NOT EXISTS text_content LONGTEXT NULL COMMENT 'Extracted text content from PDF',
ADD COLUMN IF NOT EXISTS text_length INT NULL COMMENT 'Length of extracted text in characters';

-- Add index for text search
ALTER TABLE produk_hukum_lists 
ADD INDEX IF NOT EXISTS idx_text_content (text_content(100)) COMMENT 'Index for text content search'; 