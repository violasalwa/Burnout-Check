@extends('layouts.app')

@section('content')
<style>
    .help-page-wrapper {
        background: radial-gradient(circle at top right, #f8f9ff, #f3f6fc, #ffffff);
        min-height: calc(100vh - 100px);
        padding: 3rem 2rem;
        border-radius: 20px;
    }
    .dash-header-premium {
        text-align: center;
        margin-bottom: 4rem;
        position: relative;
        z-index: 1;
    }
    .dash-header-premium::before {
        content: '';
        position: absolute;
        top: -60px;
        left: 50%;
        transform: translateX(-50%);
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(99,102,241,0.08) 0%, rgba(255,255,255,0) 70%);
        z-index: -1;
    }
    .header-icon-container {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 84px;
        height: 84px;
        background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
        color: white;
        border-radius: 24px;
        margin-bottom: 1.75rem;
        box-shadow: 0 15px 30px rgba(245, 158, 11, 0.35);
        transform: rotate(-6deg);
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .header-icon-container:hover {
        transform: rotate(0deg) scale(1.08);
    }
    .dash-header-premium h1 {
        font-size: 2.75rem;
        font-weight: 800;
        background: linear-gradient(135deg, #0f172a, #334155);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1rem;
        letter-spacing: -0.5px;
    }
    .dash-header-premium p {
        font-size: 1.15rem;
        color: #64748b;
        max-width: 650px;
        margin: 0 auto;
        line-height: 1.7;
    }
    .help-grid-premium {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
        max-width: 1100px;
        margin: 0 auto;
    }
    .help-card-premium {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 24px;
        padding: 2.5rem 2rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: column;
        box-shadow: 0 10px 40px -10px rgba(0,0,0,0.05), inset 0 0 0 1px rgba(255,255,255,1);
        position: relative;
        overflow: hidden;
    }
    .help-card-premium:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(99, 102, 241, 0.15), inset 0 0 0 1px rgba(255,255,255,1);
        border-color: rgba(99, 102, 241, 0.2);
    }
    .help-icon-premium {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 68px;
        height: 68px;
        background: #f1f5f9;
        color: #f59e0b;
        border-radius: 20px;
        margin-bottom: 1.75rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .help-card-premium:hover .help-icon-premium {
        background: #f59e0b;
        color: white;
        box-shadow: 0 10px 25px rgba(245, 158, 11, 0.4);
        transform: scale(1.15) rotate(5deg);
    }
    
    /* Card 1: Amber */
    .help-card-premium:nth-child(1) .help-icon-premium { color: #f59e0b; }
    .help-card-premium:nth-child(1):hover .help-icon-premium { background: linear-gradient(135deg, #f59e0b, #fbbf24); color: white; box-shadow: 0 10px 25px rgba(245, 158, 11, 0.4); }
    
    /* Card 2: Emerald */
    .help-card-premium:nth-child(2) .help-icon-premium { color: #10b981; }
    .help-card-premium:nth-child(2):hover .help-icon-premium { background: linear-gradient(135deg, #10b981, #34d399); color: white; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4); }
    
    /* Card 3: Rose/Alert */
    .card-alert {
        background: rgba(254, 242, 242, 0.7) !important;
        border: 1px solid rgba(252, 165, 165, 0.4) !important;
    }
    .card-alert .help-icon-premium {
        background: #fee2e2;
        color: #ef4444;
    }
    .card-alert:hover {
        box-shadow: 0 25px 50px -12px rgba(239, 68, 68, 0.15), inset 0 0 0 1px rgba(255,255,255,1) !important;
        border-color: rgba(239, 68, 68, 0.4) !important;
    }
    .card-alert:hover .help-icon-premium {
        background: linear-gradient(135deg, #ef4444, #f87171) !important;
        color: white !important;
        box-shadow: 0 10px 25px rgba(239, 68, 68, 0.4) !important;
    }
    

    .help-title-premium {
        font-size: 1.35rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 1rem;
        z-index: 2;
        letter-spacing: -0.3px;
    }
    .help-desc-premium {
        color: #475569;
        line-height: 1.7;
        font-size: 1.05rem;
        flex-grow: 1;
        z-index: 2;
    }
    
    @keyframes fadeUpIn {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .help-card-premium {
        animation: fadeUpIn 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }
    .help-card-premium:nth-child(1) { animation-delay: 0.1s; }
    .help-card-premium:nth-child(2) { animation-delay: 0.2s; }
    .help-card-premium:nth-child(3) { animation-delay: 0.3s; }
</style>

<div class="dash-container">
    <div class="help-page-wrapper">
        <div class="dash-header-premium">
            <div class="header-icon-container">
                <svg viewBox="0 0 24 24" width="40" height="40" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
            </div>
            <h1>Pusat Bantuan Kaprodi</h1>
            <p>Ruang komando analitik untuk memonitor kesehatan mental akademik seluruh elemen mahasiswa di bawah naungan program studi Anda.</p>
        </div>

        <div class="help-grid-premium">
            <!-- Card 1 -->
            <div class="help-card-premium">
                <div class="help-icon-premium">
                    <svg viewBox="0 0 24 24" width="32" height="32" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <h2 class="help-title-premium">1. Analisis Data Mahasiswa</h2>
                <p class="help-desc-premium">
                    Menu <strong>Mahasiswa</strong> memberikan kapabilitas untuk melacak seluruh hasil kuesioner mahasiswa. 
                    Anda dapat menggunakan filter berdasarkan Dosen Pembimbing untuk memetakan distribusi tingkat *burnout* mahasiswa bimbingannya.
                </p>
            </div>
            
            <!-- Card 2 -->
            <div class="help-card-premium">
                <div class="help-icon-premium">
                    <svg viewBox="0 0 24 24" width="32" height="32" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <h2 class="help-title-premium">2. Evaluasi Statistik Keseluruhan</h2>
                <p class="help-desc-premium">
                    Dashboard <strong>Home</strong> menyajikan visualisasi agregat dan statistik komprehensif. 
                    Gunakan metrik ini untuk presentasi atau evaluasi kebijakan akademik prodi secara menyeluruh.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="help-card-premium card-alert">
                <div class="help-icon-premium">
                    <svg viewBox="0 0 24 24" width="32" height="32" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path><circle cx="18" cy="4" r="3"></circle></svg>
                </div>
                <h2 class="help-title-premium">3. Sistem Peringatan Dini</h2>
                <p class="help-desc-premium">
                    Ikon lonceng di atas menginformasikan peringatan dini (*Early Warning*). 
                    Notifikasi ini eksklusif untuk Anda saat terdapat mahasiswa dengan skor <strong>Tinggi</strong> atau <strong>Sangat Tinggi</strong> untuk segera diintervensi oleh prodi atau dosen wali.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
