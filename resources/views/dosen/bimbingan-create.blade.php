<link rel="stylesheet" href="{{ asset('css/burnout.css') }}">
<h2>Tambah Bimbingan</h2>

<form method="POST" action="/bimbingan">
    @csrf

    <label>Mahasiswa</label>
    <select name="mahasiswa_id">
        @foreach($mahasiswa as $m)
            <option value="{{ $m->id }}">{{ $m->name }}</option>
        @endforeach
    </select>

    <br><br>

    <label>Catatan</label>
    <textarea name="catatan"></textarea>

    <br><br>

    <button type="submit">Simpan</button>
</form>