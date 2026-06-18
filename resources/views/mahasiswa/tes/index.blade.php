@extends('layouts.app')

@section('title', 'Tes Burnout')

@section('styles')
<style>
/* ============================================================
   mahasiswa/tes/index.blade.php — CSS
   Theme  : Blue & White | Step Wizard | Konsisten dengan hasil.blade.php
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

/* ── STEP INDICATOR ──────────────────────────────────────── */
.wizard-steps {
    display: flex;
    align-items: center;
    gap: 0;
    margin-bottom: 1.75rem;
    overflow-x: auto;
    padding-bottom: 4px;
    scrollbar-width: none;
}
.wizard-steps::-webkit-scrollbar { display: none; }

.step-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
    min-width: 60px;
    position: relative;
    cursor: default;
}

/* Garis connector antar step */
.step-item:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 18px;
    left: calc(50% + 18px);
    width: calc(100% - 36px);
    height: 2px;
    background: var(--g2);
    z-index: 0;
    transition: background var(--tr);
}
.step-item.completed:not(:last-child)::after {
    background: linear-gradient(90deg, var(--bl5), var(--bl4));
}

/* Lingkaran step */
.step-dot {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: var(--g2);
    border: 2px solid var(--g2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 700;
    color: var(--g4);
    position: relative;
    z-index: 1;
    transition: background var(--tr), border-color var(--tr),
                color var(--tr), box-shadow var(--tr), transform var(--tr);
}

.step-item.completed .step-dot {
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    border-color: transparent;
    color: var(--wh);
    box-shadow: 0 3px 10px rgba(40, 114, 232, 0.35);
}
.step-item.active .step-dot {
    background: var(--wh);
    border-color: var(--bl5);
    color: var(--bl5);
    box-shadow: 0 0 0 4px rgba(40, 114, 232, 0.15);
    transform: scale(1.12);
}

/* Label step */
.step-label {
    font-size: 0.62rem;
    font-weight: 600;
    color: var(--g4);
    margin-top: 0.4rem;
    text-align: center;
    letter-spacing: 0.01em;
    line-height: 1.3;
    max-width: 72px;
    white-space: normal;
    transition: color var(--tr);
}
.step-item.active .step-label   { color: var(--bl5); }
.step-item.completed .step-label { color: var(--bl7); }

/* ── CARD ─────────────────────────────────────────────────── */
.card {
    background: var(--wh);
    border-radius: var(--r-lg);
    padding: 1.75rem;
    box-shadow: var(--sh-md);
    border: 1px solid var(--bl1);
    margin-bottom: 1.75rem;
    transition: box-shadow var(--tr);
}

/* ── DIMENSI HEADER ───────────────────────────────────────── */
.dimensi-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--bl1);
}

.dimensi-icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--bl9), var(--bl7));
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(40, 114, 232, 0.25);
}
.dimensi-icon svg { width: 22px; height: 22px; fill: none; stroke: #fff; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }

.dimensi-meta { flex: 1; }

.dimensi-step-label {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--bl4);
    margin-bottom: 0.15rem;
}

.dimensi-title {
    font-size: clamp(1rem, 2.5vw, 1.2rem);
    font-weight: 800;
    color: var(--bl9);
    letter-spacing: -0.01em;
}

.dimensi-count {
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--g4);
    background: var(--g1);
    border: 1px solid var(--g2);
    border-radius: 999px;
    padding: 0.25em 0.75em;
    white-space: nowrap;
    align-self: flex-start;
}

/* ── INSTRUKSI ────────────────────────────────────────────── */
.instruksi {
    font-size: 0.87rem;
    color: var(--g6);
    line-height: 1.65;
    padding: 0.85rem 1.1rem;
    background: var(--bl0);
    border-left: 3px solid var(--bl5);
    border-radius: 0 var(--r-sm) var(--r-sm) 0;
    margin-bottom: 1.5rem;
}

/* ── FORM GROUP (tiap soal) ───────────────────────────────── */
.form-group {
    padding: 1.1rem 1.25rem;
    border-radius: var(--r-sm);
    border: 1.5px solid var(--g2);
    background: var(--g1);
    margin-bottom: 0.85rem;
    transition: border-color var(--tr), background var(--tr), box-shadow var(--tr);
}
.form-group:hover {
    border-color: var(--bl4);
    background: var(--bl0);
    box-shadow: 0 2px 10px rgba(40, 114, 232, 0.08);
}
.form-group.answered {
    border-color: var(--bl4);
    background: var(--bl0);
}

/* Teks pertanyaan */
.form-group > .soal-label {
    display: block;
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--g8);
    line-height: 1.65;
    margin-bottom: 0.85rem;
}

.soal-nomor {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px; height: 24px;
    border-radius: 6px;
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    color: var(--wh);
    font-size: 0.72rem;
    font-weight: 800;
    margin-right: 0.5rem;
    flex-shrink: 0;
    vertical-align: middle;
    position: relative;
    top: -1px;
}

/* ── RADIO SKALA ──────────────────────────────────────────── */
.skala-wrapper {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
}

.skala-hint-row {
    display: flex;
    justify-content: space-between;
    font-size: 0.68rem;
    color: var(--g4);
    font-weight: 600;
    letter-spacing: 0.02em;
    padding: 0 0.1rem;
    margin-bottom: 0.1rem;
}

.radio-pills {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.radio-pills label {
    flex: 1;
    min-width: 44px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.2rem;
    padding: 0.5em 0.3em;
    border-radius: var(--r-sm);
    border: 1.5px solid var(--g2);
    background: var(--wh);
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--g6);
    cursor: pointer;
    transition: background var(--tr), border-color var(--tr),
                color var(--tr), box-shadow var(--tr), transform var(--tr);
    user-select: none;
    text-align: center;
}

.radio-pills label:hover {
    border-color: var(--bl4);
    color: var(--bl7);
    background: var(--bl0);
    transform: translateY(-2px);
    box-shadow: 0 3px 10px rgba(40, 114, 232, 0.14);
}

.radio-pills label .pill-desc {
    font-size: 0.6rem;
    font-weight: 500;
    color: var(--g4);
    line-height: 1.2;
    text-align: center;
    display: block;
}

.radio-pills input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0; height: 0;
    pointer-events: none;
}

/* State terpilih */
.radio-pills label:has(input:checked) {
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    border-color: transparent;
    color: var(--wh);
    box-shadow: 0 4px 12px rgba(40, 114, 232, 0.35);
    transform: translateY(-2px);
}
.radio-pills label:has(input:checked) .pill-desc {
    color: rgba(255,255,255,0.75);
}

/* Fallback browser lama */
@supports not (selector(:has(*))) {
    .radio-pills input[type="radio"] {
        position: static;
        opacity: 1;
        width: auto; height: auto;
        pointer-events: auto;
        accent-color: var(--bl5);
        margin-bottom: 0.2rem;
    }
}

/* ── NAVIGASI WIZARD ──────────────────────────────────────── */
.wizard-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    padding: 1.25rem 1.75rem;
    background: linear-gradient(135deg, var(--bl9) 0%, var(--bl7) 100%);
    border-radius: var(--r-lg);
    border: none;
    flex-wrap: wrap;
}

.wizard-progress-text {
    font-size: 0.8rem;
    font-weight: 600;
    color: rgba(255,255,255,0.65);
    letter-spacing: 0.04em;
    white-space: nowrap;
}
.wizard-progress-text span {
    color: var(--wh);
    font-weight: 800;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    padding: 0.6em 1.4em;
    border-radius: var(--r-sm);
    font-size: 0.88rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    border: none;
    white-space: nowrap;
    transition: background var(--tr), box-shadow var(--tr), transform var(--tr);
    background: rgba(255,255,255,0.14);
    color: var(--wh);
    border: 1.5px solid rgba(255,255,255,0.35);
}
.btn:hover {
    background: rgba(255,255,255,0.26);
    border-color: rgba(255,255,255,0.6);
    transform: translateY(-1px);
    color: var(--wh);
}
.btn:active { transform: translateY(0); }

.btn-next {
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    border-color: transparent;
    box-shadow: 0 3px 12px rgba(40,114,232,0.4);
}
.btn-next:hover {
    background: linear-gradient(135deg, #1a4fad, var(--bl5));
    box-shadow: 0 5px 18px rgba(40,114,232,0.5);
}

.btn-submit {
    background: linear-gradient(135deg, #16a34a, #22c55e);
    border-color: transparent;
    box-shadow: 0 3px 12px rgba(22,163,74,0.4);
}
.btn-submit:hover {
    background: linear-gradient(135deg, #15803d, #16a34a);
    box-shadow: 0 5px 18px rgba(22,163,74,0.5);
}

/* ── PANEL STEP (show/hide) ───────────────────────────────── */
.step-panel { display: none; animation: fadeSlide 0.3s ease; }
.step-panel.active { display: block; }

@keyframes fadeSlide {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── RESPONSIVE ───────────────────────────────────────────── */
@media (max-width: 768px) {
    h1 { margin-bottom: 1.25rem; }
    .card { padding: 1.25rem; }

    .dimensi-header { gap: 0.6rem; }
    .dimensi-icon { width: 38px; height: 38px; border-radius: 10px; }

    .radio-pills { gap: 0.35rem; }
    .radio-pills label { padding: 0.45em 0.2em; font-size: 0.8rem; min-width: 38px; }
    .radio-pills label .pill-desc { display: none; }

    .wizard-nav {
        flex-direction: column;
        align-items: stretch;
        padding: 1.1rem 1.25rem;
    }
    .wizard-nav .btn { width: 100%; justify-content: center; padding: 0.75em; }
    .wizard-progress-text { text-align: center; }

    .step-label { font-size: 0.58rem; max-width: 56px; }
}
</style>
@endsection

@section('content')
<h1>Kuesioner Deteksi Dini Risiko Burnout Akademik</h1>

{{-- Step Indicator --}}
@php
    $dimensiList = $soals->groupBy('kategori')->keys()->values();
    $dimensiIcons = [
        'Exhaustion'              => '<path d="M13 10V3L4 14h7v7l9-11h-7z"/>',
        'Mental Distance'         => '<path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><circle cx="12" cy="17" r=".5" fill="currentColor"/>',
        'Cognitive Impairment'    => '<path d="M12 2a9 9 0 0 1 9 9c0 3.6-2.1 6.7-5.1 8.2L15 21H9l-.9-1.8C5.1 17.7 3 14.6 3 11a9 9 0 0 1 9-9z"/><line x1="9" y1="9" x2="9" y2="13"/><line x1="15" y1="9" x2="15" y2="13"/>',
        'Emotional Impairment'    => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>',
        'Psychological Distress'  => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/>',
        'Psychosomatic Complaints'=> '<path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.2.2 0 1 0 .3.3"/><path d="M8 15v1a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6v-4"/>',
    ];
@endphp

<div class="wizard-steps">
    @foreach ($dimensiList as $i => $nama)
        <div class="step-item {{ $i === 0 ? 'active' : '' }}" id="step-indicator-{{ $i }}" data-step="{{ $i }}">
            <div class="step-dot">
                @if ($i === 0)
                    {{ $i + 1 }}
                @else
                    {{ $i + 1 }}
                @endif
            </div>
            <span class="step-label">{{ $nama }}</span>
        </div>
    @endforeach
</div>

<form method="POST" action="{{ route('mahasiswa.tes.store') }}" id="tes-form">
    @csrf

    @php $soalGrouped = $soals->groupBy('kategori'); @endphp

    @foreach ($soalGrouped as $dimensi => $soalDimensi)
        @php
            $stepIdx = $loop->index;
            $iconPath = $dimensiIcons[$dimensi] ?? '<circle cx="12" cy="12" r="10"/>';
        @endphp

        <div class="step-panel {{ $stepIdx === 0 ? 'active' : '' }}" id="step-panel-{{ $stepIdx }}">
            <div class="card">
                {{-- Header Dimensi --}}
                <div class="dimensi-header">
                    <div class="dimensi-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            {!! $iconPath !!}
                        </svg>
                    </div>
                    <div class="dimensi-meta">
                        <div class="dimensi-step-label">Dimensi {{ $stepIdx + 1 }} dari {{ $soalGrouped->count() }}</div>
                        <div class="dimensi-title">{{ $dimensi }}</div>
                    </div>
                    <span class="dimensi-count">{{ $soalDimensi->count() }} soal</span>
                </div>

                {{-- Instruksi --}}
                <p class="instruksi">
                    Pilih angka yang paling menggambarkan kondisi Anda.
                    <strong>1</strong> = Sangat Tidak Setuju &nbsp;·&nbsp;
                    <strong>5</strong> = Sangat Setuju
                </p>

                {{-- Soal --}}
                @foreach ($soalDimensi as $soal)
                    @php $globalIdx = $soals->search(fn($s) => $s->id === $soal->id); @endphp
                    <div class="form-group" id="fg-{{ $soal->id }}">
                        <span class="soal-label">
                            <span class="soal-nomor">{{ $globalIdx + 1 }}</span>
                            {{ $soal->pertanyaan }}
                        </span>
                        <div class="skala-wrapper">
                            <div class="skala-hint-row">
                                <span>Sangat Tidak Setuju</span>
                                <span>Sangat Setuju</span>
                            </div>
                            <div class="radio-pills">
                                @php
                                    $pillLabels = ['', 'Tidak\nSetuju', 'Cukup', 'Setuju', ''];
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <label>
                                        <input type="radio"
                                               name="jawaban[{{ $soal->id }}]"
                                               value="{{ $i }}"
                                               required
                                               onchange="markAnswered({{ $soal->id }})">
                                        {{ $i }}
                                        <span class="pill-desc">
                                            @if ($i === 1) Sangat<br>Tidak Setuju
                                            @elseif ($i === 2) Tidak<br>Setuju
                                            @elseif ($i === 3) Netral
                                            @elseif ($i === 4) Setuju
                                            @else Sangat<br>Setuju
                                            @endif
                                        </span>
                                    </label>
                                @endfor
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Navigasi --}}
            <div class="wizard-nav">
                @if ($stepIdx > 0)
                    <button type="button" class="btn btn-prev" onclick="goStep({{ $stepIdx - 1 }})">
                        ← Sebelumnya
                    </button>
                @else
                    <span></span>
                @endif

                <span class="wizard-progress-text">
                    Langkah <span>{{ $stepIdx + 1 }}</span> dari <span>{{ $soalGrouped->count() }}</span>
                </span>

                @if (!$loop->last)
                    <button type="button" class="btn btn-next" onclick="nextStep({{ $stepIdx }}, {{ $soalDimensi->pluck('id')->toJson() }})">
                        Selanjutnya →
                    </button>
                @else
                    <button type="submit" class="btn btn-submit">
                        ✓ Selesaikan Tes
                    </button>
                @endif
            </div>
        </div>
    @endforeach
</form>
@endsection

@section('scripts')
<script>
    const totalSteps = {{ $soalGrouped->count() }};

    function goStep(idx) {
        // Sembunyikan semua panel
        document.querySelectorAll('.step-panel').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.step-item').forEach(s => s.classList.remove('active'));

        // Tampilkan panel tujuan
        document.getElementById('step-panel-' + idx).classList.add('active');
        document.getElementById('step-indicator-' + idx).classList.add('active');

        // Scroll ke atas
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function nextStep(currentIdx, soalIds) {
        // Validasi: semua soal di step ini harus dijawab
        let allAnswered = true;
        soalIds.forEach(id => {
            const radios = document.querySelectorAll(`input[name="jawaban[${id}]"]`);
            const answered = Array.from(radios).some(r => r.checked);
            if (!answered) {
                allAnswered = false;
                // Highlight soal yang belum dijawab
                document.getElementById('fg-' + id).style.borderColor = '#ef4444';
                document.getElementById('fg-' + id).style.background  = '#fff5f5';
            }
        });

        if (!allAnswered) {
            alert('Harap jawab semua pertanyaan sebelum melanjutkan.');
            return;
        }

        // Tandai step sekarang sebagai completed
        document.getElementById('step-indicator-' + currentIdx).classList.add('completed');
        goStep(currentIdx + 1);
    }

    function markAnswered(soalId) {
        const fg = document.getElementById('fg-' + soalId);
        fg.classList.add('answered');
        fg.style.borderColor = '';
        fg.style.background  = '';
    }
</script>
@endsection