@extends('layouts.app')

@section('title', 'Hasil Tes Burnout')

@section('styles')
<style>
/* ============================================================
   mahasiswa/tes/hasil.blade.php — Custom CSS
   Theme  : Blue & White | Report Style | Modern Responsive
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
    --green5: #16a34a;
    --green1: #dcfce7;
    --green0: #f0fdf4;
    --yel5  : #a16207;
    --yel1  : #fef9c3;
    --red5  : #b91c1c;
    --red1  : #fee2e2;
    --r-sm : 10px;
    --r-lg : 20px;
    --r-xl : 28px;
    --sh-md: 0 4px 16px rgba(40, 114, 232, 0.10);
    --sh-lg: 0 8px 32px rgba(40, 114, 232, 0.15);
    --tr   : 0.22s cubic-bezier(.4, 0, .2, 1);
}

/* ── PAGE WRAPPER ─────────────────────────────────────────── */
.laporan-wrapper {
    max-width: 780px;
    margin: 0 auto;
    padding: 1.25rem 0.75rem 2rem;
}

/* ── LAPORAN CARD UTAMA ───────────────────────────────────── */
.laporan-card {
    background: var(--wh);
    border-radius: var(--r-xl);
    border: 1px solid var(--g2);
    box-shadow: var(--sh-lg);
    overflow: hidden;
}

/* ── HEADER LAPORAN ───────────────────────────────────────── */
.laporan-header {
    padding: 1.4rem 1.5rem 1.1rem;
    border-bottom: 1px solid var(--g2);
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
}

.laporan-header-left { flex: 1; }

.laporan-eyebrow {
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--g4);
    margin-bottom: 0.4rem;
}

.laporan-title {
    font-size: clamp(1.2rem, 3vw, 1.55rem);
    font-weight: 800;
    color: var(--g8);
    letter-spacing: -0.02em;
    line-height: 1.25;
}

.laporan-date {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--g6);
    background: var(--g1);
    border: 1px solid var(--g2);
    border-radius: 999px;
    padding: 0.4em 1em;
    white-space: nowrap;
    flex-shrink: 0;
    align-self: flex-start;
    margin-top: 0.25rem;
}
.laporan-date svg {
    width: 14px; height: 14px;
    stroke: var(--g4); fill: none;
    stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
    flex-shrink: 0;
}

/* ── SECTION LABEL ────────────────────────────────────────── */
.section-label {
    font-size: 0.68rem;
    font-weight: 800;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--g4);
    padding: 1.5rem 2.5rem 0.75rem;
    margin-bottom: 0.4rem;
}

/* ── ANALISIS BOX ─────────────────────────────────────────── */
.analisis-box {
    margin: 0 1.5rem 1rem;
    border: 1px solid var(--g2);
    border-radius: var(--r-lg);
    display: flex;
    align-items: stretch;
    overflow: hidden;
    background: var(--wh);
}

.skor-visual {
    width: 220px;
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    padding: 1.35rem 1.25rem;
    background: var(--g1);
    border-right: 1px solid var(--g2);
}

.skor-ring {
    position: relative;
    width: 100px; height: 100px;
}
.skor-ring svg {
    width: 100%; height: 100%;
    transform: rotate(-90deg);
}
.skor-ring-bg {
    fill: none;
    stroke: var(--g2);
    stroke-width: 8;
}
.skor-ring-fill {
    fill: none;
    stroke-width: 8;
    stroke-linecap: round;
    transition: stroke-dashoffset 1s ease;
}
.ring-rendah        { stroke: var(--green5); }
.ring-sedang        { stroke: #eab308; }
.ring-tinggi        { stroke: #ef4444; }

.skor-ring-text {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    line-height: 1;
}
.skor-angka {
    font-size: 1.75rem;
    font-weight: 900;
    color: var(--g8);
    letter-spacing: -0.04em;
}
.skor-max {
    font-size: 0.7rem;
    color: var(--g4);
    font-weight: 600;
    margin-top: 0.15rem;
}
.skor-caption {
    font-size: 0.65rem;
    font-weight: 800;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--g4);
}

.skor-detail {
    flex: 1;
    padding: 1.4rem 1.75rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 0.65rem;
}

/* ── BADGE ────────────────────────────────────────────────── */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.3em 0.9em;
    border-radius: 999px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    white-space: nowrap;
    align-self: flex-start;
}
.badge::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 50%;
    background: currentColor;
    flex-shrink: 0;
}
.badge-rendah        { background: var(--green1); color: var(--green5); }
.badge-sedang        { background: var(--yel1);   color: var(--yel5); }
.badge-tinggi        { background: var(--red1);   color: var(--red5); }

.status-title {
    font-size: 1.3rem;
    font-weight: 800;
    color: var(--g8);
    letter-spacing: -0.02em;
    line-height: 1.2;
}
.status-desc {
    font-size: 0.88rem;
    color: var(--g6);
    line-height: 1.75;
}

/* ── INFO GRID ────────────────────────────────────────────── */
.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    border-top: 1px solid var(--g2);
}
.info-col { padding: 1.25rem 1.5rem; }
.info-col:first-child { border-right: 1px solid var(--g2); }

.info-col-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
    font-weight: 800;
    color: var(--g8);
}

.dimension-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 0.9rem;
    padding: 0 1.5rem 1rem;
    max-width: 720px;
    margin: 0 auto 1rem;
}

.dimension-card {
    border: 1px solid var(--g2);
    border-radius: var(--r-lg);
    padding: 1rem;
    background: var(--wh);
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.dimension-card-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.dimension-card-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--bl7);
}

.dimension-card-badge {
    font-size: 0.68rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    padding: 0.35em 0.75em;
    border-radius: 999px;
    border: 1px solid var(--g2);
}

.dimension-card-badge.rendah { background: rgba(22,163,74,0.08); color: #166534; }
.dimension-card-badge.sedang { background: rgba(161,98,7,0.08); color: #a16207; }
.dimension-card-badge.tinggi { background: rgba(185,28,28,0.08); color: #b91c1c; }

.dimension-card-score {
    display: flex;
    align-items: baseline;
    gap: 0.4rem;
}

.dimension-card-score span {
    font-size: 1.5rem;
    font-weight: 800;
}

.dimension-card-bar {
    width: 100%;
    height: 10px;
    border-radius: 999px;
    background: var(--g1);
    overflow: hidden;
}

.dimension-card-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--bl5), var(--bl4));
}

.dimension-card-note {
    font-size: 0.85rem;
    line-height: 1.6;
    color: var(--g6);
    margin-top: 0.25rem;
    margin-bottom: 1.1rem;
}
.info-col-title svg {
    width: 18px; height: 18px;
    stroke: var(--bl5); fill: none;
    stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
    flex-shrink: 0;
}

.info-list {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 0.65rem;
}
.info-list li {
    display: flex;
    align-items: flex-start;
    gap: 0.55rem;
    font-size: 0.84rem;
    color: var(--g6);
    line-height: 1.6;
}
.info-list li svg {
    width: 15px; height: 15px;
    fill: none; stroke-width: 2.5;
    stroke-linecap: round; stroke-linejoin: round;
    flex-shrink: 0; margin-top: 2px;
}
.col-interpretasi .info-list li svg { stroke: var(--green5); }
.col-rekomendasi  .info-list li svg { stroke: var(--bl5); }

/* ── ACTION BAR ───────────────────────────────────────────── */
.action-bar {
    padding: 1.75rem 2.5rem;
    border-top: 1px solid var(--g2);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
    background: var(--g1);
}

/* ── BUTTON ───────────────────────────────────────────────── */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.45rem;
    padding: 0.7em 1.5em;
    border-radius: 12px;
    font-size: 0.88rem;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    border: none;
    white-space: nowrap;
    font-family: inherit;
    transition: background var(--tr), box-shadow var(--tr), transform var(--tr);
}
.btn svg {
    width: 15px; height: 15px;
    stroke: currentColor; fill: none;
    stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    flex-shrink: 0;
}
.btn:active { transform: translateY(0); }

.btn-primary {
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    color: var(--wh);
    box-shadow: 0 3px 12px rgba(40,114,232,0.35);
}
.btn-primary:hover {
    background: linear-gradient(135deg, var(--bl7), var(--bl5));
    box-shadow: 0 5px 18px rgba(40,114,232,0.45);
    transform: translateY(-2px);
    color: var(--wh);
}

.btn-outline {
    background: var(--wh);
    color: var(--g8);
    border: 1.5px solid var(--g2);
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.btn-outline:hover {
    background: var(--g1);
    border-color: var(--g4);
    color: var(--g8);
    box-shadow: 0 4px 12px rgba(0,0,0,0.10);
    transform: translateY(-1px);
}

.btn-success {
    background: linear-gradient(135deg, #16a34a, #22c55e);
    color: var(--wh);
    box-shadow: 0 3px 12px rgba(22, 163, 74, 0.35);
}
.btn-success:hover {
    background: linear-gradient(135deg, #15803d, #16a34a);
    box-shadow: 0 5px 18px rgba(22, 163, 74, 0.45);
    transform: translateY(-2px);
    color: var(--wh);
}

/* Psikolog — ungu/violet */
.btn-psikolog {
    background: linear-gradient(135deg, #7c3aed, #a855f7);
    color: var(--wh);
    box-shadow: 0 3px 12px rgba(124, 58, 237, 0.35);
}
.btn-psikolog:hover {
    background: linear-gradient(135deg, #6d28d9, #7c3aed);
    box-shadow: 0 5px 18px rgba(124, 58, 237, 0.45);
    transform: translateY(-2px);
    color: var(--wh);
}

/* ── FOOTER LAPORAN ───────────────────────────────────────── */
.laporan-footer {
    padding: 1.1rem 2.5rem;
    border-top: 1px solid var(--g2);
    text-align: center;
    background: var(--wh);
}
.laporan-footer p {
    font-size: 0.72rem;
    color: var(--g4);
}

/* ── TABEL DETAIL ─────────────────────────────────────────── */
.detail-card {
    background: var(--wh);
    border-radius: var(--r-lg);
    border: 1px solid var(--g2);
    box-shadow: var(--sh-md);
    overflow: hidden;
    margin-top: 1rem;
}
.detail-card-header {
    padding: 0.9rem 1.25rem;
    border-bottom: 1px solid var(--g2);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
    font-weight: 800;
    color: var(--g8);
}
.pagination-wrapper {
    padding: 1rem 1.25rem 1.35rem;
    display: flex;
    justify-content: center;
}
nav[role="navigation"] {
    display: flex;
    justify-content: center;
}

nav[role="navigation"] > div:first-child {
    display: none;
}

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

nav[role="navigation"] a {
    color: var(--g6);
    background: var(--wh);
}

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
}

.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.88rem;
    margin: 0;
}
.table thead th {
    padding: 0.75rem 0.85rem;
}
.table tbody td {
    padding: 0.65rem 0.95rem;
    color: var(--g8);
    vertical-align: middle;
    line-height: 1.45;
}
.detail-card-header::before {
    content: '';
    display: inline-block;
    width: 4px; height: 1.1em;
    background: linear-gradient(180deg, var(--bl5), var(--bl4));
    border-radius: 2px;
    flex-shrink: 0;
}

.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.88rem;
}
.table thead tr { background: linear-gradient(90deg, var(--bl9), var(--bl7)); }
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
.table thead th:nth-child(1),
.table thead th:nth-child(4),
.table tbody td:nth-child(1),
.table tbody td:nth-child(4) { text-align: center; }

.table tbody tr { border-bottom: 1px solid var(--g2); transition: background var(--tr); }
.table tbody tr:last-child { border-bottom: none; }
.table tbody tr:hover { background: var(--bl0); }
.table tbody td {
    padding: 0.85rem 1rem;
    color: var(--g8);
    vertical-align: middle;
    line-height: 1.55;
}
.info-desc {
    font-size: 0.93rem;
    line-height: 1.6;
    color: var(--g6);
}
.single-info {
    max-width: 720px;
    margin: 0 auto 1.5rem;
    padding: 0 2rem;
}
.single-info .info-col {
    border: none;
    padding: 1.25rem 0;
}
.table tbody td:first-child {
    font-weight: 700; color: var(--g4);
    font-size: 0.82rem; width: 48px;
}
.table tbody td:nth-child(2) { min-width: 260px; }
.table tbody td:nth-child(3) { white-space: nowrap; }
.table tbody td:nth-child(4) {
    font-weight: 800; font-size: 1rem; color: var(--bl5);
}

.kategori-pill {
    display: inline-flex;
    align-items: center;
    padding: 0.22em 0.75em;
    border-radius: 999px;
    font-size: 0.73rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    background: var(--bl0);
    color: var(--bl7);
    border: 1px solid var(--bl1);
    white-space: nowrap;
}

/* ── RESPONSIVE ───────────────────────────────────────────── */
@media (max-width: 768px) {
    .laporan-wrapper { padding: 1rem 0.75rem 1.5rem; }
    .laporan-header  { padding: 1.25rem 1.15rem 1rem; }
    .section-label   { padding: 1rem 1.15rem 0.5rem; }

    .analisis-box {
        flex-direction: column;
        margin: 0 1rem 1.25rem;
    }
    .skor-visual {
        width: 100%;
        border-right: none;
        border-bottom: 1px solid var(--g2);
        flex-direction: row;
        padding: 1.25rem 1.5rem;
        gap: 1.25rem;
        justify-content: flex-start;
    }
    .skor-detail { padding: 1.25rem 1.5rem; }

    .info-grid { grid-template-columns: 1fr; }
    .info-col:first-child { border-right: none; border-bottom: 1px solid var(--g2); }
    .info-col { padding: 1.25rem 1.5rem; }

    .action-bar {
        padding: 1.25rem 1.5rem;
        flex-direction: column;
    }
    .btn { width: 100%; justify-content: center; }

    .laporan-footer { padding: 1rem 1.25rem; }
    .detail-card { border-radius: var(--r-lg); margin-top: 1rem; }
    .detail-card-header { padding: 1rem 1.25rem; }
    .table {
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .laporan-wrapper { padding: 1.5rem 1.25rem 2.5rem; }
}
</style>
@endsection

@section('content')
@php
    $level         = $percobaan->levelRisiko->nama_level;
    $slug          = strtolower(str_replace(' ', '-', $level));
    $skor          = $percobaan->total_skor;
    $maxSkor = 100;
    $pct = $skor;
    $circumference = 2 * M_PI * 42;
    $offset        = $circumference - ($pct / 100) * $circumference;

    $statusMap = [
        'rendah'        => 'Status Mental Stabil',
        'sedang'        => 'Perlu Perhatian',
        'tinggi'        => 'Risiko Burnout Tinggi',
    ];
    $statusTitle = $statusMap[$slug] ?? $level;

    $dimensionScores = $percobaan->calculateDimensionScores();
    $topDimension = $dimensionScores->first();

    $dimensiInterpretasi = [
        'Exhaustion' => [
            'rendah' => ['Energi Anda masih relatif baik dan rasa lelah dapat diatasi dengan istirahat normal.', 'Keseimbangan aktivitas akademik dan istirahat masih terjaga secara umum.'],
            'sedang' => ['Kelelahan mulai mempengaruhi fokus dan produktivitas Anda.', 'Perlu jeda yang lebih terstruktur agar energi tidak terus menurun.'],
            'tinggi' => ['Anda menunjukkan tingkat kelelahan tinggi yang dapat mengganggu kemampuan belajar dan motivasi.', 'Istirahat dan pemulihan segera dibutuhkan untuk mencegah gangguan burnout lebih lanjut.'],
        ],
        'Mental Distance' => [
            'rendah' => ['Keterikatan terhadap studi dan tujuan akademik masih baik.', 'Anda belum menunjukkan tanda-tanda menjauhkan diri secara emosional dari studi.'],
            'sedang' => ['Anda mulai merasa terpisah dari tujuan akademik dan lingkungan belajar.', 'Perlu usaha untuk menemukan motivasi kembali dan menghubungkan studi dengan tujuan pribadi.'],
            'tinggi' => ['Anda sangat cenderung menjauh secara mental dari studi, dan hal ini menurunkan keterlibatan Anda.', 'Coba cari kembali makna belajar serta dukungan sosial yang dapat membantu.'],
        ],
        'Cognitive Impairment' => [
            'rendah' => ['Kemampuan konsentrasi dan ingatan Anda masih terjaga dengan baik.', 'Anda mampu menyelesaikan tugas akademik dengan pemikiran yang relatif jernih.'],
            'sedang' => ['Mulai muncul gangguan konsentrasi dan daya ingat yang membuat belajar lebih berat.', 'Atur waktu istirahat dan teknik belajar untuk menjaga kejernihan pikiran.'],
            'tinggi' => ['Ada indikasi gangguan kognitif yang signifikan, seperti sulit fokus atau mengingat informasi.', 'Fokus pada pemulihan mental melalui istirahat terjadwal dan lingkungan belajar yang lebih tenang.'],
        ],
        'Emotional Impairment' => [
            'rendah' => ['Emosi Anda relatif stabil dan belum terlalu memengaruhi aktivitas belajar.', 'Anda masih mampu menyeimbangkan perasaan dengan tanggung jawab akademik.'],
            'sedang' => ['Emosi mulai mudah terganggu dan ini memengaruhi interaksi sehari-hari.', 'Perlu cara meredakan stres emosional sebelum hal tersebut menurunkan kinerja.'],
            'tinggi' => ['Gangguan emosional tinggi bisa memperburuk penurunan motivasi dan hubungan sosial.', 'Pertimbangkan teknik relaksasi dan dukungan emosional untuk meredakan tekanan.'],
        ],
        'Psychological Distress' => [
            'rendah' => ['Tingkat tekanan psikologis Anda relatif rendah dan masih dapat dikelola.', 'Anda berada dalam kondisi mental yang stabil untuk menyelesaikan tugas.'],
            'sedang' => ['Anda merasakan tekanan psikologis yang mulai mengganggu kesejahteraan.', 'Amati sumber stres dan cari cara menguranginya melalui dukungan atau jeda.'],
            'tinggi' => ['Tekanan psikologis tinggi dapat menyebabkan kecemasan, gangguan tidur, atau kelelahan emosional.', 'Segera cari bantuan konselor atau dukungan agar mental Anda kembali stabil.'],
        ],
        'Psychosomatic Complaints' => [
            'rendah' => ['Keluhan fisik masih minim dan tidak terlalu memengaruhi aktivitas sehari-hari.', 'Tetap jaga kesehatan tubuh agar kondisi ini tidak bertambah buruk.'],
            'sedang' => ['Ada keluhan fisik yang mulai mengganggu, seperti sakit kepala atau gangguan tidur.', 'Perhatikan pola tidur dan kebiasaan sehat untuk mengurangi gejala fisik.'],
            'tinggi' => ['Keluhan psikosomatik tinggi dapat menandakan stres berat yang memengaruhi tubuh.', 'Segera perbaiki pola hidup, istirahat, dan jika perlu konsultasi medis ringan.'],
        ],
    ];

    $dimensiRekomendasi = [
        'Exhaustion' => [
            'rendah' => ['Pertahankan pola istirahat yang cukup dan jadwal tidur teratur.', 'Lanjutkan pengaturan energi dengan jeda rutin antar sesi belajar.'],
            'sedang' => ['Sisihkan waktu istirahat lebih panjang setiap hari.', 'Kurangi aktivitas berlebihan dan fokus pada tugas penting saja.'],
            'tinggi' => ['Segera tambahkan hari istirahat dan kurangi beban akademik.', 'Bicarakan pengaturan tugas dengan dosen atau pembimbing.'],
        ],
        'Mental Distance' => [
            'rendah' => ['Tetap pertahankan tujuan belajar dan keterlibatan Anda.', 'Bangun rutinitas yang membuat studi terasa bermakna.'],
            'sedang' => ['Tentukan tujuan kecil yang jelas untuk tiap minggu.', 'Diskusikan pengalaman akademik Anda dengan teman atau pembimbing.'],
            'tinggi' => ['Cari kembali alasan Anda belajar dan fokus pada hal-hal yang memotivasi.', 'Pertimbangkan bimbingan dari konselor untuk menemukan kembali arah akademik.'],
        ],
        'Cognitive Impairment' => [
            'rendah' => ['Lanjutkan teknik belajar yang mendukung konsentrasi baik.', 'Istirahat teratur untuk menjaga kejernihan berpikir.'],
            'sedang' => ['Gunakan teknik pemecahan tugas yang lebih sederhana.', 'Ambil waktu istirahat pendek setiap 45-60 menit belajar.'],
            'tinggi' => ['Ciptakan lingkungan belajar yang tenang dan bebas gangguan.', 'Batasi multitasking dan fokus pada satu tugas dalam satu waktu.'],
        ],
        'Emotional Impairment' => [
            'rendah' => ['Terus gunakan mekanisme koping yang menyehatkan.', 'Jaga keseimbangan emosi dengan eksplorasi aktivitas relaksasi.'],
            'sedang' => ['Latih teknik pernapasan atau meditasi ringan.', 'Bicarakan perasaan Anda pada orang yang dipercayai.'],
            'tinggi' => ['Konsultasi dengan konselor kampus dapat membantu menstabilkan emosi.', 'Gunakan dukungan teman atau keluarga untuk meredakan tekanan.'],
        ],
        'Psychological Distress' => [
            'rendah' => ['Tetap jaga rutinitas mental yang sehat.', 'Luangkan waktu untuk aktivitas yang menyenangkan di luar studi.'],
            'sedang' => ['Identifikasi sumber stres dan kurangi bila memungkinkan.', 'Luangkan waktu untuk relaksasi atau aktivitas fisik ringan.'],
            'tinggi' => ['Konsultasi dukungan psikologis segera untuk mencegah masalah lebih parah.', 'Jangan menunda istirahat bila perasaan cemas atau tertekan meningkat.'],
        ],
        'Psychosomatic Complaints' => [
            'rendah' => ['Pertahankan pola hidup sehat untuk mencegah keluhan fisik.', 'Jaga hidrasi dan istirahat yang cukup.'],
            'sedang' => ['Perbaiki pola tidur dan aktivitas harian Anda.', 'Perhatikan sinyal tubuh dan kurangi stres fisik.'],
            'tinggi' => ['Segera konsultasi medis ringan bila nyeri atau gangguan tidur berlanjut.', 'Kurangi tekanan aktivitas dan berikan tubuh waktu untuk pulih.'],
        ],
    ];

    $rekomendasi = [];
    $interpretasi = [];
    if ($topDimension && isset($dimensiInterpretasi[$topDimension['kategori']][$topDimension['level']])) {
        $interpretasi = $dimensiInterpretasi[$topDimension['kategori']][$topDimension['level']];
        $rekomendasi = $dimensiRekomendasi[$topDimension['kategori']][$topDimension['level']] ?? [];
    }
@endphp

<div class="laporan-wrapper">

    {{-- ═══ LAPORAN UTAMA ═══ --}}
    <div class="laporan-card">

        {{-- Header --}}
        <div class="laporan-header">
            <div class="laporan-header-left">
                <div class="laporan-eyebrow">Laporan Akademik &bull; Official Report</div>
                <div class="laporan-title">Laporan Hasil Deteksi Burnout Akademik</div>
            </div>
            <div class="laporan-date">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8"  y1="2" x2="8"  y2="6"/>
                    <line x1="3"  y1="10" x2="21" y2="10"/>
                </svg>
                {{ $percobaan->created_at->translatedFormat('d F Y') }}
            </div>
        </div>

        {{-- Section Label --}}
        <div class="section-label">Hasil Analisis</div>

        {{-- Analisis Box --}}
        <div class="analisis-box">

            {{-- Kiri: Lingkaran Skor --}}
            <div class="skor-visual">
                <div class="skor-ring">
                    <svg viewBox="0 0 100 100">
                        <circle class="skor-ring-bg" cx="50" cy="50" r="42"/>
                        <circle class="skor-ring-fill ring-{{ $slug }}"
                                cx="50" cy="50" r="42"
                                stroke-dasharray="{{ $circumference }}"
                                stroke-dashoffset="{{ $offset }}"
                                id="skorRingFill"/>
                    </svg>
                    <div class="skor-ring-text">
                        <span class="skor-angka">{{ $skor }}</span>
                        <span class="skor-max">Skor</span>
                    </div>
                </div>
                <span class="skor-caption">Skor Burnout</span>
            </div>

            {{-- Kanan: Status & Deskripsi --}}
            <div class="skor-detail">
                <span class="badge badge-{{ $slug }}">{{ $level }}</span>
                <div class="status-title">{{ $statusTitle }}</div>
                <p class="status-desc">{{ $percobaan->levelRisiko->deskripsi }}</p>
            </div>

        </div>

        {{-- Interpretasi & Rekomendasi --}}
        <div class="info-grid">
            <div class="info-col col-interpretasi">
                    <div class="info-col-title">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8"  x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    Interpretasi Skor
                </div>
                <ul class="info-list">
                    @if($topDimension && count($interpretasi))
                        @foreach($interpretasi as $item)
                            <li>
                                <svg viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                {{ $item }}
                            </li>
                        @endforeach
                    @else
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Interpretasi berdasarkan dimensi tertinggi tidak tersedia.
                        </li>
                    @endif
                </ul>
            </div>

            <div class="info-col col-rekomendasi">
                <div class="info-col-title">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8"  x2="12" y2="16"/>
                        <line x1="8"  y1="12" x2="16" y2="12"/>
                    </svg>
                    Rekomendasi
                </div>
                <ul class="info-list">
                    @if(count($rekomendasi))
                        @foreach($rekomendasi as $item)
                            <li>
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="1" fill="currentColor"/>
                                    <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                                </svg>
                                {{ $item }}
                            </li>
                        @endforeach
                    @else
                        <li>
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="1" fill="currentColor"/>
                                <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                            </svg>
                            Rekomendasi khusus belum tersedia untuk indikator ini.
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        @php
            $dimensionScores = $percobaan->calculateDimensionScores();
            $topDimension = $dimensionScores->first();
        @endphp


        @if ($topDimension)
            <div class="info-grid" style="border-bottom: none; margin-bottom: 1rem;">
                <div class="info-col" style="padding-top: 0;">
                    <div style="font-size: 0.68rem; font-weight: 800; letter-spacing: 0.1em; text-transform: uppercase; color: var(--g4); margin-bottom: 1rem;">Indikator Tertinggi</div>
                    <div class="dimension-card dimension-{{ $topDimension['level'] }}" style="margin: 0;">
                        <div class="dimension-card-head">
                            <span class="dimension-card-title">{{ $topDimension['kategori'] }}</span>
                            <span class="dimension-card-badge {{ $topDimension['level'] }}">{{ ucfirst($topDimension['level']) }}</span>
                        </div>
                        <div class="dimension-card-score">
                            <span>{{ $topDimension['percent'] }}%</span>
                            <small>Rata-rata {{ number_format($topDimension['avg'], 2) }} / 5</small>
                        </div>
                        <div class="dimension-card-bar">
                            <div class="dimension-card-fill" style="width: {{ $topDimension['percent'] }}%;"></div>
                        </div>
                    </div>
                </div>

                <div class="info-col" style="padding-top: 0;">
                    <div style="font-size: 0.68rem; font-weight: 800; letter-spacing: 0.1em; text-transform: uppercase; color: var(--g4); margin-bottom: 1rem;">Rekomendasi Khusus</div>
                    <div class="info-col-title">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 7v5"/>
                            <path d="M12 14h.01"/>
                        </svg>
                        {{ $topDimension['kategori'] }} ({{ $topDimension['percent'] }}%)
                    </div>
                    <p class="info-desc" style="margin-top: 0.5rem;">{{ $rekomendasi[0] ?? 'Fokuskan perbaikan pada dimensi ini.' }}</p>
                </div>
            </div>
        @else
            <p class="status-desc">Data indikator tidak tersedia untuk dianalisis.</p>
        @endif

        {{-- Action Bar --}}
        <div class="action-bar">
            <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline">
                <svg viewBox="0 0 24 24">
                    <line x1="19" y1="12" x2="5" y2="12"/>
                    <polyline points="12 19 5 12 12 5"/>
                </svg>
                Kembali ke Dashboard
            </a>
            <a href="{{ route('mahasiswa.tes.index') }}" class="btn btn-primary">
                <svg viewBox="0 0 24 24">
                    <polyline points="1 4 1 10 7 10"/>
                    <path d="M3.51 15a9 9 0 1 0 .49-4"/>
                </svg>
                Tes Ulang
            </a>
            <a href="{{ route('mahasiswa.tes.pdf', $percobaan->id) }}" class="btn btn-success">
                <svg viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
                Download PDF
            </a>

            {{-- Hanya tampil jika level tinggi --}}
            @if($slug === 'tinggi')
            <a href="https://himpsi.or.id/cari-psikolog"
                target="_blank"
                rel="noopener noreferrer"
                class="btn btn-psikolog">
                Cari Psikolog HIMPSI
            </a>
            @endif
        </div>

        {{-- Footer Laporan --}}
        <div class="laporan-footer">
            <p>
                &copy; {{ date('Y') }} Sistem Deteksi Burnout Akademik &bull;
                Diselesaikan pada {{ $percobaan->created_at->translatedFormat('d F Y, H:i') }} WIB
            </p>
        </div>

    </div>

    {{-- ═══ TABEL DETAIL JAWABAN ═══ --}}
    <div class="detail-card">
        <div class="detail-card-header">Detail Jawaban</div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>Kategori</th>
                    <th>Jawaban</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jawabanPaginated as $index => $jawaban)
                    <tr>
                        <td>{{ $jawabanPaginated->firstItem() + $index }}</td>
                        <td>{{ $jawaban->soal->pertanyaan }}</td>
                        <td>
                            <span class="kategori-pill">
                                {{ $jawaban->soal->kategori }}
                            </span>
                        </td>
                        <td>{{ $jawaban->skor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($jawabanPaginated->hasPages())
            <div class="pagination-wrapper">
                {{ $jawabanPaginated->links() }}
            </div>
        @endif
    </div>

</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ring = document.getElementById('skorRingFill');
        if (!ring) return;
        const final = parseFloat(ring.getAttribute('stroke-dashoffset'));
        const circ  = parseFloat(ring.getAttribute('stroke-dasharray'));
        ring.style.strokeDashoffset = circ;
        requestAnimationFrame(() => {
            ring.style.transition = 'stroke-dashoffset 1.2s cubic-bezier(.4,0,.2,1)';
            ring.style.strokeDashoffset = final;
        });
    });
</script>
@endsection