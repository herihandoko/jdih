# PDF to MP3 Conversion Service

Service untuk mengkonversi file PDF dari database `produk_hukum_lists` menjadi file MP3 menggunakan OpenAI TTS dan fallback providers.

## Fitur Utama

- ✅ **Automatic Queue Management**: Sistem antrian otomatis untuk konversi PDF
- ✅ **Multi-Provider TTS**: OpenAI TTS + Google TTS fallback
- ✅ **Rate Limiting**: Menghindari limit API dengan delay dan chunking
- ✅ **Large File Support**: Mendukung file PDF besar dengan chunking
- ✅ **Error Handling**: Retry mechanism dan error recovery
- ✅ **Progress Tracking**: Monitoring progress konversi
- ✅ **Cost Optimization**: Optimasi biaya dengan provider selection

## Arsitektur

```
Database (produk_hukum_lists) → Queue Service → PDF Processor → TTS Service → Audio Merger → Storage
```

## Instalasi

### 1. Clone atau Download Service

```bash
cd /path/to/your/laravel/project
mkdir pdf_converter_service
cd pdf_converter_service
```

### 2. Install Dependencies

```bash
pip3 install -r requirements.txt
```

### 3. Setup Environment

```bash
cp env.example .env
# Edit .env file dengan konfigurasi yang sesuai
```

### 4. Setup Database

Jalankan SQL berikut untuk membuat tabel queue:

```sql
CREATE TABLE pdf_conversion_queue (
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
```

### 5. Setup OpenAI API Key

Dapatkan API key dari [OpenAI Platform](https://platform.openai.com/api-keys) dan tambahkan ke file `.env`:

```env
OPENAI_API_KEY=sk-your-api-key-here
```

## Konfigurasi

### Environment Variables

| Variable | Description | Default |
|----------|-------------|---------|
| `PDF_CONVERSION_ENABLED` | Enable/disable service | `true` |
| `PDF_CONVERSION_BATCH_SIZE` | Number of documents to process per batch | `1` |
| `SAVE_TEXT_CONTENT` | Save extracted text to database | `true` |
| `SAVE_TEXT_FILE` | Save extracted text as text file | `false` |
| `OPENAI_API_KEY` | OpenAI API key | Required |
| `OPENAI_MAX_CHARS_PER_REQUEST` | Max characters per TTS request | `4000` |
| `OPENAI_RATE_LIMIT` | Rate limit per minute | `50` |
| `REQUEST_DELAY` | Delay between requests (seconds) | `2.0` |
| `BATCH_DELAY` | Delay between batches (seconds) | `3600.0` |

### Storage Paths

- `PDF_STORAGE_PATH`: Path ke folder PDF (`storage/places/peraturan`)
- `MP3_STORAGE_PATH`: Path ke folder MP3 (`storage/places/mp3`)
- `TEMP_STORAGE_PATH`: Path ke folder temporary (`storage/temp`)

### Text Storage Options

- **Database Storage** (`SAVE_TEXT_CONTENT=true`): Text disimpan di kolom `text_content` tabel `produk_hukum_lists`
- **File Storage** (`SAVE_TEXT_FILE=true`): Text disimpan sebagai file `.txt` di `storage/places/mp3/text/`
- **Both**: Bisa disimpan di database dan file sekaligus

## Penggunaan

### 1. Manual Run

```bash
python3 main.py
```

### 2. Cronjob Setup

Tambahkan ke crontab:

```bash
# Setiap jam (recommended untuk 1 file per jam)
0 * * * * cd /path/to/pdf_converter_service && python3 main.py >> logs/service.log 2>&1

# Atau setiap 2 jam untuk lebih hemat
0 */2 * * * cd /path/to/pdf_converter_service && python3 main.py >> logs/service.log 2>&1
```

### 3. Systemd Service (Linux)

Buat file service `/etc/systemd/system/pdf-converter.service`:

```ini
[Unit]
Description=PDF to MP3 Conversion Service
After=network.target

[Service]
Type=simple
User=www-data
WorkingDirectory=/path/to/pdf_converter_service
ExecStart=/usr/bin/python3 main.py
Restart=always
RestartSec=10

[Install]
WantedBy=multi-user.target
```

Enable dan start service:

```bash
sudo systemctl enable pdf-converter
sudo systemctl start pdf-converter
sudo systemctl status pdf-converter
```

## Monitoring

### 1. Log Files

Service akan membuat log di:
- `logs/pdf_converter.log` - Main service log
- `logs/service.log` - Cronjob output (jika menggunakan cron)

### 2. Database Monitoring

Cek status queue:

```sql
SELECT status, COUNT(*) as count 
FROM pdf_conversion_queue 
GROUP BY status;
```

### 3. Queue Statistics

```sql
SELECT 
    COUNT(*) as total_items,
    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
    SUM(CASE WHEN status = 'processing' THEN 1 ELSE 0 END) as processing,
    SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed,
    SUM(CASE WHEN status = 'failed' THEN 1 ELSE 0 END) as failed
FROM pdf_conversion_queue;
```

## Troubleshooting

### 1. OpenAI API Error

```
Error: OpenAI TTS failed: Invalid API key
```

**Solution**: Periksa `OPENAI_API_KEY` di file `.env`

### 2. Database Connection Error

```
Error: Can't connect to MySQL server
```

**Solution**: Periksa konfigurasi database di `.env`

### 3. PDF File Not Found

```
Error: PDF file not found: storage/places/peraturan/filename.pdf
```

**Solution**: Periksa path `PDF_STORAGE_PATH` dan pastikan file ada

### 4. Rate Limit Error

```
Warning: OpenAI rate limit reached, waiting...
```

**Solution**: Service akan otomatis menunggu dan retry. Jika sering terjadi, kurangi `BATCH_SIZE`

### 5. Large File Processing

Untuk file PDF besar (>50 halaman), service akan:
- Otomatis chunk text menjadi bagian kecil
- Process secara bertahap
- Merge audio chunks menjadi satu file

## Cost Estimation

### OpenAI TTS Pricing
- $0.015 per 1,000 characters
- PDF 50 halaman (~25,000 karakter): ~$0.375
- PDF 100 halaman (~50,000 karakter): ~$0.75

### Cost Optimization
- Service menggunakan chunking untuk menghindari limit
- Fallback ke Google TTS (gratis) jika OpenAI gagal
- Rate limiting untuk menghindari overuse

## File Structure

```
pdf_converter_service/
├── main.py              # Main service script
├── config.py            # Configuration management
├── database.py          # Database operations
├── pdf_extractor.py     # PDF text extraction
├── tts_service.py       # Text-to-speech service
├── requirements.txt     # Python dependencies
├── env.example          # Environment template
├── README.md           # This file
└── logs/               # Log files directory
```

## API Integration

Service ini terintegrasi dengan Laravel melalui database. File MP3 yang dihasilkan akan otomatis tersedia di:

```
storage/places/mp3/peraturan_{id}_{timestamp}.mp3
```

Dan status akan diupdate di tabel `produk_hukum_lists`:
- `status_tts = 1`
- `mp3_path = filename.mp3`
- `conversion_status = 'completed'`

## Support

Untuk bantuan atau pertanyaan:
1. Cek log files untuk error details
2. Periksa database queue status
3. Pastikan semua dependencies terinstall
4. Verifikasi konfigurasi environment variables 