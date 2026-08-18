<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Burnout Akademik</title>
    <style>

        @php
            $level = strtolower(str_replace(' ', '-', $percobaan->levelRisiko->nama_level));
            $skor  = $percobaan->total_skor;

            $colorMap = [
                'rendah'        => ['accent' => '#16a34a', 'bg' => '#f0fdf4', 'text' => '#15803d', 'border' => '#bbf7d0', 'pill_bg' => '#dcfce7'],
                'sedang'        => ['accent' => '#d97706', 'bg' => '#fffbeb', 'text' => '#92400e', 'border' => '#fde68a', 'pill_bg' => '#fef3c7'],
                'tinggi'        => ['accent' => '#dc2626', 'bg' => '#fff1f2', 'text' => '#991b1b', 'border' => '#fecaca', 'pill_bg' => '#fee2e2'],
                'sangat-tinggi' => ['accent' => '#9333ea', 'bg' => '#faf5ff', 'text' => '#6b21a8', 'border' => '#e9d5ff', 'pill_bg' => '#f3e8ff'],
            ];
            $c = $colorMap[$level] ?? $colorMap['sedang'];

            $statusMap = [
                'rendah'        => 'Status Mental Stabil',
                'sedang'        => 'Perlu Perhatian',
                'tinggi'        => 'Risiko Burnout Tinggi',
                'sangat-tinggi' => 'Burnout Kritis',
            ];
            $statusTitle = $statusMap[$level] ?? $level;

            $logoPath   = public_path('images/burnout.png');
            $logoBase64 = file_exists($logoPath)
                ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
                : null;
        @endphp

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1e293b;
            background: #ffffff;
            padding: 36px 40px 48px;
            line-height: 1.6;
        }

        @page { margin: 0; size: auto; }

        /* ── Document title ── */
        .doc-header {
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 16px;
            margin-bottom: 20px;
        }
        .doc-header-table { width: 100%; border-collapse: collapse; }
        .doc-header-table td { padding: 0; border: none; background: none; vertical-align: middle; }

        .logo-img {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: block;
        }
        .doc-title {
            font-size: 20px;
            font-weight: bold;
            color: #0f172a;
            padding-left: 12px;
            letter-spacing: -0.3px;
        }
        .doc-sub {
            font-size: 9px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding-left: 12px;
            margin-top: 3px;
        }
        .doc-date-cell { text-align: right; }
        .doc-date {
            font-size: 10px;
            color: #64748b;
        }

        /* ── Info Mahasiswa ── */
        .info-block {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px 18px;
            margin-bottom: 22px;
        }
        .info-block-table { width: 100%; border-collapse: collapse; }
        .info-block-table td { padding: 3px 0; border: none; background: none; vertical-align: top; }
        .info-key {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #94a3b8;
            width: 100px;
        }
        .info-sep { width: 10px; color: #cbd5e1; }
        .info-val { font-size: 12px; font-weight: bold; color: #1e293b; }

        /* ── Section heading ── */
        .section-heading {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.6px;
            color: #94a3b8;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 7px;
            margin-bottom: 14px;
            margin-top: 24px;
        }
        .section-heading:first-of-type { margin-top: 0; }

        /* ── Hasil analisis box ── */
        .hasil-box {
            border: 1.5px solid {{ $c['border'] }};
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 6px;
        }
        .hasil-top-bar {
            height: 3px;
            background: {{ $c['accent'] }};
        }
        .hasil-inner {
            padding: 20px 22px 18px;
        }
        .hasil-inner-table { width: 100%; border-collapse: collapse; }
        .hasil-inner-table td { padding: 0; border: none; background: none; vertical-align: middle; }

        .skor-col {
            width: 130px;
            text-align: center;
            border-right: 1.5px solid {{ $c['border'] }};
            padding-right: 22px;
        }
        .skor-label {
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: {{ $c['text'] }};
            margin-bottom: 6px;
        }
        .skor-num {
            font-size: 54px;
            font-weight: bold;
            color: {{ $c['accent'] }};
            line-height: 1;
        }
        .skor-of {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 6px;
        }

        .info-col {
            padding-left: 22px;
            vertical-align: top;
        }
        .level-badge {
            display: inline-block;
            background: {{ $c['pill_bg'] }};
            border: 1px solid {{ $c['border'] }};
            color: {{ $c['text'] }};
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 3px 12px;
            border-radius: 999px;
            margin-bottom: 9px;
        }
        .level-title {
            font-size: 17px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 10px;
            line-height: 1.3;
        }
        .level-desc {
            font-size: 10.5px;
            color: #475569;
            line-height: 1.8;
        }

        /* stat strip */
        .hasil-stats {
            background: {{ $c['bg'] }};
            border-top: 1px solid {{ $c['border'] }};
            padding: 13px 22px;
        }
        .stat-table { width: 100%; border-collapse: collapse; }
        .stat-table td { padding: 0; border: none; background: none; vertical-align: top; }
        .stat-lbl {
            font-size: 7.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: {{ $c['text'] }};
            opacity: 0.65;
            margin-bottom: 2px;
        }
        .stat-val {
            font-size: 14px;
            font-weight: bold;
            color: {{ $c['accent'] }};
        }
        .stat-div { width: 1px; padding: 0 !important; }
        .stat-div-inner {
            width: 1px;
            height: 26px;
            background: {{ $c['border'] }};
            margin: 0 22px;
        }

        /* ── Tabel jawaban ── */
        .jawaban-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }
        .jawaban-table th {
            background: #1e3a5f;
            color: rgba(255,255,255,0.75);
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 11px 14px;
            text-align: left;
            border: none;
        }
        .th-c { text-align: center !important; }
        .jawaban-table td {
            padding: 10px 14px;
            font-size: 10.5px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            background: #ffffff;
        }
        .jawaban-table tr:nth-child(even) td { background: #f8fafc; }
        .jawaban-table tr:last-child td { border-bottom: none; }

        .td-no {
            width: 40px;
            text-align: center;
            font-weight: bold;
            color: #94a3b8;
            font-size: 11px;
        }
        .td-kat { width: 112px; }
        .kat-chip {
            font-size: 10.5px;
            font-weight: bold;
            color: #1e3a5f;
        }
        .td-skor { width: 58px; text-align: center; }
        .skor-chip {
            font-size: 11px;
            font-weight: bold;
            color: #1e3a5f;
        }

        /* ── Footer ── */
        .footer {
            margin-top: 36px;
            padding-top: 14px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 9.5px;
            color: #94a3b8;
        }
        .footer strong { color: #64748b; }

    </style>
</head>
<body>

    {{-- Document Header --}}
    <div class="doc-header">
        <table class="doc-header-table">
            <tr>
                <td style="width:42px;">
                    @if($logoBase64)
                        <img src="{{ $logoBase64 }}" class="logo-img" alt="logo">
                    @endif
                </td>
                <td>
                    <div class="doc-title">Laporan Hasil Burnout Akademik</div>
                    <div class="doc-sub">Sistem Deteksi Burnout Akademik</div>
                </td>
                <td class="doc-date-cell">
                    <div class="doc-date">{{ now()->format('d M Y') }}</div>
                </td>
            </tr>
        </table>
    </div>

    {{-- Info Mahasiswa --}}
    <div class="info-block">
        <table class="info-block-table">
            <tr>
                <td class="info-key">Nama</td>
                <td class="info-sep">:</td>
                <td class="info-val">{{ $percobaan->user->name }}</td>
                <td style="width:40px;"></td>
                <td class="info-key">Tanggal Tes</td>
                <td class="info-sep">:</td>
                <td class="info-val">{{ $percobaan->created_at->format('d M Y') }}</td>
                <td style="width:40px;"></td>
                <td class="info-key">Waktu</td>
                <td class="info-sep">:</td>
                <td class="info-val">{{ $percobaan->created_at->format('H:i') }} WIB</td>
            </tr>
        </table>
    </div>

    {{-- Hasil Analisis --}}
    <div class="section-heading">Hasil Analisis</div>
    <div class="hasil-box">
        <div class="hasil-top-bar"></div>
        <div class="hasil-inner">
            <table class="hasil-inner-table">
                <tr>
                    <td class="skor-col">
                        <div class="skor-label">Total Skor</div>
                        <div class="skor-num">{{ $skor }}</div>
                        <div class="skor-of">dari 100 poin</div>
                    </td>
                    <td class="info-col">
                        <div class="level-badge">{{ $percobaan->levelRisiko->nama_level }}</div>
                        <div class="level-title">{{ $statusTitle }}</div>
                        <div class="level-desc">{{ $percobaan->levelRisiko->deskripsi }}</div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="hasil-stats">
            <table class="stat-table">
                <tr>
                    <td>
                        <div class="stat-lbl">Persentase</div>
                        <div class="stat-val">{{ $skor }}%</div>
                    </td>
                    <td class="stat-div"><div class="stat-div-inner"></div></td>
                    <td>
                        <div class="stat-lbl">Kategori Risiko</div>
                        <div class="stat-val">{{ $percobaan->levelRisiko->nama_level }}</div>
                    </td>
                    <td class="stat-div"><div class="stat-div-inner"></div></td>
                    <td>
                        <div class="stat-lbl">Jumlah Soal</div>
                        <div class="stat-val">{{ $percobaan->jawaban->count() }}</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Detail Jawaban --}}
    <div class="section-heading">Detail Jawaban</div>
    <table class="jawaban-table">
        <thead>
            <tr>
                <th class="td-no th-c">No</th>
                <th>Pertanyaan</th>
                <th class="td-kat">Kategori</th>
                <th class="td-skor th-c">Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($percobaan->jawaban as $index => $jawaban)
            <tr>
                <td class="td-no">{{ $index + 1 }}</td>
                <td>{{ $jawaban->soal->pertanyaan }}</td>
                <td class="td-kat"><span class="kat-chip">{{ $jawaban->soal->kategori }}</span></td>
                <td class="td-skor"><span class="skor-chip">{{ $jawaban->skor }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer">
        <strong>Sistem Deteksi Burnout Akademik</strong> &nbsp;·&nbsp; Dokumen ini bersifat rahasia &nbsp;·&nbsp; Dicetak pada {{ now()->format('d M Y, H:i') }} WIB
    </div>

</body>
</html>