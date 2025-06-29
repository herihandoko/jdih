# Dashboard API - Teras Data Pimpinan

## Overview
API ini dibuat untuk mendukung Teras Data/Dashboard Pimpinan pada sistem PPID. API ini menyediakan berbagai endpoint untuk mendapatkan data statistik dan analitik yang diperlukan oleh pimpinan.

## Fitur Utama

### 📊 **Dashboard Overview**
- Statistik umum produk hukum
- Total peraturan, artikel, monografi, putusan
- Total views dan peraturan tahun/bulan ini

### 📈 **Analytics & Trends**
- Trend bulanan peraturan dan views
- Perbandingan data antar tahun
- Top peraturan terpopuler

### 📋 **Content Management**
- Statistik per kategori dan jenis peraturan
- Status publikasi konten
- Konten per instansi

### 🔍 **Search & Filter**
- Pencarian lanjutan dengan multiple filter
- Activity logs untuk audit trail
- File upload statistics

### 📱 **Mobile Support**
- Quick stats untuk aplikasi mobile
- Optimized response untuk mobile devices

## Struktur File

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       └── DashboardApiController.php    # Main API Controller
│   └── Resources/
│       └── DashboardOverviewResource.php     # API Resource
routes/
└── api.php                                   # API Routes
```

## Endpoints

### Core Dashboard Endpoints
1. `GET /api/dashboard/overview` - Statistik umum
2. `GET /api/dashboard/kategori-stats` - Statistik per kategori
3. `GET /api/dashboard/trend-bulanan` - Trend bulanan
4. `GET /api/dashboard/perbandingan-tahun` - Perbandingan tahun
5. `GET /api/dashboard/top-peraturan` - Top peraturan terpopuler
6. `GET /api/dashboard/jenis-peraturan` - Statistik jenis peraturan
7. `GET /api/dashboard/status-publikasi` - Status publikasi
8. `GET /api/dashboard/konten-instansi` - Konten per instansi
9. `GET /api/dashboard/search` - Pencarian lanjutan
10. `GET /api/dashboard/activity-logs` - Activity logs
11. `GET /api/dashboard/file-stats` - File upload stats

### Mobile Endpoints
12. `GET /api/mobile/dashboard/quick-stats` - Quick stats untuk mobile

## Installation & Setup

### 1. Prerequisites
- Laravel 8+ 
- MySQL/PostgreSQL
- PHP 8.0+

### 2. Dependencies
Pastikan package berikut sudah terinstall:
```bash
composer require spatie/laravel-activitylog
```

### 3. Database
Pastikan tabel-tabel berikut sudah ada:
- `produk_hukum_lists`
- `produk_hukum_categories`
- `produk_hukum_types`
- `activity_log`

### 4. Configuration
Tambahkan konfigurasi caching di `config/cache.php`:
```php
'stores' => [
    'redis' => [
        'driver' => 'redis',
        'connection' => 'cache',
    ],
],
```

## Usage

### 1. Authentication
Semua endpoint memerlukan authentication. Gunakan Bearer token:
```bash
curl -H "Authorization: Bearer YOUR_TOKEN" \
     -H "Accept: application/json" \
     https://your-domain.com/api/dashboard/overview
```

### 2. Basic Usage
```php
// Menggunakan Guzzle HTTP Client
$client = new \GuzzleHttp\Client();
$response = $client->get('https://your-domain.com/api/dashboard/overview', [
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
    ]
]);

$data = json_decode($response->getBody(), true);
```

### 3. JavaScript/Frontend
```javascript
// Menggunakan Fetch API
fetch('/api/dashboard/overview', {
    headers: {
        'Authorization': 'Bearer ' + token,
        'Accept': 'application/json'
    }
})
.then(response => response.json())
.then(data => {
    console.log(data);
});
```

## Caching Strategy

API ini menggunakan caching untuk optimasi performa:

| Endpoint | Cache Duration | Reason |
|----------|----------------|---------|
| Overview | 1 hour | Data statistik jarang berubah |
| Kategori Stats | 1 hour | Data kategori relatif stabil |
| Trend Bulanan | 1 hour | Data historis |
| Perbandingan Tahun | 1 hour | Data historis |
| Top Peraturan | 30 minutes | Data views berubah cukup sering |
| Status Publikasi | 30 minutes | Status bisa berubah |
| Quick Stats | 15 minutes | Data real-time untuk mobile |

## Performance Optimization

### 1. Database Indexing
Pastikan index berikut sudah ada:
```sql
-- Index untuk performa query
CREATE INDEX idx_produk_hukum_deleted ON produk_hukum_lists(is_deleted);
CREATE INDEX idx_produk_hukum_publish ON produk_hukum_lists(is_publish);
CREATE INDEX idx_produk_hukum_year ON produk_hukum_lists(thn_peraturan);
CREATE INDEX idx_produk_hukum_views ON produk_hukum_lists(view);
```

### 2. Query Optimization
- Menggunakan eager loading untuk relasi
- Implementasi pagination untuk data besar
- Menggunakan database aggregation functions

### 3. Caching
- Redis untuk caching data
- Cache invalidation strategy
- Cache warming untuk data penting

## Error Handling

### Standard Error Responses
```json
{
    "success": false,
    "message": "Error message",
    "error": "Detailed error information"
}
```

### HTTP Status Codes
- `200` - Success
- `401` - Unauthorized
- `404` - Not Found
- `422` - Validation Error
- `500` - Internal Server Error

## Security

### 1. Authentication
- Bearer token authentication
- Token expiration handling
- Role-based access control

### 2. Rate Limiting
- 60 requests/minute untuk authenticated users
- 30 requests/minute untuk unauthenticated users

### 3. Input Validation
- Parameter validation
- SQL injection prevention
- XSS protection

## Monitoring & Logging

### 1. Activity Logging
Semua aktivitas API dicatat menggunakan Spatie Activity Log:
```php
// Log activity
activity()
    ->performedOn($model)
    ->log('Dashboard API accessed');
```

### 2. Performance Monitoring
- Response time monitoring
- Database query monitoring
- Cache hit/miss ratio

## Testing

### 1. Unit Tests
```bash
php artisan test --filter=DashboardApiController
```

### 2. API Tests
```bash
php artisan test --filter=DashboardApiTest
```

### 3. Postman Collection
Import file `Dashboard_API_Collection.postman_collection.json` ke Postman untuk testing manual.

## Deployment

### 1. Production Checklist
- [ ] Enable caching (Redis/Memcached)
- [ ] Configure rate limiting
- [ ] Set up monitoring
- [ ] Enable HTTPS
- [ ] Configure CORS if needed

### 2. Environment Variables
```env
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

## Troubleshooting

### Common Issues

1. **Cache Not Working**
   - Check cache driver configuration
   - Verify Redis connection
   - Clear cache: `php artisan cache:clear`

2. **Slow Response Time**
   - Check database indexes
   - Monitor query performance
   - Verify caching is working

3. **Authentication Issues**
   - Verify token validity
   - Check token expiration
   - Ensure proper headers

### Debug Mode
Untuk debugging, enable debug mode di `.env`:
```env
APP_DEBUG=true
LOG_LEVEL=debug
```

## Support

Untuk bantuan teknis atau pertanyaan:
1. Cek dokumentasi API di `API_DOCUMENTATION.md`
2. Review error logs di `storage/logs/laravel.log`
3. Hubungi tim development

## Changelog

### v1.0.0 (2024-01-15)
- Initial release
- Basic dashboard endpoints
- Caching implementation
- Mobile support
- Comprehensive documentation 