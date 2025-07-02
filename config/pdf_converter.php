<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PDF to MP3 Converter Configuration
    |--------------------------------------------------------------------------
    */

    // TTS Providers Configuration
    'tts_providers' => [
        'openai' => [
            'enabled' => env('OPENAI_TTS_ENABLED', true),
            'api_key' => env('OPENAI_API_KEY'),
            'model' => env('OPENAI_TTS_MODEL', 'tts-1'),
            'voice' => env('OPENAI_TTS_VOICE', 'alloy'),
            'rate_limit' => env('OPENAI_RATE_LIMIT', 50),
            'char_limit' => env('OPENAI_CHAR_LIMIT', 4000),
            'cost_per_1k_chars' => env('OPENAI_COST_PER_1K', 0.015),
        ],
        'google' => [
            'enabled' => env('GOOGLE_TTS_ENABLED', false),
            'credentials' => env('GOOGLE_CLOUD_CREDENTIALS'),
            'voice' => env('GOOGLE_TTS_VOICE', 'id-ID-Standard-A'),
            'rate_limit' => env('GOOGLE_RATE_LIMIT', 100),
            'char_limit' => env('GOOGLE_CHAR_LIMIT', 5000),
            'cost_per_1k_chars' => env('GOOGLE_COST_PER_1K', 0.004),
        ],
        'azure' => [
            'enabled' => env('AZURE_TTS_ENABLED', false),
            'key' => env('AZURE_SPEECH_KEY'),
            'region' => env('AZURE_SPEECH_REGION'),
            'voice' => env('AZURE_TTS_VOICE', 'id-ID-GadisNeural'),
            'rate_limit' => env('AZURE_RATE_LIMIT', 200),
            'char_limit' => env('AZURE_CHAR_LIMIT', 5000),
            'cost_per_1k_chars' => env('AZURE_COST_PER_1K', 0.016),
        ],
    ],

    // Processing Limits
    'limits' => [
        'max_chars_per_chunk' => env('MAX_CHARS_PER_CHUNK', 4000),
        'max_file_size_mb' => env('MAX_FILE_SIZE_MB', 50),
        'max_daily_conversions' => env('MAX_DAILY_CONVERSIONS', 100),
        'rate_limit_delay' => env('RATE_LIMIT_DELAY', 2), // seconds
        'max_retries' => env('MAX_RETRIES', 3),
    ],

    // Storage Paths
    'storage' => [
        'pdf_path' => env('PDF_STORAGE_PATH', 'storage/places/peraturan'),
        'mp3_path' => env('MP3_STORAGE_PATH', 'storage/places/mp3'),
        'temp_path' => env('TEMP_STORAGE_PATH', 'storage/temp'),
    ],

    // Queue Configuration
    'queue' => [
        'batch_size' => env('CONVERSION_BATCH_SIZE', 5),
        'priority_levels' => [
            1 => 'Urgent',
            2 => 'Normal',
            3 => 'Low',
        ],
    ],

    // Language Mapping
    'languages' => [
        'id' => [
            'openai_voice' => 'alloy',
            'google_voice' => 'id-ID-Standard-A',
            'azure_voice' => 'id-ID-GadisNeural',
        ],
        'en' => [
            'openai_voice' => 'alloy',
            'google_voice' => 'en-US-Standard-A',
            'azure_voice' => 'en-US-JennyNeural',
        ],
    ],
]; 