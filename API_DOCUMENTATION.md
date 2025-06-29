# API Documentation - Teras Data/Dashboard Pimpinan

## Base URL
```
https://your-domain.com/api
```

## Authentication
Semua endpoint memerlukan authentication. Gunakan header:
```
Authorization: Bearer {your-token}
```

## Endpoints

### 1. Dashboard Overview
**GET** `/api/dashboard/overview`

Statistik umum dashboard pimpinan.

**Response:**
```json
{
  "success": true,
  "data": {
    "total_produk_hukum": 1250,
    "total_peraturan": 890,
    "total_artikel": 245,
    "total_monografi": 115,
    "total_putusan": 200,
    "total_views": 45678,
    "peraturan_tahun_ini": 45,
    "peraturan_bulan_ini": 12,
    "last_updated": "2024-01-15 10:30:00"
  }
}
```

### 2. Statistik per Kategori
**GET** `/api/dashboard/kategori-stats`

Statistik produk hukum berdasarkan kategori.

**Response:**
```json
{
  "success": true,
  "data": {
    "kategori": [
      {
        "nama": "Peraturan Perundang-undangan",
        "total": 890,
        "persentase": 71.2
      },
      {
        "nama": "Artikel Hukum",
        "total": 245,
        "persentase": 19.6
      }
    ]
  }
}
```

### 3. Trend Bulanan
**GET** `/api/dashboard/trend-bulanan?year=2024`

Trend data peraturan dan views per bulan.

**Parameters:**
- `year` (optional): Tahun yang ingin dilihat (default: tahun sekarang)

**Response:**
```json
{
  "success": true,
  "data": {
    "tahun": 2024,
    "trend": [
      {
        "bulan": "Januari",
        "total_peraturan": 15,
        "total_views": 3456
      },
      {
        "bulan": "Februari",
        "total_peraturan": 12,
        "total_views": 2987
      }
    ]
  }
}
```

### 4. Perbandingan Tahun
**GET** `/api/dashboard/perbandingan-tahun?tahun1=2023&tahun2=2024`

Perbandingan data antara dua tahun.

**Parameters:**
- `tahun1` (optional): Tahun pertama (default: tahun lalu)
- `tahun2` (optional): Tahun kedua (default: tahun sekarang)

**Response:**
```json
{
  "success": true,
  "data": {
    "perbandingan": {
      "2023": {
        "total_peraturan": 156,
        "total_views": 45678
      },
      "2024": {
        "total_peraturan": 145,
        "total_views": 52345
      }
    },
    "pertumbuhan": {
      "peraturan": -7.05,
      "views": 14.61
    }
  }
}
```

### 5. Top Peraturan Terpopuler
**GET** `/api/dashboard/top-peraturan?limit=10&period=month`

Daftar peraturan terpopuler berdasarkan views.

**Parameters:**
- `limit` (optional): Jumlah data (default: 10)
- `period` (optional): Periode (month/year/all, default: month)

**Response:**
```json
{
  "success": true,
  "data": {
    "top_peraturan": [
      {
        "id": 1,
        "judul": "Peraturan Daerah No. 15 Tahun 2024",
        "views": 1234,
        "kategori": "Peraturan Perundang-undangan",
        "jenis": "Peraturan Daerah",
        "tahun": 2024,
        "status_akhir": "Berlaku"
      }
    ],
    "period": "month",
    "limit": 10
  }
}
```

### 6. Statistik per Jenis Peraturan
**GET** `/api/dashboard/jenis-peraturan`

Statistik berdasarkan jenis peraturan.

**Response:**
```json
{
  "success": true,
  "data": {
    "jenis_peraturan": [
      {
        "nama": "Peraturan Daerah",
        "total": 456,
        "persentase": 51.2
      },
      {
        "nama": "Peraturan Gubernur",
        "total": 234,
        "persentase": 26.3
      }
    ]
  }
}
```

### 7. Status Publikasi
**GET** `/api/dashboard/status-publikasi`

Statistik status publikasi konten.

**Response:**
```json
{
  "success": true,
  "data": {
    "status": {
      "published": 1150,
      "draft": 100,
      "total": 1250
    },
    "persentase_published": 92.0
  }
}
```

### 8. Konten per Instansi
**GET** `/api/dashboard/konten-instansi`

Statistik konten berdasarkan instansi.

**Response:**
```json
{
  "success": true,
  "data": {
    "instansi": [
      {
        "nama": "Dinas Hukum",
        "total_peraturan": 234,
        "total_artikel": 45
      },
      {
        "nama": "Sekretariat Daerah",
        "total_peraturan": 156,
        "total_artikel": 23
      }
    ]
  }
}
```

### 9. Pencarian Lanjutan
**GET** `/api/dashboard/search?keyword=perda&kategori=peraturan&tahun=2024&status=published&limit=20`

Pencarian produk hukum dengan filter.

**Parameters:**
- `keyword` (optional): Kata kunci pencarian
- `kategori` (optional): Filter kategori
- `tahun` (optional): Filter tahun
- `status` (optional): Filter status (published/draft)
- `limit` (optional): Jumlah data (default: 20)

**Response:**
```json
{
  "success": true,
  "data": {
    "total_results": 25,
    "results": [
      {
        "id": 1,
        "judul": "Peraturan Daerah No. 15 Tahun 2024",
        "kategori": "Peraturan Perundang-undangan",
        "jenis": "Peraturan Daerah",
        "tahun": 2024,
        "status": "published",
        "views": 1234,
        "instansi": "Dinas Hukum",
        "tgl_pengundangan": "2024-01-15"
      }
    ],
    "filters": {
      "keyword": "perda",
      "kategori": "peraturan",
      "tahun": "2024",
      "status": "published"
    }
  }
}
```

### 10. Activity Logs
**GET** `/api/dashboard/activity-logs?period=week&action=created&limit=50`

Log aktivitas pengguna.

**Parameters:**
- `period` (optional): Periode (week/month/year, default: week)
- `action` (optional): Filter aksi (created/updated/deleted)
- `limit` (optional): Jumlah data (default: 50)

**Response:**
```json
{
  "success": true,
  "data": {
    "activities": [
      {
        "user": "Admin User",
        "action": "created",
        "description": "Have created Produk Hukum Data",
        "timestamp": "2024-01-15 10:30:00",
        "properties": {}
      }
    ],
    "period": "week",
    "action": "created"
  }
}
```

### 11. File Upload Stats
**GET** `/api/dashboard/file-stats`

Statistik file yang diupload.

**Response:**
```json
{
  "success": true,
  "data": {
    "file_stats": {
      "total_files": 1250,
      "file_types": {
        "pdf": 890,
        "doc": 234,
        "mp3": 126
      }
    }
  }
}
```

### 12. Mobile Quick Stats
**GET** `/api/mobile/dashboard/quick-stats`

Statistik cepat untuk aplikasi mobile.

**Response:**
```json
{
  "success": true,
  "data": {
    "quick_stats": {
      "total_peraturan": 890,
      "peraturan_baru_bulan_ini": 12,
      "total_views_hari_ini": 1234,
      "pending_approval": 5
    }
  }
}
```

## Error Responses

### 401 Unauthorized
```json
{
  "success": false,
  "message": "Unauthorized",
  "error": "Token not provided or invalid"
}
```

### 404 Not Found
```json
{
  "success": false,
  "message": "Data not found",
  "error": "The requested resource was not found"
}
```

### 500 Internal Server Error
```json
{
  "success": false,
  "message": "Internal server error",
  "error": "Something went wrong on our end"
}
```

## Rate Limiting
API ini memiliki rate limiting:
- 60 requests per minute untuk authenticated users
- 30 requests per minute untuk unauthenticated users

## Caching
Semua endpoint menggunakan caching untuk performa:
- Overview: 1 jam
- Kategori Stats: 1 jam
- Trend Bulanan: 1 jam
- Perbandingan Tahun: 1 jam
- Top Peraturan: 30 menit
- Status Publikasi: 30 menit
- Quick Stats: 15 menit

## Testing
Untuk testing, gunakan tools seperti:
- Postman
- Insomnia
- cURL

**Contoh cURL:**
```bash
curl -X GET "https://your-domain.com/api/dashboard/overview" \
  -H "Authorization: Bearer your-token" \
  -H "Accept: application/json"
``` 