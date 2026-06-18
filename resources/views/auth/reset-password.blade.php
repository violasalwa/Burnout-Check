<x-guest-layout>

    @section('title', 'Reset Password')

    @section('styles')
    <style>
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
        --r-sm: 10px;
        --r-lg: 24px;
        --sh-lg: 0 8px 40px rgba(13, 45, 107, 0.18);
        --tr  : 0.22s cubic-bezier(.4, 0, .2, 1);
    }

    .min-h-screen {
        background: linear-gradient(135deg, #eef4ff 0%, #f8fbff 50%, #e8f0fe 100%) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 2rem !important;
        position: relative !important;
        overflow: hidden !important;
    }
    .min-h-screen::before {
        content: ''; position: fixed;
        width: 600px; height: 600px; border-radius: 50%;
        background: radial-gradient(circle, rgba(40,114,232,0.10) 0%, transparent 70%);
        top: -200px; right: -180px; pointer-events: none; z-index: 0;
    }
    .min-h-screen::after {
        content: ''; position: fixed;
        width: 400px; height: 400px; border-radius: 50%;
        background: radial-gradient(circle, rgba(77,142,245,0.09) 0%, transparent 70%);
        bottom: -120px; left: -100px; pointer-events: none; z-index: 0;
    }

    /* ── Ornaments ── */
    .bg-ornaments { position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
    .orn-circle-1 { position: absolute; width: 280px; height: 280px; border-radius: 50%; border: 2px solid rgba(40,114,232,0.10); top: -60px; left: 8%; animation: spinSlow 30s linear infinite; }
    .orn-circle-2 { position: absolute; width: 200px; height: 200px; border-radius: 50%; border: 2px solid rgba(40,114,232,0.08); bottom: 5%; right: 6%; animation: spinSlow 40s linear infinite reverse; }
    .orn-circle-3 { position: absolute; width: 80px; height: 80px; border-radius: 50%; background: rgba(40,114,232,0.06); left: 3%; top: 55%; animation: floatBlob 8s ease-in-out infinite; }
    .orn-circle-4 { position: absolute; width: 120px; height: 120px; border-radius: 50%; background: rgba(77,142,245,0.07); bottom: 10%; left: 35%; animation: floatBlob 10s ease-in-out infinite 2s; }
    .orn-circle-5 { position: absolute; width: 60px; height: 60px; border-radius: 50%; background: rgba(40,114,232,0.08); top: 15%; right: 18%; animation: floatBlob 6s ease-in-out infinite 1s; }
    .orn-blob-1 { position: absolute; width: 320px; height: 320px; background: rgba(40,114,232,0.055); border-radius: 60% 40% 70% 30% / 50% 60% 40% 50%; bottom: -80px; left: -60px; animation: morphBlob 12s ease-in-out infinite; }
    .orn-blob-2 { position: absolute; width: 240px; height: 240px; background: rgba(77,142,245,0.06); border-radius: 40% 60% 30% 70% / 60% 40% 60% 40%; top: -60px; right: -40px; animation: morphBlob 15s ease-in-out infinite reverse; }
    .orn-wave { position: absolute; bottom: 0; left: 0; width: 100%; opacity: 0.35; }
    .orn-dots { position: absolute; top: 20%; right: 12%; display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; }
    .orn-dots span { width: 5px; height: 5px; border-radius: 50%; background: rgba(40,114,232,0.18); display: block; }
    .orn-dots-2 { position: absolute; bottom: 22%; left: 5%; display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; }
    .orn-dots-2 span { width: 4px; height: 4px; border-radius: 50%; background: rgba(40,114,232,0.14); display: block; }
    .orn-ring-dashed { position: absolute; width: 160px; height: 160px; border-radius: 50%; border: 2px dashed rgba(40,114,232,0.12); top: 60%; right: 10%; animation: spinSlow 25s linear infinite; }

    @keyframes spinSlow  { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }
    @keyframes floatBlob { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-18px)} }
    @keyframes morphBlob {
        0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 50%; }
        33%     { border-radius: 40% 60% 30% 70% / 60% 40% 70% 30%; }
        66%     { border-radius: 70% 30% 50% 50% / 30% 70% 30% 70%; }
    }

    /* ── Card wrapper ── */
    .w-full.sm\:max-w-md {
        all: unset !important;
        display: block !important;
        width: 100% !important;
        max-width: 860px !important;
        position: relative !important;
        z-index: 1 !important;
    }

    /* ── Split layout ── */
    .rp-wrap {
        display: grid;
        grid-template-columns: 1fr 1fr;
        border-radius: var(--r-lg);
        overflow: hidden;
        box-shadow: var(--sh-lg), 0 0 0 1px rgba(40,114,232,0.08);
        min-height: 500px;
    }

    /* ── Panel Kiri ── */
    .rp-left {
        background: linear-gradient(145deg, var(--bl5) 0%, var(--bl7) 50%, var(--bl9) 100%);
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        padding: 3rem 2.5rem;
        position: relative; overflow: hidden; text-align: center;
    }
    .rp-left__deco { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }
    .rp-left__deco::before { content: ''; position: absolute; width: 340px; height: 340px; border-radius: 50%; border: 40px solid rgba(255,255,255,0.06); top: -120px; right: -120px; }
    .rp-left__deco::after  { content: ''; position: absolute; width: 180px; height: 180px; border-radius: 50%; border: 28px solid rgba(255,255,255,0.05); bottom: -60px; left: -60px; }

    .deco-box { position: absolute; border-radius: 12px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); }
    .deco-box-1 { width:50px; height:50px; top:12%; left:8%;    animation: floatY  4s ease-in-out infinite; }
    .deco-box-2 { width:35px; height:35px; top:65%; right:10%;  animation: floatY2 5s ease-in-out infinite 1s; }
    .deco-box-3 { width:24px; height:24px; bottom:16%; left:14%; animation: floatY3 6s ease-in-out infinite 0.5s; }
    .deco-dots-l { position: absolute; top:52%; left:6%; display: grid; grid-template-columns: repeat(3,1fr); gap:6px; }
    .deco-dots-l span { width:5px; height:5px; border-radius:50%; background:rgba(255,255,255,0.18); display:block; }
    .deco-line { position:absolute; background:rgba(255,255,255,0.07); border-radius:2px; }
    .deco-line-1 { width:70px; height:3px; top:28%; right:8%;  transform:rotate(-30deg); }
    .deco-line-2 { width:45px; height:3px; top:72%; left:12%; transform:rotate(20deg); }

    @keyframes floatY  { 0%,100%{transform:translateY(0) rotate(20deg)}  50%{transform:translateY(-12px) rotate(20deg)} }
    @keyframes floatY2 { 0%,100%{transform:translateY(0) rotate(-15deg)} 50%{transform:translateY(-10px) rotate(-15deg)} }
    @keyframes floatY3 { 0%,100%{transform:translateY(0) rotate(10deg)}  50%{transform:translateY(-8px)  rotate(10deg)} }

    .rp-left__logo {
        display: flex; align-items: center; gap: 0.6rem;
        margin-bottom: 2rem; position: relative; z-index: 1;
        text-decoration: none;
    }
    .rp-left__logo-name {
        font-size: 1.1rem; font-weight: 800;
        color: var(--wh); letter-spacing: -0.02em; line-height: 1.1; text-align: left;
    }
    .rp-left__logo-name span {
        display: block; font-size: 0.62rem; font-weight: 500;
        color: rgba(255,255,255,0.6); letter-spacing: 0.08em; text-transform: uppercase;
    }

    .rp-left__illustration { position: relative; z-index: 1; margin-bottom: 1.75rem; }

    .rp-left__title {
        font-size: 1.4rem; font-weight: 800; color: var(--wh);
        letter-spacing: -0.02em; margin-bottom: 0.6rem;
        position: relative; z-index: 1; line-height: 1.2;
    }
    .rp-left__desc {
        font-size: 0.82rem; color: rgba(255,255,255,0.65);
        line-height: 1.7; max-width: 230px; position: relative; z-index: 1;
    }

    /* Steps indicator */
    .rp-left__steps {
        display: flex; flex-direction: column; gap: 0.55rem;
        margin-top: 1.5rem; position: relative; z-index: 1; width: 100%; max-width: 220px;
    }
    .rp-step {
        display: flex; align-items: center; gap: 0.55rem;
        font-size: 0.78rem; color: rgba(255,255,255,0.82); font-weight: 500; text-align: left;
    }
    .rp-step__num {
        width: 22px; height: 22px; border-radius: 50%; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.65rem; font-weight: 800;
    }
    .rp-step__num--done  { background: rgba(255,255,255,0.90); color: var(--bl7); }
    .rp-step__num--done svg { width: 10px; height: 10px; stroke: var(--bl7); fill: none; stroke-width: 3; stroke-linecap: round; stroke-linejoin: round; }
    .rp-step__num--active { background: var(--wh); color: var(--bl7); box-shadow: 0 0 0 3px rgba(255,255,255,0.25); }
    .rp-step__num--pending { background: rgba(255,255,255,0.12); color: rgba(255,255,255,0.5); border: 1.5px solid rgba(255,255,255,0.2); }
    .rp-step--done   { color: rgba(255,255,255,0.55); }
    .rp-step--active { color: var(--wh); font-weight: 700; }

    /* ── Panel Kanan ── */
    .rp-right {
        background: var(--wh); padding: 2.75rem 2.5rem;
        display: flex; flex-direction: column; justify-content: center;
        position: relative; overflow: hidden;
    }
    .rp-right::before { content: ''; position: absolute; width: 120px; height: 120px; border-radius: 50%; background: var(--bl0); top: -40px; right: -40px; pointer-events: none; }
    .rp-right::after  { content: ''; position: absolute; width: 80px; height: 80px; border-radius: 50%; background: var(--g1); bottom: -30px; left: -30px; pointer-events: none; }

    .rp-right__header { margin-bottom: 1.5rem; position: relative; z-index: 1; }
    .rp-right__eyebrow {
        font-size: 0.72rem; font-weight: 800; letter-spacing: 0.14em;
        text-transform: uppercase; color: var(--bl4); margin-bottom: 0.3rem;
        display: flex; align-items: center; gap: 0.4rem;
    }
    .rp-right__eyebrow::before {
        content: ''; display: inline-block; width: 20px; height: 2.5px;
        background: linear-gradient(90deg, var(--bl5), var(--bl4));
        border-radius: 2px; flex-shrink: 0;
    }
    .rp-right__header h2 { font-size: 1.35rem; font-weight: 800; color: var(--bl9); letter-spacing: -0.02em; margin-bottom: 0.25rem; }
    .rp-right__header p  { font-size: 0.8rem; color: var(--g4); }

    /* Form */
    .rp-form { display: flex; flex-direction: column; gap: 1rem; position: relative; z-index: 1; }
    .field-group { display: flex; flex-direction: column; gap: 0.28rem; }

    /* Password strength indicator */
    .pass-hint {
        display: flex; align-items: center; gap: 0.4rem;
        font-size: 0.68rem; color: var(--g4); margin-top: 0.25rem;
    }
    .pass-hint svg { width: 12px; height: 12px; stroke: var(--g4); fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }

    label {
        font-size: 0.7rem !important; font-weight: 700 !important;
        color: var(--g8) !important; letter-spacing: 0.06em !important;
        text-transform: uppercase !important;
    }

    .rp-input {
        width: 100%; padding: 0.65em 0.9em;
        border: 1.5px solid var(--g2); border-radius: var(--r-sm);
        font-size: 0.88rem; font-family: inherit; color: var(--g8);
        background: var(--wh); outline: none;
        transition: border-color var(--tr), box-shadow var(--tr), background var(--tr);
        appearance: none; -webkit-appearance: none;
    }
    .rp-input:hover  { border-color: var(--bl4); background: var(--bl0); }
    .rp-input:focus  { border-color: var(--bl5); box-shadow: 0 0 0 3px rgba(40,114,232,0.12); background: var(--wh); }
    .rp-input::placeholder { color: var(--g4); font-size: 0.84rem; }
    .rp-input.is-invalid   { border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,0.1); }

    .field-error { font-size: 0.72rem; color: #dc2626; font-weight: 500; }

    /* Button row */
    .btn-row {
        display: flex; align-items: center; justify-content: flex-end;
        gap: 0.75rem; padding-top: 1.1rem;
        border-top: 1px solid var(--g2); margin-top: 0.25rem;
    }

    .btn-submit {
        height: 42px; padding: 0 1.75em;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: var(--r-sm); font-size: 0.88rem;
        font-weight: 700; font-family: inherit; cursor: pointer;
        white-space: nowrap; letter-spacing: 0.01em;
        border: 2px solid transparent;
        background: linear-gradient(135deg, var(--bl5), var(--bl4));
        color: var(--wh); box-shadow: 0 2px 8px rgba(40,114,232,0.30);
        transition: background var(--tr), box-shadow var(--tr), transform var(--tr);
    }
    .btn-submit:hover { background: linear-gradient(135deg, var(--bl7), var(--bl5)); box-shadow: 0 4px 14px rgba(40,114,232,0.42); transform: translateY(-1px); }
    .btn-submit:active { transform: translateY(0); }

    @media (max-width: 700px) {
        .min-h-screen { padding: 1rem !important; }
        .w-full.sm\:max-w-md { max-width: 100% !important; }
        .rp-wrap { grid-template-columns: 1fr; min-height: auto; }
        .rp-left { padding: 1.75rem 1.5rem; min-height: auto; }
        .rp-left__illustration, .rp-left__steps { display: none; }
        .rp-left__desc { margin-bottom: 0; }
        .rp-right { padding: 1.75rem 1.25rem; }
        .btn-row { justify-content: stretch; }
        .btn-submit { width: 100%; height: 44px; }
        .bg-ornaments { display: none; }
    }
    </style>
    @endsection

    {{-- Ornaments --}}
    <div class="bg-ornaments">
        <div class="orn-blob-1"></div>
        <div class="orn-blob-2"></div>
        <div class="orn-circle-1"></div>
        <div class="orn-circle-2"></div>
        <div class="orn-ring-dashed"></div>
        <div class="orn-circle-3"></div>
        <div class="orn-circle-4"></div>
        <div class="orn-circle-5"></div>
        <div class="orn-dots">@for ($i = 0; $i < 15; $i++) <span></span> @endfor</div>
        <div class="orn-dots-2">@for ($i = 0; $i < 12; $i++) <span></span> @endfor</div>
        <svg class="orn-wave" viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,60 C240,110 480,10 720,60 C960,110 1200,10 1440,60 L1440,120 L0,120 Z" fill="rgba(40,114,232,0.05)"/>
            <path d="M0,80 C360,30 720,110 1080,50 C1260,20 1380,80 1440,70 L1440,120 L0,120 Z" fill="rgba(77,142,245,0.04)"/>
        </svg>
    </div>

    <div class="rp-wrap">

        {{-- ══ PANEL KIRI ══ --}}
        <div class="rp-left">
            <div class="rp-left__deco"></div>
            <div class="deco-box deco-box-1"></div>
            <div class="deco-box deco-box-2"></div>
            <div class="deco-box deco-box-3"></div>
            <div class="deco-dots-l">
                <span></span><span></span><span></span>
                <span></span><span></span><span></span>
                <span></span><span></span><span></span>
            </div>
            <div class="deco-line deco-line-1"></div>
            <div class="deco-line deco-line-2"></div>

            <a href="{{ url('/') }}" class="rp-left__logo">
                <div class="rp-left__logo-name">
                    BurnoutCheck
                    <span>Sistem Deteksi Burnout</span>
                </div>
            </a>

            <div class="rp-left__illustration">
                <img src="{{ asset('images/burnoutloginregis.png') }}"
                     alt="BurnoutCheck Logo"
                     style="width:130px;height:130px;object-fit:contain;filter:drop-shadow(0 8px 24px rgba(0,0,0,0.2));">
            </div>

            <h2 class="rp-left__title">Buat Password<br>Baru Anda</h2>
            <p class="rp-left__desc">
                Hampir selesai! Masukkan password baru yang kuat untuk mengamankan akun Anda.
            </p>

            {{-- Step indicator --}}
            <div class="rp-left__steps">
                <div class="rp-step rp-step--done">
                    <div class="rp-step__num rp-step__num--done">
                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    Masukkan email
                </div>
                <div class="rp-step rp-step--done">
                    <div class="rp-step__num rp-step__num--done">
                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    Cek link di email
                </div>
                <div class="rp-step rp-step--active">
                    <div class="rp-step__num rp-step__num--active">3</div>
                    Buat password baru
                </div>
            </div>
        </div>

        {{-- ══ PANEL KANAN ══ --}}
        <div class="rp-right">

            <div class="rp-right__header">
                <p class="rp-right__eyebrow">Langkah Terakhir</p>
                <h2>Reset Password</h2>
                <p>Masukkan password baru Anda di bawah ini</p>
            </div>

            <form class="rp-form" method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- EMAIL --}}
                <div class="field-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <input id="email" name="email" type="email"
                           class="rp-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           placeholder="Email terdaftar"
                           value="{{ old('email', $request->email) }}"
                           required autofocus autocomplete="username" />
                    @error('email') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                {{-- PASSWORD BARU --}}
                <div class="field-group">
                    <x-input-label for="password" :value="__('Password Baru')" />
                    <input id="password" name="password" type="password"
                           class="rp-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="Min. 8 karakter"
                           required autocomplete="new-password" />
                    @error('password')
                        <span class="field-error">{{ $message }}</span>
                    @else
                        <div class="pass-hint">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            Minimal 8 karakter
                        </div>
                    @enderror
                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div class="field-group">
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           class="rp-input {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                           placeholder="Ulangi password baru"
                           required autocomplete="new-password" />
                    @error('password_confirmation') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                {{-- BUTTON --}}
                <div class="btn-row">
                    <button type="submit" class="btn-submit">
                        <svg viewBox="0 0 24 24" style="width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round;margin-right:6px;">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        Reset Password
                    </button>
                </div>

            </form>

        </div>
    </div>

</x-guest-layout>