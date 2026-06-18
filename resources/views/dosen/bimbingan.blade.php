<link rel="stylesheet" href="{{ asset('css/burnout.css') }}">
<h2>Data Bimbingan</h2>

<a href="/bimbingan/create">+ Tambah</a>

@foreach($bimbingans as $b)
    <p>
        {{ $b->mahasiswa->name }} | {{ $b->catatan }}
    </p>
@endforeach