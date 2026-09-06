@extends('admin.layouts.app')

@section('title', 'Kelola Teks & Konten Halaman Depan')

@section('styles')
<style>
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--brown-darker);
    }

    .page-sub {
        font-size: 0.88rem;
        color: var(--text-muted);
        margin-top: 4px;
    }

    /* Tabs Container */
    .tabs-nav {
        display: flex;
        gap: 8px;
        background: rgba(255, 255, 255, 0.85);
        padding: 6px;
        border-radius: var(--radius-full);
        border: 1px solid rgba(200, 149, 108, 0.2);
        box-shadow: var(--shadow-sm);
        margin-bottom: 28px;
        overflow-x: auto;
        scrollbar-width: none;
    }
    .tabs-nav::-webkit-scrollbar { display: none; }

    .tab-item {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: var(--radius-full);
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--brown-dark);
        border: none;
        background: transparent;
        cursor: pointer;
        transition: var(--transition);
        white-space: nowrap;
        font-family: inherit;
    }

    .tab-item:hover {
        background: var(--cream-dark);
        color: var(--brown);
    }

    .tab-item.active {
        background: linear-gradient(135deg, var(--brown-dark), var(--chocolate));
        color: #fff;
        box-shadow: 0 4px 12px rgba(61, 36, 9, 0.25);
    }

    /* Tab Content Panes */
    .tab-pane {
        display: none;
        animation: fadeIn 0.3s ease;
    }

    .tab-pane.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Form Section Card */
    .settings-card {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid rgba(200, 149, 108, 0.2);
        box-shadow: var(--shadow-sm);
        padding: 28px 32px;
        margin-bottom: 28px;
    }

    .settings-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--cream-dark);
    }

    .settings-card-icon {
        width: 42px;
        height: 42px;
        background: #FFF4E5;
        color: var(--orange);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .settings-card-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--brown-darker);
    }

    .settings-card-desc {
        font-size: 0.82rem;
        color: var(--text-muted);
        margin-top: 2px;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 20px;
    }

    .col-12 { grid-column: span 12; }
    .col-8  { grid-column: span 8; }
    .col-6  { grid-column: span 6; }
    .col-4  { grid-column: span 4; }
    .col-3  { grid-column: span 3; }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .form-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--brown-dark);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .form-label .hint {
        font-size: 0.75rem;
        font-weight: 400;
        color: var(--text-muted);
    }

    .form-input, .form-textarea {
        width: 100%;
        padding: 10px 14px;
        border-radius: var(--radius-sm);
        border: 1.5px solid #E5D5C5;
        background: #FAFAFA;
        color: var(--text-dark);
        font-size: 0.9rem;
        font-family: inherit;
        transition: var(--transition);
    }

    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: var(--orange);
        background: #FFF;
        box-shadow: 0 0 0 4px rgba(232, 137, 42, 0.12);
    }

    .form-textarea {
        min-height: 80px;
        resize: vertical;
        line-height: 1.5;
    }

    /* Image Upload Box */
    .img-upload-box {
        display: flex;
        align-items: center;
        gap: 20px;
        background: var(--cream);
        border: 1.5px dashed rgba(200, 149, 108, 0.45);
        border-radius: var(--radius-md);
        padding: 16px 20px;
        margin-top: 8px;
        flex-wrap: wrap;
    }

    .img-preview-container {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .img-preview-thumb {
        width: 130px;
        height: 100px;
        border-radius: var(--radius-sm);
        object-fit: cover;
        border: 2px solid white;
        box-shadow: var(--shadow-sm);
        background: white;
    }

    .file-input-wrapper {
        flex: 1;
        min-width: 220px;
    }

    /* Sub-card box */
    .sub-box {
        background: var(--cream);
        border: 1px dashed rgba(200, 149, 108, 0.4);
        border-radius: var(--radius-md);
        padding: 18px 20px;
        margin-bottom: 20px;
    }

    .sub-box-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--brown-dark);
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Sticky Bottom Action Bar */
    .sticky-bar {
        position: sticky;
        bottom: 20px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(200, 149, 108, 0.3);
        border-radius: var(--radius-full);
        box-shadow: var(--shadow-lg);
        padding: 12px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 36px;
        z-index: 90;
        gap: 16px;
    }

    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 32px;
        background: linear-gradient(135deg, var(--orange) 0%, var(--brown) 100%);
        color: white;
        border: none;
        border-radius: var(--radius-full);
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(232, 137, 42, 0.35);
        transition: var(--transition);
        font-family: inherit;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(232, 137, 42, 0.45);
    }

    .btn-reset {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 20px;
        background: #FEE2E2;
        color: #B91C1C;
        border: 1px solid #FCA5A5;
        border-radius: var(--radius-full);
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
    }

    .btn-reset:hover {
        background: #EF4444;
        color: white;
    }

    @media (max-width: 900px) {
        .col-8, .col-6, .col-4, .col-3 { grid-column: span 12; }
        .settings-card { padding: 20px; }
        .sticky-bar { flex-direction: column; border-radius: var(--radius-md); }
        .sticky-bar .btn-save { width: 100%; justify-content: center; }
    }
</style>
@endsection

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Kelola Teks Halaman Depan</h1>
        <p class="page-sub">Sesuaikan teks, judul, deskripsi, hingga nomor WhatsApp yang tampil pada website Cookies Intan.</p>
    </div>

    <div style="display: flex; gap: 10px;">
        <a href="{{ route('home') }}" target="_blank" class="nav-link-btn" style="background: white; border: 1px solid rgba(200, 149, 108, 0.3);">
            <i class="fa-solid fa-eye"></i> Lihat Perubahan di Web
        </a>
    </div>
</div>

<!-- Tabs Navigation -->
<div class="tabs-nav" id="settingsTabs">
    <button type="button" class="tab-item active" onclick="switchTab('tab-hero')">
        <i class="fa-solid fa-wand-magic-sparkles"></i> 1. Hero & Banner Utama
    </button>
    <button type="button" class="tab-item" onclick="switchTab('tab-features')">
        <i class="fa-solid fa-gem"></i> 2. Keunggulan & Katalog
    </button>
    <button type="button" class="tab-item" onclick="switchTab('tab-about')">
        <i class="fa-solid fa-heart"></i> 3. Tentang Kami
    </button>
    <button type="button" class="tab-item" onclick="switchTab('tab-order-faq')">
        <i class="fa-solid fa-cart-shopping"></i> 4. Cara Pesan & FAQ
    </button>
    <button type="button" class="tab-item" onclick="switchTab('tab-contact')">
        <i class="fa-solid fa-phone"></i> 5. Kontak & Footer
    </button>
</div>

<!-- Main Settings Form -->
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" id="settingsForm">
    @csrf

    <!-- ==================== TAB 1: HERO & BANNER ==================== -->
    <div class="tab-pane active" id="tab-hero">
        <!-- Foto Hero Banner Utama -->
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon"><i class="fa-solid fa-image"></i></div>
                <div>
                    <h2 class="settings-card-title">Foto Banner Utama (Hero Image)</h2>
                    <p class="settings-card-desc">Gambar besar yang tampil di sisi kanan banner utama website.</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="col-12">
                    <label class="form-label">
                        Unggah / Ganti Foto Hero
                        <span class="hint">Format JPG/PNG/WEBP, Maksimal 5MB</span>
                    </label>

                    <div class="img-upload-box">
                        <div class="img-preview-container">
                            <img id="preview_hero_image" class="img-preview-thumb" src="{{ \App\Models\SiteSetting::getImageUrl('hero_image', 'images/hero_cookies.jpg') }}" alt="Preview Hero">
                        </div>
                        <div class="file-input-wrapper">
                            <input type="file" name="hero_image" class="form-input" accept="image/*" onchange="previewImage(this, 'preview_hero_image')">
                            <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 6px;">
                                <i class="fa-solid fa-circle-info" style="color: var(--orange);"></i> Pilih gambar baru dari komputer Anda untuk mengganti foto hero saat ini.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon"><i class="fa-solid fa-bullhorn"></i></div>
                <div>
                    <h2 class="settings-card-title">Teks Utama (Hero Banner)</h2>
                    <p class="settings-card-desc">Teks utama yang pertama kali dilihat oleh pengunjung saat membuka halaman depan.</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group col-12">
                    <label class="form-label">
                        Badge Atas (Eyebrow Tag)
                        <span class="hint">Contoh: 🍪 Homemade dengan Cinta</span>
                    </label>
                    <input type="text" name="hero_eyebrow" class="form-input" value="{{ $settings['hero_eyebrow'] ?? '🍪 Homemade dengan Cinta' }}">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">Judul Baris 1 (Utama)</label>
                    <input type="text" name="hero_title_1" class="form-input" value="{{ $settings['hero_title_1'] ?? 'Manis untuk' }}">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">
                        Judul Highlight (Warna Emas/Oranye)
                        <span class="hint">Akan tampil dengan aksen warna khusus</span>
                    </label>
                    <input type="text" name="hero_title_highlight" class="form-input" value="{{ $settings['hero_title_highlight'] ?? 'Setiap Momen' }}">
                </div>

                <div class="form-group col-12">
                    <label class="form-label">Deskripsi / Subtitle Hero</label>
                    <textarea name="hero_subtitle" class="form-textarea" rows="3">{{ $settings['hero_subtitle'] ?? 'Dessert homemade yang dibuat fresh dan sepenuh hati — dari bahan pilihan, hadir di setiap kesempatan spesialmu dengan rasa yang tak terlupakan.' }}</textarea>
                </div>

                <div class="form-group col-6">
                    <label class="form-label">Teks Tombol 1 (Katalog)</label>
                    <input type="text" name="hero_btn_catalog" class="form-input" value="{{ $settings['hero_btn_catalog'] ?? 'Lihat Katalog' }}">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">Teks Tombol 2 (Pesan WhatsApp)</label>
                    <input type="text" name="hero_btn_order" class="form-input" value="{{ $settings['hero_btn_order'] ?? 'Pesan Sekarang' }}">
                </div>
            </div>
        </div>

        <!-- Badges Mengambang di Foto Hero -->
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon"><i class="fa-solid fa-certificate"></i></div>
                <div>
                    <h2 class="settings-card-title">Badge Melayang pada Foto Hero</h2>
                    <p class="settings-card-desc">Label kecil interaktif di kiri dan kanan foto hero utama.</p>
                </div>
            </div>

            <div class="form-grid">
                <!-- Badge Kiri -->
                <div class="col-6">
                    <div class="sub-box">
                        <div class="sub-box-title"><i class="fa-solid fa-award"></i> Badge Kiri (Best Seller)</div>
                        <div class="form-group" style="margin-bottom: 12px;">
                            <label class="form-label">Ikon Emoji</label>
                            <input type="text" name="hero_badge_left_icon" class="form-input" value="{{ $settings['hero_badge_left_icon'] ?? '🍫' }}">
                        </div>
                        <div class="form-group" style="margin-bottom: 12px;">
                            <label class="form-label">Judul Badge</label>
                            <input type="text" name="hero_badge_left_title" class="form-input" value="{{ $settings['hero_badge_left_title'] ?? 'Best Seller' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Keterangan Sub</label>
                            <input type="text" name="hero_badge_left_sub" class="form-input" value="{{ $settings['hero_badge_left_sub'] ?? 'Fudgy Brownies' }}">
                        </div>
                    </div>
                </div>

                <!-- Badge Kanan -->
                <div class="col-6">
                    <div class="sub-box">
                        <div class="sub-box-title"><i class="fa-solid fa-star"></i> Badge Kanan (Rating)</div>
                        <div class="form-group" style="margin-bottom: 12px;">
                            <label class="form-label">Ikon Emoji</label>
                            <input type="text" name="hero_badge_right_icon" class="form-input" value="{{ $settings['hero_badge_right_icon'] ?? '⭐' }}">
                        </div>
                        <div class="form-group" style="margin-bottom: 12px;">
                            <label class="form-label">Judul Badge</label>
                            <input type="text" name="hero_badge_right_title" class="form-input" value="{{ $settings['hero_badge_right_title'] ?? '4.9 / 5.0' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Keterangan Sub</label>
                            <input type="text" name="hero_badge_right_sub" class="form-input" value="{{ $settings['hero_badge_right_sub'] ?? 'Rating Pelanggan' }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4 Statistik Hero -->
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon"><i class="fa-solid fa-chart-simple"></i></div>
                <div>
                    <h2 class="settings-card-title">4 Nilai Statistik Hero</h2>
                    <p class="settings-card-desc">Angka / ikon dan label kecil di bawah tombol CTA.</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="col-3">
                    <div class="sub-box">
                        <div class="sub-box-title">Statistik 1</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Angka / Simbol</label>
                            <input type="text" name="stat_1_num" class="form-input" value="{{ $settings['stat_1_num'] ?? '100%' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Label</label>
                            <input type="text" name="stat_1_label" class="form-input" value="{{ $settings['stat_1_label'] ?? 'Freshly Made' }}">
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="sub-box">
                        <div class="sub-box-title">Statistik 2</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Angka / Simbol</label>
                            <input type="text" name="stat_2_num" class="form-input" value="{{ $settings['stat_2_num'] ?? '5+' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Label</label>
                            <input type="text" name="stat_2_label" class="form-input" value="{{ $settings['stat_2_label'] ?? 'Menu Manis' }}">
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="sub-box">
                        <div class="sub-box-title">Statistik 3</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Angka / Simbol</label>
                            <input type="text" name="stat_3_num" class="form-input" value="{{ $settings['stat_3_num'] ?? '❤️' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Label</label>
                            <input type="text" name="stat_3_label" class="form-input" value="{{ $settings['stat_3_label'] ?? 'Dibuat Sepenuh Hati' }}">
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="sub-box">
                        <div class="sub-box-title">Statistik 4</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Angka / Simbol</label>
                            <input type="text" name="stat_4_num" class="form-input" value="{{ $settings['stat_4_num'] ?? '🎁' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Label</label>
                            <input type="text" name="stat_4_label" class="form-input" value="{{ $settings['stat_4_label'] ?? 'Made for Sharing' }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 2: FEATURES & KATALOG ==================== -->
    <div class="tab-pane" id="tab-features">
        <!-- 4 Strip Keunggulan -->
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon"><i class="fa-solid fa-sparkles"></i></div>
                <div>
                    <h2 class="settings-card-title">4 Baris Strip Keunggulan (Feature Strip)</h2>
                    <p class="settings-card-desc">Baris ikon dan keunggulan tepat di bawah Hero Section.</p>
                </div>
            </div>

            <div class="form-grid">
                <!-- Fitur 1 -->
                <div class="col-6">
                    <div class="sub-box">
                        <div class="sub-box-title">Keunggulan 1</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Ikon Emoji</label>
                            <input type="text" name="feature_1_icon" class="form-input" value="{{ $settings['feature_1_icon'] ?? '🌿' }}">
                        </div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Judul</label>
                            <input type="text" name="feature_1_title" class="form-input" value="{{ $settings['feature_1_title'] ?? '100% Freshly Made' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Keterangan Sub</label>
                            <input type="text" name="feature_1_sub" class="form-input" value="{{ $settings['feature_1_sub'] ?? 'Dibuat segar setiap hari' }}">
                        </div>
                    </div>
                </div>

                <!-- Fitur 2 -->
                <div class="col-6">
                    <div class="sub-box">
                        <div class="sub-box-title">Keunggulan 2</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Ikon Emoji</label>
                            <input type="text" name="feature_2_icon" class="form-input" value="{{ $settings['feature_2_icon'] ?? '🍪' }}">
                        </div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Judul</label>
                            <input type="text" name="feature_2_title" class="form-input" value="{{ $settings['feature_2_title'] ?? '5+ Menu Manis' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Keterangan Sub</label>
                            <input type="text" name="feature_2_sub" class="form-input" value="{{ $settings['feature_2_sub'] ?? 'Pilihan lengkap & beragam' }}">
                        </div>
                    </div>
                </div>

                <!-- Fitur 3 -->
                <div class="col-6">
                    <div class="sub-box">
                        <div class="sub-box-title">Keunggulan 3</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Ikon Emoji</label>
                            <input type="text" name="feature_3_icon" class="form-input" value="{{ $settings['feature_3_icon'] ?? '❤️' }}">
                        </div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Judul</label>
                            <input type="text" name="feature_3_title" class="form-input" value="{{ $settings['feature_3_title'] ?? 'Dibuat Sepenuh Hati' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Keterangan Sub</label>
                            <input type="text" name="feature_3_sub" class="form-input" value="{{ $settings['feature_3_sub'] ?? 'Bahan premium pilihan' }}">
                        </div>
                    </div>
                </div>

                <!-- Fitur 4 -->
                <div class="col-6">
                    <div class="sub-box">
                        <div class="sub-box-title">Keunggulan 4</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Ikon Emoji</label>
                            <input type="text" name="feature_4_icon" class="form-input" value="{{ $settings['feature_4_icon'] ?? '🎁' }}">
                        </div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Judul</label>
                            <input type="text" name="feature_4_title" class="form-input" value="{{ $settings['feature_4_title'] ?? 'Made for Sharing' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Keterangan Sub</label>
                            <input type="text" name="feature_4_sub" class="form-input" value="{{ $settings['feature_4_sub'] ?? 'Cocok untuk hadiah & momen spesial' }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Judul Katalog Menu -->
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon"><i class="fa-solid fa-cookie-bite"></i></div>
                <div>
                    <h2 class="settings-card-title">Header Bagian Katalog Menu</h2>
                    <p class="settings-card-desc">Teks pembuka di atas daftar produk kue Cookies Intan.</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group col-12">
                    <label class="form-label">Badge Katalog</label>
                    <input type="text" name="menu_section_badge" class="form-input" value="{{ $settings['menu_section_badge'] ?? '✨ Favorit Cookies Intan ✨' }}">
                </div>
                <div class="form-group col-6">
                    <label class="form-label">Judul Bagian Katalog</label>
                    <input type="text" name="menu_section_title" class="form-input" value="{{ $settings['menu_section_title'] ?? 'Menu Pilihan Kami' }}">
                </div>
                <div class="form-group col-12">
                    <label class="form-label">Deskripsi / Subtitle Katalog</label>
                    <textarea name="menu_section_subtitle" class="form-textarea" rows="2">{{ $settings['menu_section_subtitle'] ?? 'Setiap produk dibuat dengan bahan premium pilihan, menghadirkan cita rasa terbaik yang memanjakan lidah.' }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 3: ABOUT US ==================== -->
    <div class="tab-pane" id="tab-about">
        <!-- Foto Bagian Tentang Kami -->
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon"><i class="fa-solid fa-images"></i></div>
                <div>
                    <h2 class="settings-card-title">Foto Bagian Tentang Kami</h2>
                    <p class="settings-card-desc">Dua gambar yang tampil di sisi kiri pada bagian Tentang Kami.</p>
                </div>
            </div>

            <div class="form-grid">
                <!-- Foto Utama -->
                <div class="col-6">
                    <label class="form-label">
                        Foto Utama (Besar)
                        <span class="hint">Format JPG/PNG/WEBP, Maks 5MB</span>
                    </label>

                    <div class="img-upload-box">
                        <div class="img-preview-container">
                            <img id="preview_about_image_main" class="img-preview-thumb" src="{{ \App\Models\SiteSetting::getImageUrl('about_image_main', 'images/hero_cookies.jpg') }}" alt="Preview About Main">
                        </div>
                        <div class="file-input-wrapper">
                            <input type="file" name="about_image_main" class="form-input" accept="image/*" onchange="previewImage(this, 'preview_about_image_main')">
                            <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 6px;">
                                <i class="fa-solid fa-circle-info" style="color: var(--orange);"></i> Foto utama bagian Tentang Kami.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Foto Sekunder -->
                <div class="col-6">
                    <label class="form-label">
                        Foto Sekunder (Kecil / Melayang)
                        <span class="hint">Format JPG/PNG/WEBP, Maks 5MB</span>
                    </label>

                    <div class="img-upload-box">
                        <div class="img-preview-container">
                            <img id="preview_about_image_secondary" class="img-preview-thumb" src="{{ \App\Models\SiteSetting::getImageUrl('about_image_secondary', 'images/cookies.jpg') }}" alt="Preview About Secondary">
                        </div>
                        <div class="file-input-wrapper">
                            <input type="file" name="about_image_secondary" class="form-input" accept="image/*" onchange="previewImage(this, 'preview_about_image_secondary')">
                            <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 6px;">
                                <i class="fa-solid fa-circle-info" style="color: var(--orange);"></i> Foto proses / pembuatan cookies.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon"><i class="fa-solid fa-heart"></i></div>
                <div>
                    <h2 class="settings-card-title">Teks Cerita Tentang Kami (About Us)</h2>
                    <p class="settings-card-desc">Cerita, kutipan, dan filosofi pembuatan Cookies Intan.</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group col-6">
                    <label class="form-label">Badge Tentang Kami</label>
                    <input type="text" name="about_section_badge" class="form-input" value="{{ $settings['about_section_badge'] ?? '🍪 A Little About Us 🍪' }}">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">Judul Bagian</label>
                    <input type="text" name="about_section_title" class="form-input" value="{{ $settings['about_section_title'] ?? 'Tentang Cookies Intan' }}">
                </div>

                <div class="form-group col-12">
                    <label class="form-label">Kutipan / Quote Utama</label>
                    <input type="text" name="about_quote" class="form-input" value="{{ $settings['about_quote'] ?? '\"Cookies Intan lahir dari cinta dan kesenangan membuat dessert dengan bahan pilihan.\"' }}">
                </div>

                <div class="form-group col-12">
                    <label class="form-label">Paragraf Cerita 1</label>
                    <textarea name="about_desc_1" class="form-textarea" rows="3">{{ $settings['about_desc_1'] ?? 'Setiap cookies kami dibuat fresh dengan bahan-bahan berkualitas pilihan, hadir di setiap momen spesial — dari ulang tahun, hadiah, hingga camilan sehari-hari yang memanjakan. Semua sweet things made inside and made with love.' }}</textarea>
                </div>

                <div class="form-group col-12">
                    <label class="form-label">Paragraf Cerita 2</label>
                    <textarea name="about_desc_2" class="form-textarea" rows="3">{{ $settings['about_desc_2'] ?? 'Kami percaya bahwa makanan yang dibuat dengan hati akan selalu terasa berbeda. Setiap gigitan adalah bukti cinta kami kepada pelanggan setia Cookies Intan.' }}</textarea>
                </div>

                <div class="form-group col-12">
                    <label class="form-label">Tagline Penutup Tentang Kami</label>
                    <input type="text" name="about_tagline" class="form-input" value="{{ $settings['about_tagline'] ?? 'Small treats. Big feelings. ✨' }}">
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 4: CARA PESAN & FAQ ==================== -->
    <div class="tab-pane" id="tab-order-faq">
        <!-- Cara Pesan -->
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon"><i class="fa-solid fa-list-check"></i></div>
                <div>
                    <h2 class="settings-card-title">Bagian Cara Pemesanan</h2>
                    <p class="settings-card-desc">Langkah-langkah mudah order bagi pelanggan.</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group col-6">
                    <label class="form-label">Badge Cara Pesan</label>
                    <input type="text" name="order_section_badge" class="form-input" value="{{ $settings['order_section_badge'] ?? '✨ Simple & Easy ✨' }}">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">Judul Bagian</label>
                    <input type="text" name="order_section_title" class="form-input" value="{{ $settings['order_section_title'] ?? 'Cara Pesan Cookies Intan' }}">
                </div>

                <div class="form-group col-12">
                    <label class="form-label">Subjudul</label>
                    <input type="text" name="order_section_subtitle" class="form-input" value="{{ $settings['order_section_subtitle'] ?? 'Pesan homemade cookies & dessert favoritmu sangat mudah!' }}">
                </div>

                <!-- Step 1 -->
                <div class="col-4">
                    <div class="sub-box">
                        <div class="sub-box-title">Langkah 01</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Judul Langkah 1</label>
                            <input type="text" name="order_step_1_title" class="form-input" value="{{ $settings['order_step_1_title'] ?? 'Pilih Menu' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Deskripsi Langkah 1</label>
                            <textarea name="order_step_1_desc" class="form-textarea" rows="3">{{ $settings['order_step_1_desc'] ?? 'Browse menu favorit di katalog kami — Brownies, Cookies, Hampers, Birthday Cake, atau Pudding sesuai selera.' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="col-4">
                    <div class="sub-box">
                        <div class="sub-box-title">Langkah 02</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Judul Langkah 2</label>
                            <input type="text" name="order_step_2_title" class="form-input" value="{{ $settings['order_step_2_title'] ?? 'Chat Kami' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Deskripsi Langkah 2</label>
                            <textarea name="order_step_2_desc" class="form-textarea" rows="3">{{ $settings['order_step_2_desc'] ?? 'Hubungi kami lewat WhatsApp untuk konfirmasi pesanan, alamat, dan detail pengiriman. Kami siap membantu!' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="col-4">
                    <div class="sub-box">
                        <div class="sub-box-title">Langkah 03</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Judul Langkah 3</label>
                            <input type="text" name="order_step_3_title" class="form-input" value="{{ $settings['order_step_3_title'] ?? 'Nikmati Manisnya' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Deskripsi Langkah 3</label>
                            <textarea name="order_step_3_desc" class="form-textarea" rows="3">{{ $settings['order_step_3_desc'] ?? 'Pesanan dikirim fresh dan siap dinikmati. Bagi kebahagiaan manis bersama orang-orang terkasih!' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group col-12">
                    <label class="form-label">Teks Tombol Order WhatsApp</label>
                    <input type="text" name="order_btn_text" class="form-input" value="{{ $settings['order_btn_text'] ?? 'Pesan via WhatsApp Sekarang' }}">
                </div>
            </div>
        </div>

        <!-- FAQ (Pertanyaan yang Sering Diajukan) -->
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon"><i class="fa-solid fa-circle-question"></i></div>
                <div>
                    <h2 class="settings-card-title">Bagian Tanya Jawab (FAQ)</h2>
                    <p class="settings-card-desc">Pertanyaan umum dan jawaban seputar pemesanan, daya tahan, dan pengiriman.</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group col-6">
                    <label class="form-label">Badge FAQ</label>
                    <input type="text" name="faq_section_badge" class="form-input" value="{{ $settings['faq_section_badge'] ?? '❓ FAQ ❓' }}">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">Judul Bagian FAQ</label>
                    <input type="text" name="faq_section_title" class="form-input" value="{{ $settings['faq_section_title'] ?? 'Pertanyaan yang Sering Ditanya' }}">
                </div>

                <!-- FAQ 1 -->
                <div class="col-12">
                    <div class="sub-box">
                        <div class="sub-box-title">Pertanyaan #1</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Pertanyaan</label>
                            <input type="text" name="faq_1_q" class="form-input" value="{{ $settings['faq_1_q'] ?? 'Berapa lama waktu pembuatan pesanan?' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jawaban</label>
                            <textarea name="faq_1_a" class="form-textarea" rows="2">{{ $settings['faq_1_a'] ?? 'Waktu pembuatan biasanya 1-2 hari kerja setelah konfirmasi pesanan dan pembayaran. Untuk pesanan hampers atau birthday cake besar, kami sarankan pesan 3-4 hari sebelumnya.' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="col-12">
                    <div class="sub-box">
                        <div class="sub-box-title">Pertanyaan #2</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Pertanyaan</label>
                            <input type="text" name="faq_2_q" class="form-input" value="{{ $settings['faq_2_q'] ?? 'Apakah bisa pesan dengan custom rasa atau packaging?' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jawaban</label>
                            <textarea name="faq_2_a" class="form-textarea" rows="2">{{ $settings['faq_2_a'] ?? 'Ya! Kami menerima custom pesanan untuk rasa, ukuran, dan packaging. Hubungi kami via WhatsApp untuk diskusi lebih lanjut.' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="col-12">
                    <div class="sub-box">
                        <div class="sub-box-title">Pertanyaan #3</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Pertanyaan</label>
                            <input type="text" name="faq_3_q" class="form-input" value="{{ $settings['faq_3_q'] ?? 'Berapa lama ketahanan produk?' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jawaban</label>
                            <textarea name="faq_3_a" class="form-textarea" rows="2">{{ $settings['faq_3_a'] ?? 'Brownies & Cookies: 5-7 hari suhu ruang, 2 minggu di kulkas. Pudding & Cake: 3-4 hari di kulkas. Semua produk tanpa bahan pengawet, fresh dan sehat!' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="col-12">
                    <div class="sub-box">
                        <div class="sub-box-title">Pertanyaan #4</div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="form-label">Pertanyaan</label>
                            <input type="text" name="faq_4_q" class="form-input" value="{{ $settings['faq_4_q'] ?? 'Apakah bisa dikirim ke luar kota?' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jawaban</label>
                            <textarea name="faq_4_a" class="form-textarea" rows="2">{{ $settings['faq_4_a'] ?? 'Untuk saat ini pengiriman dilayani melalui jasa ekspedisi untuk produk Brownies & Cookies (dikemas khusus agar tetap aman). Hubungi kami untuk info biaya ongkir ke daerah Anda.' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 5: CONTACT & FOOTER ==================== -->
    <div class="tab-pane" id="tab-contact">
        <!-- Banner Final CTA (Paling Bawah Halaman) -->
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon"><i class="fa-solid fa-comments"></i></div>
                <div>
                    <h2 class="settings-card-title">Banner Ajakan Final (Final CTA)</h2>
                    <p class="settings-card-desc">Bagian banner besar berlatar cokelat gelap sebelum footer.</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group col-12">
                    <label class="form-label">Eyebrow Tag Banner</label>
                    <input type="text" name="final_cta_eyebrow" class="form-input" value="{{ $settings['final_cta_eyebrow'] ?? '🍪 READY FOR A SWEET MOMENT? 🍪' }}">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">Judul Banner</label>
                    <input type="text" name="final_cta_title" class="form-input" value="{{ $settings['final_cta_title'] ?? 'Siap untuk Momen Manis?' }}">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">Teks Tombol WA Banner</label>
                    <input type="text" name="final_cta_btn_text" class="form-input" value="{{ $settings['final_cta_btn_text'] ?? 'Pesan via WhatsApp' }}">
                </div>

                <div class="form-group col-12">
                    <label class="form-label">Deskripsi Banner</label>
                    <textarea name="final_cta_subtitle" class="form-textarea" rows="2">{{ $settings['final_cta_subtitle'] ?? 'Pesan sekarang via WhatsApp dan rasakan sendiri kelezatan homemade cookies & dessert Cookies Intan yang dibuat penuh cinta!' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Nomor Kontak & Sosial Media -->
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon"><i class="fa-brands fa-whatsapp"></i></div>
                <div>
                    <h2 class="settings-card-title">Kontak, WhatsApp & Sosial Media</h2>
                    <p class="settings-card-desc">Nomor WhatsApp dan link media sosial yang digunakan di seluruh tombol pesan dan footer.</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group col-6">
                    <label class="form-label">
                        Nomor WhatsApp (Format Internasional)
                        <span class="hint">Awali 62 (contoh: 6282315230979)</span>
                    </label>
                    <input type="text" name="contact_whatsapp_number" class="form-input" value="{{ $settings['contact_whatsapp_number'] ?? '6282315230979' }}" placeholder="6282315230979">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">
                        Tampilan Nomor WhatsApp
                        <span class="hint">Contoh: 0823 1523 0979</span>
                    </label>
                    <input type="text" name="contact_whatsapp_display" class="form-input" value="{{ $settings['contact_whatsapp_display'] ?? '0823 1523 0979' }}" placeholder="0823 1523 0979">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">Jam Operasional</label>
                    <input type="text" name="contact_hours" class="form-input" value="{{ $settings['contact_hours'] ?? 'Senin - Minggu, 08.00 - 21.00' }}">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">Tagline Lokasi / Alamat</label>
                    <input type="text" name="contact_address_tagline" class="form-input" value="{{ $settings['contact_address_tagline'] ?? 'Freshly baked with love ❤️' }}">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">Username Instagram</label>
                    <input type="text" name="contact_instagram" class="form-input" value="{{ $settings['contact_instagram'] ?? '@cookiesIntan' }}">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">Link URL Instagram</label>
                    <input type="text" name="contact_instagram_url" class="form-input" value="{{ $settings['contact_instagram_url'] ?? 'https://instagram.com/cookiesIntan' }}">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">Link URL TikTok</label>
                    <input type="text" name="contact_tiktok_url" class="form-input" value="{{ $settings['contact_tiktok_url'] ?? '#' }}">
                </div>

                <div class="form-group col-6">
                    <label class="form-label">Link URL Facebook</label>
                    <input type="text" name="contact_facebook_url" class="form-input" value="{{ $settings['contact_facebook_url'] ?? '#' }}">
                </div>

                <div class="form-group col-12">
                    <label class="form-label">Deskripsi Singkat di Footer</label>
                    <textarea name="footer_description" class="form-textarea" rows="2">{{ $settings['footer_description'] ?? 'Cookies Intan lahir dari cinta dan kesenangan membuat dessert dengan bahan pilihan. Setiap cookies dibuat fresh untuk kebahagiaan setiap momen.' }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Bottom Actions Bar -->
    <div class="sticky-bar">
        <div style="display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-circle-info" style="color: var(--orange);"></i>
            <span style="font-size: 0.85rem; color: var(--text-muted);">
                Perubahan teks akan langsung diterapkan di seluruh halaman depan saat Anda menyimpan.
            </span>
        </div>

        <div style="display: flex; align-items: center; gap: 12px;">
            <button type="submit" class="btn-save">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Semua Perubahan
            </button>
        </div>
    </div>
</form>

<!-- Reset Default Option -->
<div style="margin-top: 24px; text-align: right;">
    <form action="{{ route('admin.settings.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset seluruh teks halaman depan ke pengaturan teks bawaan (default)?');" style="display: inline-block;">
        @csrf
        <button type="submit" class="btn-reset">
            <i class="fa-solid fa-rotate-left"></i> Reset ke Teks Default Awal
        </button>
    </form>
</div>

@endsection

@section('scripts')
<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById(previewId);
                if (img) {
                    img.src = e.target.result;
                    img.style.transform = 'scale(1.03)';
                    setTimeout(() => img.style.transform = 'scale(1)', 200);
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function switchTab(tabId) {
        // Update tab buttons
        document.querySelectorAll('.tab-item').forEach(btn => {
            btn.classList.remove('active');
        });
        event.currentTarget.classList.add('active');

        // Update tab content
        document.querySelectorAll('.tab-pane').forEach(pane => {
            pane.classList.remove('active');
        });
        const target = document.getElementById(tabId);
        if (target) {
            target.classList.add('active');
        }

        // Store active tab in sessionStorage
        sessionStorage.setItem('active_settings_tab', tabId);
    }

    // Restore last active tab on page load
    document.addEventListener('DOMContentLoaded', () => {
        const lastTab = sessionStorage.getItem('active_settings_tab');
        if (lastTab) {
            const btn = Array.from(document.querySelectorAll('.tab-item')).find(b => b.getAttribute('onclick')?.includes(lastTab));
            if (btn) {
                btn.click();
            }
        }
    });
</script>
@endsection
