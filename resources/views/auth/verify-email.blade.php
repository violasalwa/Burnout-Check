<x-guest-layout>

    @section('styles')
    <style>
    /* ============================================================
       auth/verify-email.blade.php — Override Breeze/Tailwind
       Theme  : Blue & White | Konsisten dengan sistem
       ============================================================ */

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
        --sh-lg: 0 8px 32px rgba(40, 114, 232, 0.18);
        --tr  : 0.22s cubic-bezier(.4, 0, .2, 1);
    }

    /* ── BACKGROUND ───────────────────────────────────────────── */
    .min-h-screen {
        background: var(--g1) !important;
    }

    /* ── CARD FORM ────────────────────────────────────────────── */
    .w-full.sm\:max-w-md {
        background: var(--wh) !important;
        border-radius: var(--r-lg) !important;
        box-shadow: var(--sh-lg) !important;
        border: 1px solid var(--bl1) !important;
        padding: 2rem !important;
    }

    /* ── DESKRIPSI ATAS ───────────────────────────────────────── */
    .mb-4.text-sm.text-gray-600 {
        font-size: 0.875rem !important;
        color: var(--g6) !important;
        background: var(--bl0) !important;
        border: 1px solid var(--bl1) !important;
        border-radius: var(--r-sm) !important;
        padding: 0.85em 1em !important;
        line-height: 1.6 !important;
        margin-bottom: 1.25rem !important;
    }

    /* ── SUCCESS ALERT (link sent) ────────────────────────────── */
    .mb-4.font-medium.text-sm.text-green-600 {
        font-size: 0.85rem !important;
        font-weight: 600 !important;
        color: #16a34a !important;
        background: #f0fdf4 !important;
        border: 1px solid #bbf7d0 !important;
        border-radius: var(--r-sm) !important;
        padding: 0.75em 1em !important;
        margin-bottom: 1.25rem !important;
        line-height: 1.5 !important;
    }

    /* ── SPACING ──────────────────────────────────────────────── */
    .mt-4 { margin-top: 1.1rem !important; }

    /* ── BUTTON ROW ───────────────────────────────────────────── */
    .mt-4.flex.items-center.justify-between {
        margin-top: 1.75rem !important;
        padding-top: 1.25rem !important;
        border-top: 1px solid var(--g2) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 0.75rem !important;
    }

    /* ── PRIMARY BUTTON (Resend) ──────────────────────────────── */
    button[type="submit"] {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 0.65em 1.5em !important;
        border-radius: var(--r-sm) !important;
        font-size: 0.88rem !important;
        font-weight: 700 !important;
        font-family: inherit !important;
        cursor: pointer !important;
        border: none !important;
        white-space: nowrap !important;
        background: linear-gradient(135deg, var(--bl5), var(--bl4)) !important;
        color: var(--wh) !important;
        box-shadow: 0 2px 8px rgba(40, 114, 232, 0.30) !important;
        transition: background var(--tr), box-shadow var(--tr), transform var(--tr) !important;
        letter-spacing: 0.01em !important;
    }
    button[type="submit"]:hover {
        background: linear-gradient(135deg, var(--bl7), var(--bl5)) !important;
        box-shadow: 0 4px 14px rgba(40, 114, 232, 0.42) !important;
        transform: translateY(-1px) !important;
    }
    button[type="submit"]:active { transform: translateY(0) !important; }
    button[type="submit"]:focus  {
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(40, 114, 232, 0.25) !important;
    }

    /* ── TOMBOL LOG OUT ───────────────────────────────────────── */
    .btn-logout {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 0.65em 1.5em !important;
        border-radius: var(--r-sm) !important;
        font-size: 0.88rem !important;
        font-weight: 600 !important;
        font-family: inherit !important;
        cursor: pointer !important;
        white-space: nowrap !important;
        color: var(--bl5) !important;
        background: var(--bl0) !important;
        border: 1.5px solid var(--bl1) !important;
        transition: background var(--tr), border-color var(--tr), color var(--tr), transform var(--tr) !important;
        letter-spacing: 0.01em !important;
        text-decoration: none !important;
    }
    .btn-logout:hover {
        background: var(--bl1) !important;
        border-color: var(--bl4) !important;
        color: var(--bl7) !important;
        transform: translateY(-1px) !important;
    }
    .btn-logout:active { transform: translateY(0) !important; }
    .btn-logout:focus  {
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(40, 114, 232, 0.25) !important;
    }

    /* ── RESPONSIVE ───────────────────────────────────────────── */
    @media (max-width: 640px) {
        .w-full.sm\:max-w-md {
            border-radius: var(--r-sm) !important;
            padding: 1.5rem !important;
            margin: 0 0.75rem !important;
        }
        .mt-4.flex.items-center.justify-between {
            flex-direction: column !important;
            align-items: stretch !important;
        }
        button[type="submit"],
        .btn-logout {
            width: 100% !important;
            padding: 0.75em 1.25em !important;
            justify-content: center !important;
        }
    }
    </style>
    @endsection

    <!-- DESKRIPSI -->
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    <!-- SUCCESS ALERT -->
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <!-- BUTTON ROW -->
    <div class="mt-4 flex items-center justify-between">

        {{-- Kiri: Resend --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>
                {{ __('Kirim Ulang Email Verifikasi') }}
            </x-primary-button>
        </form>

        {{-- Kanan: Log Out --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                {{ __('Log Out') }}
            </button>
        </form>

    </div>

</x-guest-layout>