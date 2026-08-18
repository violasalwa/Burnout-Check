@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('styles')
<style>
/* ============================================================
   admin/users/index.blade.php — Custom CSS
   Theme  : Blue & White | Elegant Gradient | Modern Responsive
   ============================================================ */

*, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

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
    padding: 1.75rem;
    box-shadow: var(--sh-md);
    border: 1px solid var(--bl1);
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
    margin-bottom: 1.75rem;
    transition: box-shadow var(--tr), transform var(--tr);
}
.card:hover {
    box-shadow: var(--sh-lg);
    transform: translateY(-2px);
}

/* Card pertama — tombol tambah */
.card:first-of-type {
    flex-direction: row;
    flex-wrap: wrap;
    align-items: center;
    padding: 1.25rem 1.75rem;
    background: linear-gradient(135deg, var(--bl9) 0%, var(--bl7) 100%);
    border-color: transparent;
}
.card:first-of-type:hover { transform: none; }

/* Card terakhir — tombol kembali */
.card-footer-cta {
    flex-direction: row !important;
    flex-wrap: wrap;
    align-items: center;
    padding: 1.25rem 1.75rem !important;
    background: linear-gradient(135deg, var(--bl9) 0%, var(--bl7) 100%) !important;
    border-color: transparent !important;
}
.card-footer-cta:hover { transform: none !important; }

/* ── TABLE ───────────────────────────────────────────────── */
.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.88rem;
}
.table thead tr {
    background: linear-gradient(90deg, var(--bl9), var(--bl7));
}
.table thead th {
    padding: 0.85rem 1rem;
    color: var(--wh);
    font-weight: 600;
    text-align: left;
    font-size: 0.78rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    white-space: nowrap;
}
.table thead th:first-child { border-radius: var(--r-sm) 0 0 var(--r-sm); }
.table thead th:last-child  { border-radius: 0 var(--r-sm) var(--r-sm) 0; }

/* No, Role, Kelas, Aksi rata tengah */
.table thead th:nth-child(1),
.table thead th:nth-child(4),
.table thead th:nth-child(5),
.table thead th:nth-child(7),
.table tbody td:nth-child(1),
.table tbody td:nth-child(4),
.table tbody td:nth-child(5),
.table tbody td:nth-child(7) {
    text-align: center;
}

.table tbody tr {
    border-bottom: 1px solid var(--g2);
    transition: background var(--tr);
}
.table tbody tr:last-child { border-bottom: none; }
.table tbody tr:hover { background: var(--bl0); }

.table tbody td {
    padding: 0.85rem 1rem;
    color: var(--g8);
    vertical-align: middle;
}

/* No */
.table tbody td:nth-child(1) {
    font-weight: 700;
    color: var(--g4);
    font-size: 0.82rem;
    width: 48px;
}

/* Aksi */
.table tbody td:nth-child(7) {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

/* ── ROLE BADGE ──────────────────────────────────────────── */
.role-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.28em 0.85em;
    border-radius: 999px;
    font-size: 0.73rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    white-space: nowrap;
}
.role-badge--mahasiswa { background: var(--bl0);   color: var(--bl7);  border: 1px solid var(--bl1);  }
.role-badge--dosen     { background: #f0fdf4;       color: #15803d;     border: 1px solid #bbf7d0;     }
.role-badge--kaprodi   { background: #fef9c3;       color: #a16207;     border: 1px solid #fde68a;     }
.role-badge--admin     { background: #fce7f3;       color: #be185d;     border: 1px solid #fbcfe8;     }

/* ── BUTTON ──────────────────────────────────────────────── */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.35rem;
    padding: 0.55em 1.35em;
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

/* Small — ukuran sama */
.btn-sm {
    width: 80px;
    height: 34px;
    padding: 0;
    font-size: 0.78rem;
    border-radius: 6px;
    box-sizing: border-box;
    border: 2px solid transparent;
    justify-content: center;
}

/* Tambah User — putih di atas card gelap */
.card:first-of-type .btn-success {
    background: var(--wh);
    color: var(--bl7);
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.15);
}
.card:first-of-type .btn-success:hover {
    background: var(--bl0);
    color: var(--bl9);
    box-shadow: 0 4px 14px rgba(0,0,0,0.2);
    transform: translateY(-1px);
}

/* Kembali — outline di card biru */
.card-footer-cta .btn-back-outline {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.55em 1.25em;
    border-radius: var(--r-sm);
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    color: var(--wh);
    background: rgba(255,255,255,0.14);
    border: 1.5px solid rgba(255,255,255,0.35);
    transition: background var(--tr), transform var(--tr);
    white-space: nowrap;
    font-family: inherit;
    cursor: pointer;
}
.card-footer-cta .btn-back-outline:hover {
    background: rgba(255,255,255,0.26);
    border-color: rgba(255,255,255,0.6);
    transform: translateY(-1px);
}

/* Edit — biru */
.btn-warning {
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    box-shadow: 0 2px 8px rgba(40,114,232,0.25);
    color: var(--wh);
}
.btn-warning:hover {
    background: linear-gradient(135deg, var(--bl7), var(--bl5));
    box-shadow: 0 4px 14px rgba(40,114,232,0.38);
    color: var(--wh);
}

/* Hapus — merah */
.btn-danger {
    background: linear-gradient(135deg, #dc2626, #f87171);
    box-shadow: 0 2px 8px rgba(220,38,38,0.28);
    color: var(--wh);
}
.btn-danger:hover {
    background: linear-gradient(135deg, #b91c1c, #dc2626);
    box-shadow: 0 4px 14px rgba(220,38,38,0.38);
    color: var(--wh);
}

/* ── PAGINATION ──────────────────────────────────────────── */
nav[role="navigation"] {
    display: flex;
    justify-content: center;
}
nav[role="navigation"] > div:first-child { display: none; }

nav[role="navigation"] span[aria-current="page"] > span,
nav[role="navigation"] a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    padding: 0 0.6em;
    border-radius: var(--r-sm);
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    border: 1.5px solid var(--g2);
    margin: 0 2px;
    transition: background var(--tr), border-color var(--tr), color var(--tr);
}
nav[role="navigation"] a { color: var(--g6); background: var(--wh); }
nav[role="navigation"] a:hover {
    background: var(--bl0);
    border-color: var(--bl4);
    color: var(--bl5);
}
nav[role="navigation"] span[aria-current="page"] > span {
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    border-color: transparent;
    color: var(--wh);
}
nav[role="navigation"] span > span {
    color: var(--g4);
    background: var(--g1);
    border: 1.5px solid var(--g2);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    border-radius: var(--r-sm);
    font-size: 0.85rem;
    margin: 0 2px;
}

/* ── RESPONSIVE ──────────────────────────────────────────── */
@media (max-width: 768px) {
    h1 { margin-bottom: 1.25rem; }
    .card:first-of-type { padding: 1.25rem; }
    .card:first-of-type .btn-success {
        width: 100%;
        justify-content: center;
        padding: 0.75em 1.25em;
    }
    .card:nth-of-type(2) {
        padding: 1.25rem 0;
        overflow: hidden;
    }
    .table {
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding: 0 1.25rem;
    }
    .table tbody td:nth-child(7) { display: table-cell; }
    nav[role="navigation"] {
        flex-wrap: wrap;
        gap: 4px;
        padding: 0 1.25rem;
    }
    .card-footer-cta {
        flex-direction: column !important;
        align-items: stretch !important;
    }
    .card-footer-cta .btn-back-outline {
        width: 100%;
        justify-content: center;
        padding: 0.75em 1.25em;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .card { padding: 1.5rem; }
}
</style>
@endsection

@section('content')

<h1>Kelola Pengguna</h1>

{{-- CARD TAMBAH USER --}}
<div class="card">
    <a href="{{ route('admin.users.create') }}" class="btn btn-success">
        + Tambah User
    </a>
</div>

{{-- CARD TABEL --}}
<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Kelas</th>
                <th>Angkatan</th>
                <th>Terdaftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $users->firstItem() + $index }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    @php
                        $actualRole = $user->role ?? ($user->dosenKaprodi ? $user->dosenKaprodi->jabatan : 'unknown');
                    @endphp
                    <td>
                        <span class="role-badge role-badge--{{ strtolower($actualRole) }}">
                            {{ ucfirst($actualRole) }}
                        </span>
                    </td>
                    @php
                        $kelasLabel = '-';
                        if ($user->kelas == 5) {
                            $kelasLabel = 'Kelas A';
                        } elseif ($user->kelas == 6) {
                            $kelasLabel = 'Kelas B';
                        } elseif ($user->kelas == 7) {
                            $kelasLabel = 'Kelas C';
                        } elseif ($user->kelas == 8) {
                            $kelasLabel = 'Kelas D';
                        } elseif ($user->kelas == 9) {
                            $kelasLabel = 'Kelas E';
                        }
                    @endphp
                    <td>{{ $kelasLabel }}</td>
                    <td>{{ $user->angkatan ?? '-' }}</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus user ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $users->links() }}
    </div>
</div>

{{-- CARD KEMBALI --}}
<div class="card card-footer-cta">
    <a href="{{ route('admin.dashboard') }}" class="btn-back-outline">
        Kembali
    </a>
</div>

@endsection