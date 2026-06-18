@extends('layouts.app')

@section('title', 'Tambah Level Risiko')

@section('styles')
<style>
/* ============================================================
   admin/risk-levels/create.blade.php — Custom CSS
   Theme  : Blue & White | Elegant Gradient | Modern Responsive
   ============================================================ */

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --bl9 : #0d2d6b;
    --bl7 : #1a4fad;
    --bl5 : #2872e8;
    --bl4 : #4d8ef5;
    --bl1 : #dce8fd;
    --bl0 : #f0f5ff;
    --wh  : #ffffff;
    --g1  : #f4f6fb;
    --g2  : #e8ecf4;
    --g4  : #9aa3b8;
    --g6  : #5a6278;
    --g8  : #2c3249;
    --r-sm: 8px;
    --r-lg: 20px;
    --sh-md: 0 4px 16px rgba(40, 114, 232, 0.12);
    --sh-lg: 0 8px 32px rgba(40, 114, 232, 0.18);
    --tr  : 0.22s cubic-bezier(.4, 0, .2, 1);
}

/* ── PAGE TITLE ──────────────────────────────────────────── */
h1 {
    font-size: clamp(1.35rem, 3vw, 1.9rem);
    font-weight: 700;
    color: var(--bl9);
    letter-spacing: -0.02em;
    padding-bottom: 0.6rem;
    border-bottom: 3px solid var(--bl1);
    position: relative;
    margin-bottom: 1.75rem;
}
h1::after {
    content: '';
    position: absolute;
    left: 0; bottom: -3px;
    width: 56px; height: 3px;
    background: linear-gradient(90deg, var(--bl5), var(--bl4));
    border-radius: 2px;
}

/* ── CARD ────────────────────────────────────────────────── */
.card {
    background: var(--wh);
    border-radius: var(--r-lg);
    padding: 2rem;
    box-shadow: var(--sh-md);
    border: 1px solid var(--bl1);
    max-width: 680px;
    transition: box-shadow var(--tr), transform var(--tr);
}
.card:hover {
    box-shadow: var(--sh-lg);
    transform: translateY(-2px);
}

/* ── FORM ────────────────────────────────────────────────── */
form {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}
form br { display: none; }

/* Field group: label + input */
.field-group {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}

.field-label {
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--g8);
    letter-spacing: 0.06em;
    text-transform: uppercase;
}

/* Skor min & max sejajar */
.skor-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

/* Tombol aksi */
.form-actions {
    display: flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important;
    align-items: center !important;
    justify-content: flex-start !important;
    gap: 0.75rem;
    padding-top: 1.25rem;
    border-top: 1px solid var(--g2);
    margin-top: 0.25rem;
    width: 100%;
}

.form-actions .btn {
    min-width: 120px;
    height: 40px;
    padding: 0 1.5em;
    flex-shrink: 0;
    flex-grow: 0;
    width: auto !important;
}

/* ── FORM CONTROL ────────────────────────────────────────── */
.form-control {
    width: 100%;
    padding: 0.65em 0.9em;
    border: 1.5px solid var(--g2);
    border-radius: var(--r-sm);
    font-size: 0.9rem;
    font-family: inherit;
    color: var(--g8);
    background: var(--wh);
    outline: none;
    transition: border-color var(--tr), box-shadow var(--tr), background var(--tr);
    appearance: none;
    -webkit-appearance: none;
}
.form-control:hover { border-color: var(--bl4); background: var(--bl0); }
.form-control:focus {
    border-color: var(--bl5);
    box-shadow: 0 0 0 3px rgba(40, 114, 232, 0.12);
    background: var(--wh);
}
.form-control::placeholder { color: var(--g4); font-size: 0.88rem; }

textarea.form-control {
    min-height: 110px;
    resize: vertical;
    line-height: 1.6;
}

input[type="number"].form-control::-webkit-inner-spin-button,
input[type="number"].form-control::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type="number"].form-control { -moz-appearance: textfield; }

.form-control.is-invalid {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}
.invalid-feedback { font-size: 0.78rem; color: #dc2626; font-weight: 500; }

/* ── BUTTON ──────────────────────────────────────────────── */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    padding: 0.6em 1.5em;
    border-radius: var(--r-sm);
    font-size: 0.88rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    border: none;
    white-space: nowrap;
    font-family: inherit;
    transition: background var(--tr), box-shadow var(--tr), transform var(--tr);
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    color: var(--wh);
    box-shadow: 0 2px 8px rgba(40, 114, 232, 0.25);
}
.btn:hover {
    background: linear-gradient(135deg, var(--bl7), var(--bl5));
    box-shadow: 0 4px 14px rgba(40, 114, 232, 0.38);
    transform: translateY(-1px);
    color: var(--wh);
}
.btn:active { transform: translateY(0); }

/* Kembali — outline biru */
.btn-back {
    background: transparent;
    color: var(--bl5);
    border: 1.5px solid var(--bl4);
    box-shadow: none;
}
.btn-back:hover {
    background: var(--bl0);
    border-color: var(--bl5);
    color: var(--bl7);
    box-shadow: none;
    transform: translateY(-1px);
}

/* ── RESPONSIVE ──────────────────────────────────────────── */
@media (max-width: 768px) {
    h1 { margin-bottom: 1.25rem; }
    .card { padding: 1.35rem; max-width: 100%; }
    .skor-row { grid-template-columns: 1fr; }
    .form-actions { flex-direction: column; align-items: stretch; }
    .form-actions .btn { width: 100%; justify-content: center; padding: 0.75em 1.25em; }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .card { max-width: 100%; padding: 1.75rem; }
}
</style>
@endsection

@section('content')
<h1>Tambah Level Risiko</h1>

<div class="card">
    <form method="POST" action="{{ route('admin.risk-levels.store') }}">
        @csrf

        {{-- Nama Level --}}
        <div class="field-group">
            <label class="field-label">Nama Level</label>
            <input name="nama_level"
                   placeholder="Contoh: Rendah, Sedang, Tinggi"
                   class="form-control {{ $errors->has('nama_level') ? 'is-invalid' : '' }}"
                   value="{{ old('nama_level') }}">
            @error('nama_level')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Skor Min & Max --}}
        <div class="skor-row">
            <div class="field-group">
                <label class="field-label">Skor Minimal</label>
                <input name="skor_min" type="number"
                       placeholder="0"
                       class="form-control {{ $errors->has('skor_min') ? 'is-invalid' : '' }}"
                       value="{{ old('skor_min') }}">
                @error('skor_min')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="field-group">
                <label class="field-label">Skor Maksimal</label>
                <input name="skor_max" type="number"
                       placeholder="100"
                       class="form-control {{ $errors->has('skor_max') ? 'is-invalid' : '' }}"
                       value="{{ old('skor_max') }}">
                @error('skor_max')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="field-group">
            <label class="field-label">Deskripsi</label>
            <textarea name="deskripsi"
                      placeholder="Deskripsi level risiko..."
                      class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="form-actions">
            <button type="submit" class="btn">Simpan</button>
            <a href="{{ route('admin.risk-levels.index') }}" class="btn btn-back">Kembali</a>
        </div>

    </form>
</div>
@endsection