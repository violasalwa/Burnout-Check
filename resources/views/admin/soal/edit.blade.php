@extends('layouts.app')

@section('title', 'Edit Soal')

@section('styles')
<style>
/* ============================================================
   admin/soal/edit.blade.php — Custom CSS
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
    gap: 1.35rem;
}

/* Field group */
.field-group {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
}

/* Baris tombol */
.form-actions {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding-top: 1.25rem;
    border-top: 1px solid var(--g2);
}

/* ── LABEL ────────────────────────────────────────────────── */
label {
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--g8);
    letter-spacing: 0.06em;
    text-transform: uppercase;
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
.form-control::placeholder { color: var(--g4); }

textarea.form-control {
    min-height: 120px;
    resize: vertical;
    line-height: 1.6;
}

select.form-control {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239aa3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.9em center;
    padding-right: 2.5em;
    cursor: pointer;
}

.form-control.is-invalid {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}
.invalid-feedback {
    font-size: 0.78rem;
    color: #dc2626;
    font-weight: 500;
}

/* ── BUTTON ──────────────────────────────────────────────── */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    border-radius: var(--r-sm);
    font-size: 0.88rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    white-space: nowrap;
    font-family: inherit;
    transition: background var(--tr), box-shadow var(--tr), transform var(--tr);
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    color: var(--wh);
    box-shadow: 0 2px 8px rgba(40, 114, 232, 0.25);

    /* ── Ukuran fixed di sini, bukan di .form-actions ── */
    width: 130px;
    height: 42px;
    padding: 0;
    border: 2px solid transparent; /* ← semua btn punya border, tapi transparan */
    box-sizing: border-box;
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
    border: 2px solid var(--bl4); /* ← sama tebal dengan border transparan di .btn */
    box-shadow: none;
}
.btn-back:hover {
    background: var(--bl0);
    border-color: var(--bl5);
    color: var(--bl7);
    box-shadow: none;
    transform: translateY(-1px);
}

/* ── BUTTON ROW ──────────────────────────────────────────── */
.form-actions {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding-top: 1.25rem;
    border-top: 1px solid var(--g2);
}

/* ── RESPONSIVE ──────────────────────────────────────────── */
@media (max-width: 768px) {
    h1 { margin-bottom: 1.25rem; }
    .card { padding: 1.35rem; max-width: 100%; }
    .form-actions {
        flex-direction: column;
        align-items: stretch;
    }
    .form-actions .btn {
        max-width: 100%;
        width: 100%;
        padding: 0.75em 1.25em;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .card { max-width: 100%; padding: 1.75rem; }
}
</style>
@endsection

@section('content')
<h1>Edit Soal</h1>

<div class="card">
    <form method="POST" action="{{ route('admin.soal.update', $soal->id) }}">
        @csrf
        @method('PUT')

        <!-- Pertanyaan -->
        <div class="field-group">
            <label for="pertanyaan">Pertanyaan</label>
            <textarea id="pertanyaan" name="pertanyaan"
                      class="form-control {{ $errors->has('pertanyaan') ? 'is-invalid' : '' }}"
                      required>{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
            @error('pertanyaan')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Kategori -->
        <div class="field-group">
            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori"
                    class="form-control {{ $errors->has('kategori') ? 'is-invalid' : '' }}"
                    required>
                <option value="" disabled {{ old('kategori', $soal->kategori) ? '' : 'selected' }}>Pilih kategori</option>
                @php
                    $categories = ['Exhaustion', 'Mental Distance', 'Cognitive Impairment', 'Emotional Impairment', 'Psychological Distress', 'Psychosomatic Complaints'];
                @endphp
                @foreach ($categories as $category)
                    <option value="{{ $category }}" {{ old('kategori', $soal->kategori) == $category ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>
            @error('kategori')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Status -->
        <div class="field-group">
            <label for="is_active">Status</label>
            <select id="is_active" name="is_active"
                    class="form-control {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                <option value="1" {{ old('is_active', $soal->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('is_active', $soal->is_active) == '0' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            @error('is_active')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tombol -->
        <div class="form-actions">
            <button type="submit" class="btn">Update</button>
            <a href="{{ route('admin.soal.index') }}" class="btn btn-back">Kembali</a>
        </div>

    </form>
</div>

@endsection