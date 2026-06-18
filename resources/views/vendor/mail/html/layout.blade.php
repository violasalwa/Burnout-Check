<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    <style type="text/css">
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }

        body {
            background-color: #f0f5ff;
            font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #2c3249;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .email-wrapper {
            background-color: #f0f5ff;
            padding: 40px 20px;
            width: 100%;
        }

        .email-container {
            background-color: #ffffff;
            border-radius: 20px;
            max-width: 600px;
            margin: 0 auto;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(40, 114, 232, 0.12);
        }

        .email-header {
            background: linear-gradient(135deg, #0d2d6b 0%, #1a4fad 50%, #2872e8 100%);
            padding: 36px 40px;
            text-align: center;
        }

        .logo-name {
            display: block;
            font-size: 26px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .logo-tagline {
            display: block;
            font-size: 11px;
            font-weight: 500;
            color: rgba(255,255,255,0.65);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 6px;
        }

        .email-body {
            padding: 40px 40px 32px;
        }

        .email-body h1 {
            font-size: 22px;
            font-weight: 700;
            color: #0d2d6b;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
            line-height: 1.3;
        }

        .email-body p {
            font-size: 15px;
            color: #5a6278;
            line-height: 1.7;
            margin-bottom: 16px;
        }

        .email-body p:last-of-type { margin-bottom: 0; }

        .email-body a {
            color: #2872e8;
            text-decoration: none;
        }

        .btn-wrapper {
            text-align: center;
            margin: 32px 0;
        }

        .btn-primary {
            display: inline-block;
            background: #2872e8;
            color: #ffffff !important;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            padding: 14px 36px;
            border-radius: 999px;
            letter-spacing: 0.02em;
            text-align: center;
        }

        .btn-success { background: #16a34a; }
        .btn-error   { background: #dc2626; }

        .subcopy-wrapper {
            background: #f4f6fb;
            border-radius: 12px;
            padding: 20px 24px;
            margin-top: 28px;
        }

        .subcopy-wrapper p {
            font-size: 13px !important;
            color: #9aa3b8 !important;
            line-height: 1.6;
            margin: 0 !important;
        }

        .subcopy-wrapper a {
            color: #2872e8 !important;
            word-break: break-all;
        }

        .email-footer {
            background: #f4f6fb;
            border-top: 1px solid #e8ecf4;
            padding: 24px 40px;
            text-align: center;
        }

        .email-footer p {
            font-size: 12px;
            color: #9aa3b8;
            line-height: 1.7;
            margin: 0;
        }

        .footer-dot {
            display: inline-block;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #dce8fd;
            margin: 0 4px;
            vertical-align: middle;
        }

        @media only screen and (max-width: 600px) {
            .email-wrapper  { padding: 20px 12px; }
            .email-header   { padding: 28px 24px; }
            .email-body     { padding: 28px 24px 24px; }
            .email-footer   { padding: 20px 24px; }
            .email-body h1  { font-size: 20px; }
            .email-body p   { font-size: 14px; }
            .btn-primary    { padding: 13px 28px; font-size: 14px; }
        }
    </style>
</head>
<body>

<div class="email-wrapper">
    <div class="email-container">

        {{-- HEADER --}}
        <div class="email-header">
            <span class="logo-name">{{ config('app.name') }}</span>
            <span class="logo-tagline">Sistem Deteksi Burnout</span>
        </div>

        {{-- BODY --}}
        <div class="email-body">
            {!! $slot !!}

            @isset($subcopy)
            <div class="subcopy-wrapper">
                {!! $subcopy !!}
            </div>
            @endisset
        </div>

        {{-- FOOTER --}}
        <div class="email-footer">
            <p>
                Email ini dikirim oleh <strong>{{ config('app.name') }}</strong><br>
                &copy; {{ date('Y') }} {{ config('app.name') }}. Semua hak dilindungi.
            </p>
            <p style="margin-top: 8px;">
                <span class="footer-dot"></span>
                Sistem Deteksi Burnout Akademik
                <span class="footer-dot"></span>
            </p>
        </div>

    </div>
</div>

</body>
</html>