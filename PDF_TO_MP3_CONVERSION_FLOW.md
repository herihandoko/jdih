# PDF to MP3 Conversion System Flow

## Overview
Sistem konversi PDF ke MP3 menggunakan Python dengan multiple TTS providers untuk menghindari limit dan memastikan ketersediaan layanan.

## Architecture Flow

### 1. Input & Validation
```
PDF Upload → Text Extraction → Content Validation → Queue Processing
```

### 2. Text Processing Pipeline
```
Raw Text → Cleaning → Chunking → Language Detection → TTS Provider Selection
```

### 3. TTS Provider Strategy (Anti-Limit)
```
Primary Provider (OpenAI) → Fallback 1 (Google TTS) → Fallback 2 (Azure TTS) → Fallback 3 (Local TTS)
```

## Detailed Flow

### Phase 1: PDF Processing
1. **PDF Upload & Storage**
   - Upload PDF ke storage
   - Generate unique ID untuk tracking
   - Update database status: `pending`

2. **Text Extraction**
   - Extract text menggunakan PyPDF2/pdfplumber
   - Clean text (remove headers, footers, page numbers)
   - Detect language (ID/EN)
   - Split into chunks (max 4000 characters per chunk)

3. **Content Analysis**
   - Calculate total characters
   - Estimate processing time
   - Check for special characters/formatting
   - Validate content quality

### Phase 2: TTS Provider Management

#### Provider Priority System:
1. **OpenAI TTS** (Primary)
   - Model: tts-1-hd
   - Voice: alloy, echo, fable, onyx, nova, shimmer
   - Rate limit: 50 requests/minute
   - Cost: $0.015 per 1K characters

2. **Google Cloud TTS** (Fallback 1)
   - Voices: id-ID-Standard-A, en-US-Standard-A
   - Rate limit: 100 requests/minute
   - Cost: $4.00 per 1M characters

3. **Azure Cognitive Services** (Fallback 2)
   - Voices: id-ID-GadisNeural, en-US-JennyNeural
   - Rate limit: 200 requests/minute
   - Cost: $16.00 per 1M characters

4. **Local TTS** (Fallback 3)
   - gTTS (Google Text-to-Speech offline)
   - pyttsx3 (system TTS)
   - No rate limits, free

### Phase 3: Anti-Limit Strategies

#### Strategy 1: Provider Rotation
```
Request 1-50: OpenAI
Request 51-100: Google TTS
Request 101-200: Azure TTS
Request 201+: Local TTS
```

#### Strategy 2: Rate Limiting
- Implement exponential backoff
- Queue management dengan delay
- Batch processing untuk efisiensi

#### Strategy 3: Caching System
- Cache hasil TTS berdasarkan text hash
- Reuse audio untuk text yang sama
- Reduce API calls

#### Strategy 4: Chunking Optimization
- Split text berdasarkan kalimat natural
- Avoid cutting words
- Balance chunk size vs API calls

### Phase 4: Audio Processing

#### Audio Generation:
1. **Per-chunk TTS generation**
2. **Audio concatenation**
3. **Quality enhancement**
4. **Format conversion to MP3**

#### Audio Enhancement:
- Normalize volume levels
- Add fade in/out effects
- Optimize bitrate (128kbps)
- Add metadata (title, artist, duration)

### Phase 5: Storage & Delivery

#### File Management:
- Generate unique filename
- Store in cloud storage
- Update database dengan file path
- Set status: `completed`

#### Delivery Options:
- Direct download link
- Streaming URL
- QR code generation
- Email notification

## Database Schema

### Conversion Jobs Table:
```sql
CREATE TABLE pdf_to_mp3_conversions (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    pdf_file_path VARCHAR(255),
    mp3_file_path VARCHAR(255),
    status ENUM('pending', 'processing', 'completed', 'failed'),
    provider_used VARCHAR(50),
    total_chunks INT,
    total_characters INT,
    processing_time INT,
    error_message TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Provider Usage Tracking:
```sql
CREATE TABLE tts_provider_usage (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    provider_name VARCHAR(50),
    requests_count INT,
    characters_processed INT,
    cost_estimate DECIMAL(10,4),
    date DATE,
    created_at TIMESTAMP
);
```

## Python Script Structure

### Main Components:

1. **PDFProcessor**
   - Text extraction
   - Content cleaning
   - Chunking logic

2. **TTSManager**
   - Provider selection
   - Rate limiting
   - Fallback handling

3. **AudioProcessor**
   - Audio concatenation
   - Quality enhancement
   - Format conversion

4. **StorageManager**
   - File upload
   - Database updates
   - Link generation

5. **MonitoringService**
   - Usage tracking
   - Cost calculation
   - Performance metrics

## Cron Job Configuration

### Daily Processing:
```bash
# Process pending conversions every 30 minutes
*/30 * * * * /usr/bin/python3 /path/to/pdf_to_mp3_processor.py

# Clean up old files weekly
0 2 * * 0 /usr/bin/python3 /path/to/cleanup_old_files.py

# Generate usage reports daily
0 6 * * * /usr/bin/python3 /path/to/generate_usage_report.py
```

## Error Handling & Monitoring

### Error Scenarios:
1. **PDF extraction failed**
2. **TTS provider unavailable**
3. **Rate limit exceeded**
4. **Audio processing failed**
5. **Storage upload failed**

### Monitoring Metrics:
- Success rate per provider
- Average processing time
- Cost per conversion
- Error frequency
- Queue length

## Cost Optimization

### Strategies:
1. **Smart provider selection** based on content length
2. **Batch processing** untuk reduce API calls
3. **Caching** untuk duplicate content
4. **Local TTS** untuk short texts
5. **Compression** untuk reduce storage costs

### Cost Estimates:
- **Short document** (< 1000 chars): $0.01-0.05
- **Medium document** (1000-5000 chars): $0.05-0.25
- **Long document** (> 5000 chars): $0.25-1.00

## Security Considerations

1. **API Key Management**
   - Environment variables
   - Key rotation
   - Access logging

2. **File Security**
   - Temporary file cleanup
   - Access control
   - Virus scanning

3. **Data Privacy**
   - Content encryption
   - Audit logging
   - GDPR compliance

## Performance Optimization

### Caching Strategy:
- Redis untuk temporary data
- File system cache untuk audio chunks
- Database cache untuk metadata

### Scaling Considerations:
- Horizontal scaling dengan multiple workers
- Load balancing untuk TTS providers
- CDN untuk audio delivery

## Integration with Laravel

### API Endpoints:
```
POST /api/pdf-to-mp3/convert
GET /api/pdf-to-mp3/status/{id}
GET /api/pdf-to-mp3/download/{id}
DELETE /api/pdf-to-mp3/{id}
```

### Database Integration:
- Update existing `produk_hukum_lists` table
- Add conversion tracking fields
- Sync with existing audio system

## Testing Strategy

### Unit Tests:
- PDF text extraction
- TTS provider selection
- Audio processing
- Error handling

### Integration Tests:
- End-to-end conversion
- Provider fallback
- Database operations

### Load Tests:
- Concurrent conversions
- Rate limiting
- Performance under load 