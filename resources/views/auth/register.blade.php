<x-guest-layout>

    @section('title', 'Daftar')

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

    .w-full.sm\:max-w-md {
        all: unset !important; display: block !important;
        width: 100% !important; max-width: 940px !important;
        position: relative !important; z-index: 1 !important;
    }

    .reg-wrap {
        display: grid; grid-template-columns: 1fr 1fr;
        border-radius: var(--r-lg); overflow: hidden;
        box-shadow: var(--sh-lg), 0 0 0 1px rgba(40,114,232,0.08);
        min-height: 580px;
    }

    /* ── PANEL KIRI ── */
    .reg-left {
        background: linear-gradient(145deg, var(--bl5) 0%, var(--bl7) 50%, var(--bl9) 100%);
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        padding: 3rem 2.5rem;
        position: relative; overflow: hidden; text-align: center;
    }
    .reg-left__deco { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }
    .reg-left__deco::before { content: ''; position: absolute; width: 340px; height: 340px; border-radius: 50%; border: 40px solid rgba(255,255,255,0.06); top: -120px; right: -120px; }
    .reg-left__deco::after  { content: ''; position: absolute; width: 180px; height: 180px; border-radius: 50%; border: 28px solid rgba(255,255,255,0.05); bottom: -60px; left: -60px; }

    .deco-box { position: absolute; border-radius: 12px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); }
    .deco-box-1 { width:60px; height:60px; top:14%; left:8%;    animation: floatY  4s ease-in-out infinite; }
    .deco-box-2 { width:40px; height:40px; top:60%; right:10%;  animation: floatY2 5s ease-in-out infinite 1s; }
    .deco-box-3 { width:28px; height:28px; bottom:18%; left:15%; animation: floatY3 6s ease-in-out infinite 0.5s; }
    .deco-dots  { position: absolute; top:55%; left:6%; display: grid; grid-template-columns: repeat(3,1fr); gap:6px; }
    .deco-dots span { width:5px; height:5px; border-radius:50%; background:rgba(255,255,255,0.18); display:block; }
    .deco-line  { position:absolute; background:rgba(255,255,255,0.07); border-radius:2px; }
    .deco-line-1 { width:80px; height:3px; top:30%; right:8%;  transform:rotate(-30deg); }
    .deco-line-2 { width:50px; height:3px; top:75%; left:12%; transform:rotate(20deg); }

    @keyframes floatY  { 0%,100%{transform:translateY(0) rotate(20deg)}  50%{transform:translateY(-12px) rotate(20deg)} }
    @keyframes floatY2 { 0%,100%{transform:translateY(0) rotate(-15deg)} 50%{transform:translateY(-10px) rotate(-15deg)} }
    @keyframes floatY3 { 0%,100%{transform:translateY(0) rotate(10deg)}  50%{transform:translateY(-8px)  rotate(10deg)} }

    .reg-left__logo {
        display: flex; align-items: center; gap: 0.6rem;
        margin-bottom: 2rem; position: relative; z-index: 1;
        text-decoration: none;
    }
    .reg-left__logo-name {
        font-size: 1.1rem; font-weight: 800;
        color: var(--wh); letter-spacing: -0.02em; line-height: 1.1;
        text-align: left;
    }
    .reg-left__logo-name span {
        display: block; font-size: 0.62rem; font-weight: 500;
        color: rgba(255,255,255,0.6); letter-spacing: 0.08em; text-transform: uppercase;
    }

    /* Ilustrasi — logo image */
    .reg-left__illustration {
        position: relative; z-index: 1; margin-bottom: 1.75rem;
    }

    .reg-left__title {
        font-size: 1.5rem; font-weight: 800; color: var(--wh);
        letter-spacing: -0.02em; margin-bottom: 0.6rem;
        position: relative; z-index: 1; line-height: 1.2;
    }
    .reg-left__desc {
        font-size: 0.83rem; color: rgba(255,255,255,0.68);
        line-height: 1.7; max-width: 240px;
        position: relative; z-index: 1; margin-bottom: 1.75rem;
    }
    .reg-left__features {
        list-style: none; display: flex; flex-direction: column;
        gap: 0.55rem; position: relative; z-index: 1; width: 100%; max-width: 230px;
    }
    .reg-left__features li {
        display: flex; align-items: center; gap: 0.55rem;
        font-size: 0.79rem; color: rgba(255,255,255,0.82);
        font-weight: 500; text-align: left;
    }
    .feat-check {
        width: 18px; height: 18px; border-radius: 50%;
        background: rgba(255,255,255,0.15); border: 1.5px solid rgba(255,255,255,0.28);
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .feat-check svg { width: 10px; height: 10px; stroke: #fff; fill: none; stroke-width: 3; stroke-linecap: round; stroke-linejoin: round; }

    /* ── PANEL KANAN ── */
    .reg-right {
        background: var(--wh); padding: 2.25rem;
        display: flex; flex-direction: column; justify-content: center;
        overflow-y: auto; position: relative;
    }
    .reg-right::before { content: ''; position: absolute; width: 120px; height: 120px; border-radius: 50%; background: var(--bl0); top: -40px; right: -40px; pointer-events: none; }
    .reg-right::after  { content: ''; position: absolute; width: 80px; height: 80px; border-radius: 50%; background: var(--g1); bottom: -30px; left: -30px; pointer-events: none; }

    .reg-right__header { margin-bottom: 1.4rem; position: relative; z-index: 1; }
    .reg-right__welcome {
        font-size: 0.78rem !important; font-weight: 800 !important;
        letter-spacing: 0.14em !important; text-transform: uppercase !important;
        color: var(--bl4) !important; margin-bottom: 0.3rem !important;
        display: flex !important; align-items: center !important; gap: 0.4rem !important;
    }
    .reg-right__welcome::before {
        content: ''; display: inline-block; width: 20px; height: 2.5px;
        background: linear-gradient(90deg, var(--bl5), var(--bl4));
        border-radius: 2px; flex-shrink: 0;
    }
    .reg-right__header h2 { font-size: 1.35rem; font-weight: 800; color: var(--bl9); letter-spacing: -0.02em; margin-bottom: 0.25rem; }
    .reg-right__header p  { font-size: 0.8rem; color: var(--g4); }

    .reg-form { display: flex; flex-direction: column; gap: 0.9rem; position: relative; z-index: 1; }
    .field-group { display: flex; flex-direction: column; gap: 0.28rem; }
    .field-row   { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }

    label { font-size: 0.7rem !important; font-weight: 700 !important; color: var(--g8) !important; letter-spacing: 0.06em !important; text-transform: uppercase !important; }

    .reg-input {
        width: 100%; padding: 0.58em 0.85em;
        border: 1.5px solid var(--g2); border-radius: var(--r-sm);
        font-size: 0.87rem; font-family: inherit; color: var(--g8);
        background: var(--wh); outline: none;
        transition: border-color var(--tr), box-shadow var(--tr), background var(--tr);
        appearance: none; -webkit-appearance: none;
    }
    .reg-input:hover  { border-color: var(--bl4); background: var(--bl0); }
    .reg-input:focus  { border-color: var(--bl5); box-shadow: 0 0 0 3px rgba(40,114,232,0.12); background: var(--wh); }
    .reg-input::placeholder { color: var(--g4); font-size: 0.83rem; }
    .reg-input.is-invalid   { border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,0.1); }

    .reg-select {
        width: 100%; padding: 0.58em 2.2em 0.58em 0.85em;
        border: 1.5px solid var(--g2); border-radius: var(--r-sm);
        font-size: 0.87rem; font-family: inherit; color: var(--g8);
        background-color: var(--wh);
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239aa3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 0.85em center; background-size: 13px;
        outline: none; cursor: pointer; appearance: none; -webkit-appearance: none;
        transition: border-color var(--tr), box-shadow var(--tr), background-color var(--tr);
    }
    .reg-select:hover { border-color: var(--bl4); background-color: var(--bl0); }
    .reg-select:focus { border-color: var(--bl5); box-shadow: 0 0 0 3px rgba(40,114,232,0.12); background-color: var(--wh); }
    .reg-select.is-invalid { border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,0.1); }

    .field-error { font-size: 0.7rem; color: #dc2626; font-weight: 500; }

    .btn-row {
        display: flex; align-items: center; justify-content: space-between;
        gap: 0.75rem; padding-top: 1rem; border-top: 1px solid var(--g2); margin-top: 0.1rem;
    }
    .link-login { font-size: 0.76rem; font-weight: 600; color: var(--bl5); text-decoration: none; transition: color var(--tr); }
    .link-login:hover { color: var(--bl7); text-decoration: underline; }
    .btn-group { display: flex; align-items: center; gap: 0.5rem; }

    .btn-back, .btn-submit {
        width: 105px; height: 40px; padding: 0; box-sizing: border-box;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: var(--r-sm); font-size: 0.84rem; font-weight: 600;
        font-family: inherit; cursor: pointer; white-space: nowrap; letter-spacing: 0.01em;
        transition: background var(--tr), box-shadow var(--tr), transform var(--tr);
    }
    .btn-back { text-decoration: none; color: var(--bl5); background: var(--bl0); border: 2px solid var(--bl1); }
    .btn-back:hover { background: var(--bl1); border-color: var(--bl4); color: var(--bl7); transform: translateY(-1px); }
    .btn-submit { border: 2px solid transparent; background: linear-gradient(135deg, var(--bl5), var(--bl4)); color: var(--wh); font-weight: 700; box-shadow: 0 2px 8px rgba(40,114,232,0.30); }
    .btn-submit:hover { background: linear-gradient(135deg, var(--bl7), var(--bl5)); box-shadow: 0 4px 14px rgba(40,114,232,0.42); transform: translateY(-1px); }
    .btn-submit:active, .btn-back:active { transform: translateY(0); }

    @media (max-width: 700px) {
        .min-h-screen { padding: 1rem !important; }
        .w-full.sm\:max-w-md { max-width: 100% !important; }
        .reg-wrap { grid-template-columns: 1fr; min-height: auto; }
        .reg-left { padding: 1.75rem 1.5rem; min-height: auto; }
        .reg-left__features, .reg-left__illustration { display: none; }
        .reg-left__desc { margin-bottom: 0; }
        .reg-right { padding: 1.75rem 1.25rem; }
        .field-row { grid-template-columns: 1fr; }
        .btn-row { flex-direction: column; align-items: stretch; }
        .btn-group { flex-direction: column; }
        .btn-back, .btn-submit { width: 100%; height: 44px; }
        .link-login { text-align: center; }
        .bg-ornaments { display: none; }
    }
    </style>
    @endsection

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

    <div class="reg-wrap">

        {{-- ══ PANEL KIRI ══════════════════════════════════════ --}}
        <div class="reg-left">
            <div class="reg-left__deco"></div>
            <div class="deco-box deco-box-1"></div>
            <div class="deco-box deco-box-2"></div>
            <div class="deco-box deco-box-3"></div>
            <div class="deco-dots">
                <span></span><span></span><span></span>
                <span></span><span></span><span></span>
                <span></span><span></span><span></span>
            </div>
            <div class="deco-line deco-line-1"></div>
            <div class="deco-line deco-line-2"></div>

            {{-- Logo teks --}}
            <a href="{{ url('/') }}" class="reg-left__logo">
                <div class="reg-left__logo-name">
                    BurnoutCheck
                    <span>Sistem Deteksi Burnout</span>
                </div>
            </a>

            {{-- Logo image menggantikan ilustrasi SVG --}}
            <div class="reg-left__illustration">
                <img src="{{ asset('images/burnoutloginregis.png') }}"
                     alt="BurnoutCheck Logo"
                     style="width:160px;height:160px;object-fit:contain;filter:drop-shadow(0 8px 24px rgba(0,0,0,0.2));">
            </div>

            <h2 class="reg-left__title">Daftar & Mulai<br>Deteksi Burnout</h2>
            <p class="reg-left__desc">
                Kenali kondisi akademikmu secara cepat, mudah, dan akurat bersama BurnoutCheck.
            </p>

            <ul class="reg-left__features">
                <li><span class="feat-check"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></span>Tes burnout tervalidasi klinis</li>
                <li><span class="feat-check"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></span>Hasil analisis instan</li>
                <li><span class="feat-check"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></span>Dipantau dosen pembimbing</li>
            </ul>
        </div>

        {{-- ══ PANEL KANAN ══════════════════════════════════════ --}}
        <div class="reg-right">
            <div class="reg-right__header">
                <p class="reg-right__welcome">Welcome!</p>
                <h2>Buat Akun Baru</h2>
                <p>Isi form di bawah untuk memulai</p>
            </div>

            <form class="reg-form" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="field-group">
                    <x-input-label for="name" value="Nama Lengkap" />
                    <input id="name" name="name" type="text"
                           class="reg-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           placeholder="Masukkan nama lengkap"
                           value="{{ old('name') }}" required autofocus />
                    @error('name') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="field-group">
                    <x-input-label for="email" value="Email" />
                    <input id="email" name="email" type="email"
                           class="reg-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           placeholder="contoh@email.com"
                           value="{{ old('email') }}" required />
                    @error('email') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="field-row">
                    <div class="field-group">
                        <x-input-label for="kelas" value="Kelas" />
                        <select id="kelas" name="kelas"
                                class="reg-select {{ $errors->has('kelas') ? 'is-invalid' : '' }}" required>
                            <option value="">-- Pilih --</option>
                            <option value="5" {{ old('kelas') == 5 ? 'selected' : '' }}>Kelas A</option>
                            <option value="6" {{ old('kelas') == 6 ? 'selected' : '' }}>Kelas B</option>
                            <option value="7" {{ old('kelas') == 7 ? 'selected' : '' }}>Kelas C</option>
                            <option value="8" {{ old('kelas') == 8 ? 'selected' : '' }}>Kelas D</option>
                            <option value="9" {{ old('kelas') == 9 ? 'selected' : '' }}>Kelas E</option>
                        </select>
                        @error('kelas') <span class="field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="field-group">
                        <x-input-label for="angkatan" value="Angkatan" />
                        <input id="angkatan" name="angkatan" type="text" inputmode="numeric" pattern="[0-9]*"
                               class="reg-input {{ $errors->has('angkatan') ? 'is-invalid' : '' }}"
                               placeholder="Contoh: 2023"
                               value="{{ old('angkatan') }}" required />
                        @error('angkatan') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="field-group">
                    <x-input-label for="dosen_id" value="Dosen Pembimbing" />
                    <select id="dosen_id" name="dosen_id"
                        class="reg-select {{ $errors->has('dosen_id') ? 'is-invalid' : '' }}" required>
                        <option value="">-- Pilih --</option>
                        @foreach ($dosenList as $dosen)
                            <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>{{ $dosen->name }}</option>
                        @endforeach
                    </select>
                    @error('dosen_id') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="field-row">
                    <div class="field-group">
                        <x-input-label for="password" value="Password" />
                        <input id="password" name="password" type="password"
                               class="reg-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                               placeholder="Min. 8 karakter" required />
                        @error('password') <span class="field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="field-group">
                        <x-input-label for="password_confirmation" value="Konfirmasi" />
                        <input id="password_confirmation" name="password_confirmation" type="password"
                               class="reg-input" placeholder="Ulangi password" required />
                    </div>
                </div>

                <div class="btn-row">
                    <a class="link-login" href="{{ route('login') }}">Sudah punya akun?</a>
                    <div class="btn-group">
                        <a href="{{ url('/') }}" class="btn-back">Kembali</a>
                        <button type="submit" class="btn-submit">Daftar</button>
                    </div>
                </div>

            </form>
        </div>

    </div>

<!-- Removed kelas-5 toggle script since only kelas 6 remains and dosen is always required -->
</x-guest-layout>