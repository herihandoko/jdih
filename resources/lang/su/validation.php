<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute kedah ditarima.',
    'accepted_if' => ':attribute kedah ditarima nalika :other sama sareng :value.',
    'active_url' => ':attribute URL teu valid.',
    'after' => ':attribute kedah tanggal saatos :date.',
    'after_or_equal' => ':attribute kedah tanggal saatos atanapi sama sareng :date.',
    'alpha' => ':attribute ngan ukur tiasa dieusi ku aksara.',
    'alpha_dash' => ':attribute ngan ukur tiasa dieusi ku aksara, angka, tanda hubung sareng garis handap.',
    'alpha_num' => ':attribute ngan ukur tiasa dieusi ku aksara sareng angka.',
    'array' => ':attribute kedah mangrupi array.',
    'before' => ':attribute kedah tanggal saméméh :date.',
    'before_or_equal' => ':attribute kedah tanggal saméméh atanapi sama sareng :date.',
    'between' => [
        'numeric' => ':attribute kedah antara :min - :max.',
        'file' => ':attribute kedah antara :min - :max kilobytes.',
        'string' => ':attribute kedah antara :min - :max karakter.',
        'array' => ':attribute kedah antara :min - :max item.',
    ],
    'boolean' => ':attribute kedah bener atanapi lepat.',
    'confirmed' => 'Konfirmasi :attribute teu cocog.',
    'current_password' => 'Sandi teu leres.',
    'date' => ':attribute sanés tanggal anu valid.',
    'date_equals' => ':attribute kedah tanggal anu sama sareng :date.',
    'date_format' => ':attribute teu cocog sareng format :format.',
    'declined' => ':attribute kedah ditolak.',
    'declined_if' => ':attribute kedah ditolak nalika :other sama sareng :value.',
    'different' => ':attribute sareng :other kedah benten.',
    'digits' => ':attribute kedah :digits digit.',
    'digits_between' => ':attribute kedah antara :min sareng :max digit.',
    'dimensions' => 'Ukuran gambar :attribute teu valid.',
    'distinct' => ':attribute gaduh nilai anu duplikat.',
    'email' => ':attribute kedah alamat email anu valid.',
    'ends_with' => ':attribute kedah diakhiran ku: :values.',
    'enum' => ':attribute anu dipilih teu valid.',
    'exists' => ':attribute anu dipilih teu valid.',
    'file' => ':attribute kedah mangrupi file.',
    'filled' => ':attribute kedah gaduh nilai.',
    'gt' => [
        'numeric' => ':attribute kedah langkung ti :value.',
        'file' => ':attribute kedah langkung ti :value kilobytes.',
        'string' => ':attribute kedah langkung ti :value karakter.',
        'array' => ':attribute kedah gaduh langkung ti :value item.',
    ],
    'gte' => [
        'numeric' => ':attribute kedah langkung ti atanapi sama sareng :value.',
        'file' => ':attribute kedah langkung ti atanapi sama sareng :value kilobytes.',
        'string' => ':attribute kedah langkung ti atanapi sama sareng :value karakter.',
        'array' => ':attribute kedah gaduh :value item atanapi langkung.',
    ],
    'image' => ':attribute kedah mangrupi gambar.',
    'in' => ':attribute anu dipilih teu valid.',
    'in_array' => ':attribute teu aya dina :other.',
    'integer' => ':attribute kedah mangrupi bilangan bulat.',
    'ip' => ':attribute kedah alamat IP anu valid.',
    'ipv4' => ':attribute kedah alamat IPv4 anu valid.',
    'ipv6' => ':attribute kedah alamat IPv6 anu valid.',
    'json' => ':attribute kedah string JSON anu valid.',
    'lt' => [
        'numeric' => ':attribute kedah kirang ti :value.',
        'file' => ':attribute kedah kirang ti :value kilobytes.',
        'string' => ':attribute kedah kirang ti :value karakter.',
        'array' => ':attribute kedah gaduh kirang ti :value item.',
    ],
    'lte' => [
        'numeric' => ':attribute kedah kirang ti atanapi sama sareng :value.',
        'file' => ':attribute kedah kirang ti atanapi sama sareng :value kilobytes.',
        'string' => ':attribute kedah kirang ti atanapi sama sareng :value karakter.',
        'array' => ':attribute teu tiasa gaduh langkung ti :value item.',
    ],
    'mac_address' => ':attribute kedah alamat MAC anu valid.',
    'max' => [
        'numeric' => ':attribute teu tiasa langkung ti :max.',
        'file' => ':attribute teu tiasa langkung ti :max kilobytes.',
        'string' => ':attribute teu tiasa langkung ti :max karakter.',
        'array' => ':attribute teu tiasa gaduh langkung ti :max item.',
    ],
    'mimes' => ':attribute kedah file tipe: :values.',
    'mimetypes' => ':attribute kedah file tipe: :values.',
    'min' => [
        'numeric' => ':attribute kedah minimal :min.',
        'file' => ':attribute kedah minimal :min kilobytes.',
        'string' => ':attribute kedah minimal :min karakter.',
        'array' => ':attribute kedah minimal gaduh :min item.',
    ],
    'multiple_of' => ':attribute kedah kelipatan ti :value.',
    'not_in' => ':attribute anu dipilih teu valid.',
    'not_regex' => 'Format :attribute teu valid.',
    'numeric' => ':attribute kedah mangrupi angka.',
    'password' => 'Sandi teu leres.',
    'present' => ':attribute kedah aya.',
    'prohibited' => ':attribute dilarang.',
    'prohibited_if' => ':attribute dilarang nalika :other sama sareng :value.',
    'prohibited_unless' => ':attribute dilarang kecuali :other aya dina :values.',
    'prohibits' => ':attribute ngalarang :other kanggo aya.',
    'regex' => 'Format :attribute teu valid.',
    'required' => ':attribute kedah diisi.',
    'required_array_keys' => ':attribute kedah ngandung entri pikeun: :values.',
    'required_if' => ':attribute kedah diisi nalika :other sama sareng :value.',
    'required_unless' => ':attribute kedah diisi kecuali :other aya dina :values.',
    'required_with' => ':attribute kedah diisi nalika :values aya.',
    'required_with_all' => ':attribute kedah diisi nalika :values aya.',
    'required_without' => ':attribute kedah diisi nalika :values teu aya.',
    'required_without_all' => ':attribute kedah diisi nalika teu aya :values.',
    'same' => ':attribute sareng :other kedah sama.',
    'size' => [
        'numeric' => ':attribute kedah :size.',
        'file' => ':attribute kedah :size kilobytes.',
        'string' => ':attribute kedah :size karakter.',
        'array' => ':attribute kedah ngandung :size item.',
    ],
    'starts_with' => ':attribute kedah dimimitian ku: :values.',
    'string' => ':attribute kedah string.',
    'timezone' => ':attribute kedah zona waktu anu valid.',
    'unique' => ':attribute tos dianggo.',
    'uploaded' => ':attribute gagal diunggah.',
    'url' => ':attribute kedah URL anu valid.',
    'uuid' => ':attribute kedah UUID anu valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],
]; 