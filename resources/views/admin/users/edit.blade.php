@extends('layouts.app')

@section('title', 'Edit User')

@section('styles')
<style>
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
    --sh-md: 0 4px 16px rgba(40,114,232,0.10);
    --tr  : 0.22s cubic-bezier(.4,0,.2,1);
}

/* ── PAGE TITLE ──────────────────────────────────────────── */
h1 {
    font-size: clamp(1.35rem, 3vw, 1.9rem);
    font-weight: 800;
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

/* ── FORM CARD ───────────────────────────────────────────── */
.form-card {
    background: var(--wh);
    border-radius: var(--r-lg);
    padding: 2rem;
    box-shadow: var(--sh-md);
    border: 1px solid var(--bl1);
    max-width: 640px;
}

/* ── ALERT ───────────────────────────────────────────────── */
.alert-error {
    display: flex;
    gap: 0.75rem;
    align-items: flex-start;
    background: #fff1f2;
    border: 1px solid #fecaca;
    border-left: 4px solid #dc2626;
    border-radius: var(--r-sm);
    padding: 0.9rem 1rem;
    margin-bottom: 1.5rem;
    max-width: 640px;
}
.alert-error__icon {
    width: 22px; height: 22px;
    background: #dc2626;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.78rem;
    font-weight: 700;
    flex-shrink: 0;
}
.alert-error__text {
    font-size: 0.82rem;
    color: #991b1b;
    line-height: 1.6;
}

/* ── FORM GRID ───────────────────────────────────────────── */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
}

.form-group--full { grid-column: 1 / -1; }

/* ── LABEL ───────────────────────────────────────────────── */
.form-label {
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--g6);
    letter-spacing: 0.05em;
    text-transform: uppercase;
}

/* ── INPUT / SELECT ──────────────────────────────────────── */
.form-control {
    width: 100%;
    height: 42px;
    padding: 0 0.9rem;
    border-radius: var(--r-sm);
    border: 1.5px solid var(--g2);
    background: var(--g1);
    font-size: 0.9rem;
    font-family: inherit;
    color: var(--g8);
    outline: none;
    transition: border-color var(--tr), background var(--tr), box-shadow var(--tr);
    appearance: none;
    -webkit-appearance: none;
}
.form-control:focus {
    border-color: var(--bl4);
    background: var(--wh);
    box-shadow: 0 0 0 3px rgba(40,114,232,0.12);
}
.form-control::placeholder { color: var(--g4); }

/* Readonly */
.form-control--readonly {
    color: var(--g4);
    background: var(--g2);
    cursor: not-allowed;
}
.form-control--readonly:focus {
    border-color: var(--g2);
    box-shadow: none;
}

/* Error state */
.form-control.is-invalid {
    border-color: #dc2626;
    background: #fff5f5;
}
.invalid-feedback {
    font-size: 0.75rem;
    color: #dc2626;
    font-weight: 500;
}

/* ── SELECT WRAPPER ──────────────────────────────────────── */
.select-wrap { position: relative; }
.select-wrap .form-control { padding-right: 2.25rem; cursor: pointer; }
.select-wrap::after {
    content: '';
    position: absolute;
    right: 0.9rem;
    top: 50%;
    transform: translateY(-50%);
    width: 0; height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid var(--g4);
    pointer-events: none;
}

/* ── INPUT ICON WRAPPER ──────────────────────────────────── */
.input-wrap { position: relative; }
.input-wrap .form-control { padding-left: 2.4rem; }
.input-wrap .input-icon {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    width: 16px; height: 16px;
    stroke: var(--g4);
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
    pointer-events: none;
    transition: stroke var(--tr);
}
.input-wrap:focus-within .input-icon { stroke: var(--bl5); }

/* ── HINT TEXT ───────────────────────────────────────────── */
.form-hint {
    font-size: 0.75rem;
    color: var(--g4);
}

/* ── DIVIDER ─────────────────────────────────────────────── */
.form-divider {
    grid-column: 1 / -1;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--g4);
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    margin: 0.25rem 0;
}
.form-divider::before,
.form-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--g2);
}

/* ── ACTIONS ─────────────────────────────────────────────── */
.form-actions {
    grid-column: 1 / -1;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-top: 0.5rem;
    padding-top: 1.25rem;
    border-top: 1px solid var(--g2);
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    height: 42px;
    padding: 0 1.5em;
    border-radius: var(--r-sm);
    font-size: 0.88rem;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    border: none;
    white-space: nowrap;
    font-family: inherit;
    transition: background var(--tr), box-shadow var(--tr), transform var(--tr);
}

.btn-primary {
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    color: var(--wh);
    box-shadow: 0 3px 12px rgba(40,114,232,0.30);
}
.btn-primary:hover {
    background: linear-gradient(135deg, var(--bl7), var(--bl5));
    box-shadow: 0 5px 18px rgba(40,114,232,0.40);
    transform: translateY(-1px);
    color: var(--wh);
}
.btn-primary:active { transform: translateY(0); }

.btn-secondary {
    background: var(--wh);
    color: var(--g6);
    border: 1.5px solid var(--g2);
}
.btn-secondary:hover {
    background: var(--g1);
    border-color: var(--g4);
    color: var(--g8);
}

.btn svg {
    width: 15px; height: 15px;
    stroke: currentColor; fill: none;
    stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
}

/* ── RESPONSIVE ──────────────────────────────────────────── */
@media (max-width: 600px) {
    .form-card { padding: 1.25rem; }
    .form-grid { grid-template-columns: 1fr; }
    .form-group--full,
    .form-divider,
    .form-actions { grid-column: 1; }
    .form-actions { flex-direction: column; }
    .form-actions .btn { width: 100%; justify-content: center; }
}
</style>
@endsection

@section('content')

<h1>Edit User</h1>

{{-- Alert Error --}}
@if ($errors->any())
<div class="alert-error">
    <div class="alert-error__icon">!</div>
    <div>
        @foreach ($errors->all() as $error)
            <div class="alert-error__text">{{ $error }}</div>
        @endforeach
    </div>
</div>
@endif

<div class="form-card">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="form-grid">

            {{-- Nama --}}
            <div class="form-group form-group--full">
                <label class="form-label" for="name">Nama Lengkap</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    <input type="text"
                           id="name"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Masukkan nama lengkap"
                           value="{{ old('name', $user->name) }}"
                           required>
                </div>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email (readonly) --}}
            <div class="form-group form-group--full">
                <label class="form-label" for="email">Email</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    <input type="email"
                           id="email"
                           name="email"
                           class="form-control form-control--readonly"
                           value="{{ old('email', $user->email) }}"
                           readonly>
                </div>
                <span class="form-hint">Email tidak dapat diubah</span>
            </div>

            {{-- Password --}}
            <div class="form-group form-group--full">
                <label class="form-label" for="password">Password Baru</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                    <input type="password"
                           id="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Kosongkan jika tidak ingin mengubah">
                </div>
                <span class="form-hint">Minimal 8 karakter</span>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Divider --}}
            <div class="form-divider">Informasi Akademik</div>

            {{-- Role --}}
            <div class="form-group">
                <label class="form-label" for="role">Role</label>
                <div class="select-wrap">
                    <select id="role"
                            name="role"
                            class="form-control @error('role') is-invalid @enderror"
                            required>
                        <option value="admin"     {{ old('role', $user->role) === 'admin'     ? 'selected' : '' }}>Admin</option>
                        <option value="dosen"     {{ old('role', $user->role) === 'dosen'     ? 'selected' : '' }}>Dosen</option>
                        <option value="kaprodi"   {{ old('role', $user->role) === 'kaprodi'   ? 'selected' : '' }}>Kaprodi</option>
                        <option value="mahasiswa" {{ old('role', $user->role) === 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    </select>
                </div>
                @error('role')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- NIM --}}
            <div class="form-group">
                <label class="form-label" for="nim">NIM</label>
                <input id="nim"
                       name="nim"
                       type="text"
                       class="form-control @error('nim') is-invalid @enderror"
                       placeholder="Contoh: 123456789"
                       value="{{ old('nim', $user->nim) }}">
                @error('nim')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- IPK --}}
            <div class="form-group">
                <label class="form-label" for="ipk">IPK</label>
                <input id="ipk"
                       name="ipk"
                       type="number" step="0.01" min="0" max="4"
                       class="form-control @error('ipk') is-invalid @enderror"
                       placeholder="Contoh: 3.75"
                       value="{{ old('ipk', $user->ipk) }}">
                @error('ipk')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Kelas --}}
            <div class="form-group">
                <label class="form-label" for="kelas">Kelas</label>
                <div class="select-wrap">
                    <select id="kelas"
                            name="kelas"
                            class="form-control @error('kelas') is-invalid @enderror">
                        <option value="" {{ old('kelas', $user->kelas) == '' ? 'selected' : '' }}>
                            Tidak menggunakan kelas
                        </option>
                        <option value="5" {{ old('kelas', $user->kelas) == 5 ? 'selected' : '' }}>
                            Kelas A
                        </option>
                        <option value="6" {{ old('kelas', $user->kelas) == 6 ? 'selected' : '' }}>
                            Kelas B
                        </option>
                        <option value="7" {{ old('kelas', $user->kelas) == 7 ? 'selected' : '' }}>
                            Kelas C
                        </option>
                        <option value="8" {{ old('kelas', $user->kelas) == 8 ? 'selected' : '' }}>
                            Kelas D
                        </option>
                        <option value="9" {{ old('kelas', $user->kelas) == 9 ? 'selected' : '' }}>
                            Kelas E
                        </option>
                    </select>
                </div>
                <span class="form-hint">Kosongkan untuk admin, dosen, atau kaprodi</span>
                @error('kelas')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Angkatan --}}
            <div class="form-group">
                <label class="form-label" for="angkatan">Angkatan</label>
                <input id="angkatan"
                       name="angkatan"
                       type="text"
                       inputmode="numeric"
                       pattern="[0-9]*"
                       class="form-control @error('angkatan') is-invalid @enderror"
                       placeholder="Contoh: 2023"
                       value="{{ old('angkatan', $user->angkatan) }}">
                @error('angkatan')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Dosen Pembimbing --}}
            <div class="form-group">
                <label class="form-label" for="dosen_id">Dosen Pembimbing</label>
                <div class="select-wrap">
                        <select id="dosen_id"
                            name="dosen_id"
                            class="form-control @error('dosen_id') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        @foreach ($dosenList as $dosen)
                            <option value="{{ $dosen->id }}" {{ old('dosen_id', $user->dosen_id) == $dosen->id ? 'selected' : '' }}>{{ $dosen->nama }} ({{ ucfirst($dosen->jabatan) }})</option>
                        @endforeach
                    </select>
                </div>
                @error('dosen_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <svg viewBox="0 0 24 24">
                        <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var kelas = document.getElementById('kelas');
    var dosen = document.getElementById('dosen_id');
    var role = document.getElementById('role');
    var nim = document.getElementById('nim');
    var ipk = document.getElementById('ipk');
    var angkatan = document.getElementById('angkatan');
    if (!kelas || !dosen || !role) return;

    function enableDosen() {
        dosen.disabled = false;
        dosen.required = true;
        dosen.style.opacity = '';
        dosen.removeAttribute('aria-disabled');
    }

    function refreshFieldsByRole() {
        if (role.value !== 'mahasiswa') {
            kelas.disabled = true;
            kelas.required = false;
            kelas.value = '';
            kelas.style.opacity = '0.6';

            dosen.disabled = true;
            dosen.required = false;
            dosen.value = '';
            dosen.style.opacity = '0.6';
            dosen.setAttribute('aria-disabled', 'true');

            if(nim) { nim.disabled = true; nim.style.opacity = '0.6'; nim.value = ''; }
            if(ipk) { ipk.disabled = true; ipk.style.opacity = '0.6'; ipk.value = ''; }
            if(angkatan) { angkatan.disabled = true; angkatan.style.opacity = '0.6'; angkatan.value = ''; }
        } else {
            kelas.disabled = false;
            kelas.required = true;
            kelas.style.opacity = '';
            kelas.removeAttribute('aria-disabled');

            if(nim) { nim.disabled = false; nim.style.opacity = ''; }
            if(ipk) { ipk.disabled = false; ipk.style.opacity = ''; }
            if(angkatan) { angkatan.disabled = false; angkatan.style.opacity = ''; }

            enableDosen();
        }
    }

    role.addEventListener('change', refreshFieldsByRole);
    kelas.addEventListener('change', function () { if (role.value === 'mahasiswa') enableDosen(); });
    refreshFieldsByRole();
});
</script>
@endsection