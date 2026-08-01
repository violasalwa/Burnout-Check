<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa Validasi
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut berisi tata kalimat kesalahan default yang digunakan
    | oleh kelas pemvalidasi (validator). Beberap aturan memiliki beberapa versi
    | seperti aturan ukuran. Silakan sesuaikan setiap pesan di sini.
    |
    */

    'accepted'             => ':attribute harus disetujui.',
    'accepted_if'          => ':attribute harus disetujui ketika :other adalah :value.',
    'active_url'           => ':attribute bukan URL yang valid.',
    'after'                => ':attribute harus berupa tanggal setelah :date.',
    'after_or_equal'       => ':attribute harus berupa tanggal setelah atau sama dengan :date.',
    'alpha'                => ':attribute hanya boleh berisi huruf.',
    'alpha_dash'           => ':attribute hanya boleh berisi huruf, angka, strip, dan garis bawah.',
    'alpha_num'            => ':attribute hanya boleh berisi huruf dan angka.',
    'array'                => ':attribute harus berupa array.',
    'ascii'                => ':attribute hanya boleh berisi karakter alfanumerik dan simbol single-byte.',
    'before'               => ':attribute harus berupa tanggal sebelum :date.',
    'before_or_equal'      => ':attribute harus berupa tanggal sebelum atau sama dengan :date.',
    'between'              => [
        'array'   => ':attribute harus memiliki antara :min dan :max item.',
        'file'    => 'Ukuran :attribute harus antara :min dan :max kilobita.',
        'numeric' => ':attribute harus bernilai antara :min dan :max.',
        'string'  => ':attribute harus terdiri dari :min sampai :max karakter.',
    ],
    'boolean'              => ':attribute harus bernilai true atau false.',
    'can'                  => ':attribute mengandung nilai yang tidak diizinkan.',
    'confirmed'            => 'Konfirmasi :attribute tidak cocok.',
    'current_password'     => 'Password yang Anda masukkan salah.',
    'date'                 => ':attribute bukan tanggal yang valid.',
    'date_equals'          => ':attribute harus berupa tanggal yang sama dengan :date.',
    'date_format'          => ':attribute harus cocok dengan format :format.',
    'decimal'              => ':attribute harus memiliki :decimal tempat desimal.',
    'declined'             => ':attribute harus ditolak.',
    'declined_if'          => ':attribute harus ditolak ketika :other adalah :value.',
    'different'            => ':attribute dan :other harus berbeda.',
    'digits'               => ':attribute harus terdiri dari :digits digit angka.',
    'digits_between'       => ':attribute harus terdiri dari :min sampai :max digit angka.',
    'dimensions'           => ':attribute memiliki dimensi gambar yang tidak valid.',
    'distinct'             => ':attribute memiliki nilai duplikat.',
    'doesnt_end_with'      => ':attribute tidak boleh diakhiri dengan salah satu dari berikut: :values.',
    'doesnt_start_with'    => ':attribute tidak boleh diawali dengan salah satu dari berikut: :values.',
    'email'                => 'Format :attribute tidak valid.',
    'ends_with'            => ':attribute harus diakhiri dengan salah satu dari berikut: :values.',
    'enum'                 => ':attribute yang dipilih tidak valid.',
    'exists'               => ':attribute yang dipilih tidak valid.',
    'extensions'           => ':attribute harus memiliki salah satu ekstensi berikut: :values.',
    'file'                 => ':attribute harus berupa berkas.',
    'filled'               => ':attribute harus memiliki nilai.',
    'gt'                   => [
        'array'   => ':attribute harus memiliki lebih dari :value item.',
        'file'    => 'Ukuran :attribute harus lebih besar dari :value kilobita.',
        'numeric' => ':attribute harus lebih besar dari :value.',
        'string'  => ':attribute harus lebih panjang dari :value karakter.',
    ],
    'gte'                  => [
        'array'   => ':attribute harus memiliki :value item atau lebih.',
        'file'    => 'Ukuran :attribute harus lebih besar dari atau sama dengan :value kilobita.',
        'numeric' => ':attribute harus lebih besar dari atau sama dengan :value.',
        'string'  => ':attribute harus lebih panjang dari atau sama dengan :value karakter.',
    ],
    'hex_color'            => ':attribute harus berupa warna heksadesimal yang valid.',
    'image'                => ':attribute harus berupa gambar.',
    'in'                   => ':attribute yang dipilih tidak valid.',
    'in_array'             => ':attribute tidak ada di dalam :other.',
    'integer'              => ':attribute harus berupa bilangan bulat.',
    'ip'                   => ':attribute harus berupa alamat IP yang valid.',
    'ipv4'                 => ':attribute harus berupa alamat IPv4 yang valid.',
    'ipv6'                 => ':attribute harus berupa alamat IPv6 yang valid.',
    'json'                 => ':attribute harus berupa string JSON yang valid.',
    'lowercase'            => ':attribute harus berupa huruf kecil.',
    'lt'                   => [
        'array'   => ':attribute harus memiliki kurang dari :value item.',
        'file'    => 'Ukuran :attribute harus kurang dari :value kilobita.',
        'numeric' => ':attribute harus kurang dari :value.',
        'string'  => ':attribute harus kurang dari :value karakter.',
    ],
    'lte'                  => [
        'array'   => ':attribute tidak boleh memiliki lebih dari :value item.',
        'file'    => 'Ukuran :attribute harus kurang dari atau sama dengan :value kilobita.',
        'numeric' => ':attribute harus kurang dari atau sama dengan :value.',
        'string'  => ':attribute harus kurang dari atau sama dengan :value karakter.',
    ],
    'mac_address'          => ':attribute harus berupa alamat MAC yang valid.',
    'max'                  => [
        'array'   => ':attribute tidak boleh memiliki lebih dari :max item.',
        'file'    => 'Ukuran :attribute tidak boleh lebih dari :max kilobita.',
        'numeric' => ':attribute tidak boleh lebih dari :max.',
        'string'  => ':attribute maksimal :max karakter.',
    ],
    'max_digits'           => ':attribute tidak boleh memiliki lebih dari :max digit.',
    'mimes'                => ':attribute harus berupa berkas bertipe: :values.',
    'mimetypes'            => ':attribute harus berupa berkas bertipe: :values.',
    'min'                  => [
        'array'   => ':attribute minimal harus memiliki :min item.',
        'file'    => 'Ukuran :attribute minimal harus :min kilobita.',
        'numeric' => ':attribute minimal harus bernilai :min.',
        'string'  => ':attribute minimal harus terdiri dari :min karakter.',
    ],
    'min_digits'           => ':attribute minimal harus memiliki :min digit.',
    'missing'              => ':attribute tidak boleh ada.',
    'missing_if'           => ':attribute tidak boleh ada ketika :other adalah :value.',
    'missing_unless'       => ':attribute tidak boleh ada kecuali :other adalah :value.',
    'missing_with'         => ':attribute tidak boleh ada ketika :values ada.',
    'missing_with_all'     => ':attribute tidak boleh ada ketika :values ada.',
    'multiple_of'          => ':attribute harus berupa kelipatan dari :value.',
    'not_in'               => ':attribute yang dipilih tidak valid.',
    'not_regex'            => 'Format :attribute tidak valid.',
    'numeric'              => ':attribute harus berupa angka.',
    'password'             => [
        'letters'       => ':attribute harus mengandung setidaknya satu huruf.',
        'mixed'         => ':attribute harus mengandung setidaknya satu huruf besar dan satu huruf kecil.',
        'numbers'       => ':attribute harus mengandung setidaknya satu angka.',
        'symbols'       => ':attribute harus mengandung setidaknya satu simbol.',
        'uncompromised' => ':attribute yang dimasukkan pernah terdeteksi dalam kebocoran data. Silakan pilih :attribute lain.',
    ],
    'present'              => ':attribute harus ada.',
    'present_if'           => ':attribute harus ada ketika :other adalah :value.',
    'present_unless'       => ':attribute harus ada kecuali :other adalah :value.',
    'present_with'         => ':attribute harus ada ketika :values ada.',
    'present_with_all'     => ':attribute harus ada ketika :values ada.',
    'prohibited'           => ':attribute dilarang diisi.',
    'prohibited_if'        => ':attribute dilarang diisi ketika :other adalah :value.',
    'prohibited_unless'    => ':attribute dilarang diisi kecuali :other ada di dalam :values.',
    'prohibits'            => ':attribute melarang :other untuk ada.',
    'regex'                => 'Format :attribute tidak valid.',
    'required'             => ':attribute wajib diisi.',
    'required_array_keys'  => ':attribute harus berisi entri untuk: :values.',
    'required_if'          => ':attribute wajib diisi ketika :other adalah :value.',
    'required_if_accepted' => ':attribute wajib diisi ketika :other disetujui.',
    'required_unless'      => ':attribute wajib diisi kecuali :other ada di dalam :values.',
    'required_with'        => ':attribute wajib diisi ketika :values ada.',
    'required_with_all'    => ':attribute wajib diisi ketika :values ada.',
    'required_without'     => ':attribute wajib diisi ketika :values tidak ada.',
    'required_without_all' => ':attribute wajib diisi ketika tidak ada :values yang ada.',
    'same'                 => ':attribute dan :other harus sama.',
    'size'                 => [
        'array'   => ':attribute harus mengandung :size item.',
        'file'    => 'Ukuran :attribute harus :size kilobita.',
        'numeric' => ':attribute harus bernilai :size.',
        'string'  => ':attribute harus terdiri dari :size karakter.',
    ],
    'starts_with'          => ':attribute harus diawali dengan salah satu dari berikut: :values.',
    'string'               => ':attribute harus berupa teks.',
    'timezone'             => ':attribute harus berupa zona waktu yang valid.',
    'unique'               => ':attribute sudah terdaftar. Silakan gunakan :attribute lain.',
    'uploaded'             => ':attribute gagal diunggah.',
    'uppercase'            => ':attribute harus berupa huruf besar.',
    'url'                  => 'Format :attribute tidak valid.',
    'ulid'                 => ':attribute harus berupa ULID yang valid.',
    'uuid'                 => ':attribute harus berupa UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Kustomisasi Pesan Validasi
    |--------------------------------------------------------------------------
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'pesan-kustom',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atribut Validasi Kustom
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk menukar tempat penampung atribut kami
    | dengan sesuatu yang lebih ramah pembaca seperti "Alamat E-Mail" daripada
    | "email". Ini membantu kami membuat pesan kami lebih ekspresif.
    |
    */

    'attributes' => [
        'name'                  => 'Nama Lengkap',
        'email'                 => 'Email',
        'password'              => 'Password',
        'password_confirmation' => 'Konfirmasi Password',
        'current_password'      => 'Password Saat Ini',
        'role'                  => 'Peran',
        'kelas'                 => 'Kelas',
        'angkatan'              => 'Angkatan',
        'dosen_id'              => 'Dosen Pembimbing',
        'pertanyaan'            => 'Pertanyaan',
        'kategori'              => 'Kategori',
        'is_active'             => 'Status Aktif',
        'nama_level'            => 'Nama Level Risiko',
        'skor_min'              => 'Skor Minimal',
        'skor_max'              => 'Skor Maksimal',
        'deskripsi'             => 'Deskripsi',
        'jawaban'               => 'Jawaban',
        'catatan'               => 'Catatan Bimbingan',
        'mahasiswa_id'          => 'Mahasiswa',
    ],

];
