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
        background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);
        color: white;
        border-radius: 24px;
        margin-bottom: 1.75rem;
        box-shadow: 0 15px 30px rgba(16, 185, 129, 0.35);
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
        color: #10b981;
        border-radius: 20px;
        margin-bottom: 1.75rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .help-card-premium:hover .help-icon-premium {
        background: #10b981;
        color: white;
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
        transform: scale(1.15) rotate(5deg);
    }
    
    /* Card 1: Blue */
    .help-card-premium:nth-child(1) .help-icon-premium { color: #3b82f6; }
    .help-card-premium:nth-child(1):hover .help-icon-premium { background: linear-gradient(135deg, #3b82f6, #60a5fa); color: white; box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4); }
    
    /* Card 2: Violet */
    .help-card-premium:nth-child(2) .help-icon-premium { color: #8b5cf6; }
    .help-card-premium:nth-child(2):hover .help-icon-premium { background: linear-gradient(135deg, #8b5cf6, #a78bfa); color: white; box-shadow: 0 10px 25px rgba(139, 92, 246, 0.4); }
    
    /* Card 3: Rose */
    .help-card-premium:nth-child(3) .help-icon-premium { color: #f43f5e; }
    .help-card-premium:nth-child(3):hover .help-icon-premium { background: linear-gradient(135deg, #f43f5e, #fb7185); color: white; box-shadow: 0 10px 25px rgba(244, 63, 94, 0.4); }
    
    /* Card 4: Emerald */
    .help-card-premium:nth-child(4) .help-icon-premium { color: #10b981; }
    .help-card-premium:nth-child(4):hover .help-icon-premium { background: linear-gradient(135deg, #10b981, #34d399); color: white; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4); }
    
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
    .help-card-premium:nth-child(4) { animation-delay: 0.4s; }
</style>

<div class="dash-container">
    <div class="help-page-wrapper">
        <div class="dash-header-premium">
            <div class="header-icon-container">
                <svg viewBox="0 0 24 24" width="40" height="40" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
            </div>
            <h1>Pusat Bantuan Administrator</h1>
            <p>Panduan teknis dan konfigurasi fundamental untuk memelihara integritas sistem BurnoutCheck.</p>
        </div>

        <div class="help-grid-premium">
            <!-- Card 1 -->
            <div class="help-card-premium">
                <div class="help-icon-premium">
                    <svg viewBox="0 0 24 24" width="32" height="32" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <h2 class="help-title-premium">1. Manajemen Pengguna</h2>
                <p class="help-desc-premium">
                    Gunakan menu <strong>Users</strong> untuk memodifikasi basis data pengguna. 
                    Anda wajib menetapkan peran (role) yang valid (Admin, Kaprodi, Dosen, Mahasiswa) agar otorisasi halaman berjalan semestinya.
                </p>
            </div>
            
            <!-- Card 2 -->
            <div class="help-card-premium">
                <div class="help-icon-premium">
                    <svg viewBox="0 0 24 24" width="32" height="32" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <h2 class="help-title-premium">2. Instrumen Kuesioner</h2>
                <p class="help-desc-premium">
                    Melalui menu <strong>Soal</strong>, Anda berwenang mengatur komponen tes burnout. 
                    Penambahan maupun pengurangan butir pertanyaan dimungkinkan demi mengkalibrasi instrumen yang tepat sasaran.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="help-card-premium">
                <div class="help-icon-premium">
                    <svg viewBox="0 0 24 24" width="32" height="32" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                </div>
                <h2 class="help-title-premium">3. Ambang Batas Risiko</h2>
                <p class="help-desc-premium">
                    Menu <strong>Level Risiko</strong> memetakan akumulasi poin. 
                    Sangat krusial untuk memastikan rentang skor (batas bawah & atas) tidak bersinggungan demi akurasi interpretasi hasil mahasiswa.
                </p>
            </div>
            
            <!-- Card 4 -->
            <div class="help-card-premium">
                <div class="help-icon-premium">
                    <svg viewBox="0 0 24 24" width="32" height="32" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                </div>
                <h2 class="help-title-premium">4. Rekapitulasi Menyeluruh</h2>
                <p class="help-desc-premium">
                    Dari menu <strong>Hasil Tes</strong>, Anda dapat meninjau tabulasi raw seluruh aktivitas tes mahasiswa. 
                    Anda juga dapat melakukan penyaringan berdasarkan dosen untuk kebutuhan ekstraksi data.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
