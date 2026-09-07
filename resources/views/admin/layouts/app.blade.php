<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Cookies Intan</title>

    <!-- Favicon / App Icon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --cream: #FFF8F0;
            --cream-dark: #F5EDE0;
            --cream-card: #FFFFFF;
            --brown-light: #C8956C;
            --brown: #8B5E3C;
            --brown-dark: #5C3D1E;
            --brown-darker: #3D2409;
            --chocolate: #2C1A0E;
            --gold: #D4A847;
            --gold-light: #F0C96B;
            --orange: #E8892A;
            --text-dark: #2C1A0E;
            --text-muted: #846750;
            --success: #10B981;
            --danger: #EF4444;
            --warning: #F59E0B;
            --shadow-sm: 0 2px 8px rgba(140, 94, 60, 0.08);
            --shadow-md: 0 6px 20px rgba(140, 94, 60, 0.12);
            --shadow-lg: 0 15px 35px rgba(140, 94, 60, 0.18);
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --radius-full: 9999px;
            --transition: all 0.25s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--cream);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== Top Navigation Bar ===== */
        .admin-nav {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(200, 149, 108, 0.2);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow-sm);
        }

        .admin-nav-inner {
            max-width: 1300px;
            margin: 0 auto;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: inherit;
        }

        .admin-brand img {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(140, 94, 60, 0.2);
        }

        .admin-brand-text {
            line-height: 1.2;
        }

        .admin-brand-title {
            font-family: 'Dancing Script', cursive;
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--brown-dark);
            display: block;
        }

        .admin-brand-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--orange), var(--brown));
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.8px;
            padding: 2px 8px;
            border-radius: var(--radius-full);
            text-transform: uppercase;
        }

        .admin-menu {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-link-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: var(--radius-full);
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--brown-dark);
            text-decoration: none;
            transition: var(--transition);
        }

        .nav-link-btn:hover {
            background: var(--cream-dark);
            color: var(--brown);
        }

        .nav-link-btn.active {
            background: var(--brown-dark);
            color: #fff;
        }

        .admin-user-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .user-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--cream-dark);
            padding: 6px 14px;
            border-radius: var(--radius-full);
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--brown-dark);
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 16px;
            background: #FFF1F0;
            color: #CF1322;
            border: 1px solid #FFA39E;
            border-radius: var(--radius-full);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-family: inherit;
        }

        .btn-logout:hover {
            background: #CF1322;
            color: #fff;
            border-color: #CF1322;
        }

        /* ===== Main Container ===== */
        .admin-main {
            max-width: 1300px;
            margin: 0 auto;
            padding: 32px 24px 60px;
            width: 100%;
            flex: 1;
        }

        /* ===== Flash Alerts ===== */
        .alert {
            padding: 14px 20px;
            border-radius: var(--radius-md);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.92rem;
            box-shadow: var(--shadow-sm);
            animation: slideDown 0.3s ease;
        }

        .alert-success {
            background-color: #ECFDF5;
            color: #065F46;
            border: 1px solid #A7F3D0;
        }

        .alert-danger {
            background-color: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FECACA;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-nav-inner {
                flex-wrap: wrap;
                gap: 12px;
            }
            .admin-menu {
                width: 100%;
                justify-content: space-between;
                order: 3;
            }
            .admin-main {
                padding: 20px 16px 40px;
            }
        }

        /* Database Badges & Sync Button */
        .db-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: var(--radius-full);
            font-size: 0.76rem;
            font-weight: 600;
            text-decoration: none;
            cursor: default;
            border: 1px solid transparent;
            font-family: inherit;
        }

        .db-badge-success {
            background: #ECFDF5;
            color: #065F46;
            border-color: #A7F3D0;
        }

        .db-badge-warning {
            background: #FFFBEB;
            color: #B45309;
            border-color: #FDE68A;
            cursor: pointer;
            transition: var(--transition);
        }
        .db-badge-warning:hover {
            background: #FEF3C7;
            transform: translateY(-1px);
        }

        .db-badge-info {
            background: var(--cream-dark);
            color: var(--brown-dark);
            border-color: rgba(200, 149, 108, 0.3);
        }

        .btn-sync-sqlite {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: #FFF8F0;
            color: var(--brown-dark);
            border: 1px solid rgba(200, 149, 108, 0.4);
            border-radius: var(--radius-full);
            font-size: 0.78rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-family: inherit;
        }
        .btn-sync-sqlite:hover {
            background: var(--orange);
            color: #fff;
            border-color: var(--orange);
        }

        /* Cloud DB Guide Modal */
        .db-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(44, 26, 14, 0.6);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .db-modal-overlay.active {
            display: flex;
        }
        .db-modal-content {
            background: #FFFDFB;
            max-width: 650px;
            width: 100%;
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(200, 149, 108, 0.3);
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: slideDown 0.3s ease;
        }
        .db-modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            font-size: 1.3rem;
            color: var(--text-muted);
            cursor: pointer;
        }
        .db-modal-close:hover {
            color: var(--danger);
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Admin Top Navbar -->
    <header class="admin-nav">
        <div class="admin-nav-inner">
            <a href="{{ route('admin.catalog.index') }}" class="admin-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Cookies Intan">
                <div class="admin-brand-text">
                    <span class="admin-brand-title">Cookies Intan</span>
                    <span class="admin-brand-badge">Admin Panel</span>
                </div>
            </a>

            <nav class="admin-menu">
                <a href="{{ route('admin.catalog.index') }}" class="nav-link-btn {{ request()->routeIs('admin.catalog.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-cookie-bite"></i> Kelola Katalog & Foto
                </a>
                <a href="{{ route('admin.settings.index') }}" class="nav-link-btn {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-pen-to-square"></i> Kelola Teks Depan
                </a>
                <a href="{{ route('home') }}" target="_blank" class="nav-link-btn" title="Buka website publik di tab baru">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Website
                </a>
            </nav>

            <div class="admin-user-info">
                @if(isset($dbStatus))
                    @if($dbStatus['type'] === 'success')
                        <span class="db-badge db-badge-success" title="{{ $dbStatus['detail'] }}">
                            <i class="fa-solid fa-circle-check"></i> {{ $dbStatus['badge'] }}
                        </span>
                    @elseif($dbStatus['type'] === 'warning')
                        <button type="button" class="db-badge db-badge-warning" onclick="openDbModal()" title="{{ $dbStatus['detail'] }}">
                            <i class="fa-solid fa-triangle-exclamation"></i> {{ $dbStatus['badge'] }}
                        </button>
                    @else
                        <span class="db-badge db-badge-info" title="{{ $dbStatus['detail'] }}">
                            <i class="fa-solid fa-server"></i> {{ $dbStatus['badge'] }}
                        </span>
                    @endif

                    @if($dbStatus['type'] !== 'success')
                        <form action="{{ route('admin.settings.sync.sqlite') }}" method="POST" style="display: inline;" onsubmit="return confirm('Sinkronkan seluruh menu dan pengaturan saat ini ke file database/database.sqlite untuk persiapan push ke Vercel?');">
                            @csrf
                            <button type="submit" class="btn-sync-sqlite" title="Salin seluruh data ke database/database.sqlite agar ter-update saat Git Push ke Vercel">
                                <i class="fa-solid fa-arrows-rotate"></i> Sync ke SQLite
                            </button>
                        </form>
                    @endif
                @endif

                <div class="user-pill">
                    <i class="fa-solid fa-user-shield" style="color: var(--orange);"></i>
                    <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin logout?');">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Admin Content -->
    <main class="admin-main">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation" style="font-size: 1.2rem;"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation" style="font-size: 1.2rem;"></i>
                <div>
                    <strong>Perhatian:</strong>
                    <ul style="margin-left: 20px; margin-top: 4px;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Modal Panduan Database Permanen Vercel -->
    <div id="dbGuideModal" class="db-modal-overlay" onclick="if(event.target === this) closeDbModal();">
        <div class="db-modal-content">
            <button type="button" class="db-modal-close" onclick="closeDbModal()">&times;</button>
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                <div style="width: 44px; height: 44px; border-radius: 12px; background: #FFF3DC; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: var(--orange);">
                    <i class="fa-solid fa-cloud-bolt"></i>
                </div>
                <div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--brown-darker); margin: 0;">Cara Membuat Data Vercel Permanen</h3>
                    <span style="font-size: 0.82rem; color: var(--text-muted);">Hanya butuh 2 menit (100% Gratis Tanpa Kartu Kredit)</span>
                </div>
            </div>

            <div style="background: #FFF8F0; border: 1px solid rgba(200, 149, 108, 0.3); border-radius: var(--radius-md); padding: 14px 18px; margin-bottom: 20px; font-size: 0.88rem; line-height: 1.5; color: var(--brown-dark);">
                <strong>💡 Mengapa di Vercel data bisa reset?</strong><br>
                Vercel menggunakan serverless tanpa harddisk tetap. File database sementara di <code>/tmp</code> otomatis terhapus saat server tidur. Agar data menu baru & editan teks <strong>tidak pernah kembali ke awal</strong>, sambungkan database cloud gratis.
            </div>

            <h4 style="font-size: 0.98rem; font-weight: 700; color: var(--brown-dark); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                <span style="background: var(--brown); color: white; border-radius: 50%; width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem;">1</span>
                Opsi Terbaik: Gunakan Neon.tech (PostgreSQL Gratis)
            </h4>
            <ol style="margin-left: 24px; font-size: 0.88rem; color: #4B3B2B; line-height: 1.7; margin-bottom: 20px;">
                <li>Buka dan daftar di <a href="https://neon.tech" target="_blank" style="color: var(--orange); font-weight: 600; text-decoration: underline;">Neon.tech</a> (Gratis, login dengan Google/GitHub).</li>
                <li>Buat project baru (Pilih region terdekat: <strong>Singapore</strong>).</li>
                <li>Salin <strong>Connection String</strong> yang muncul (contoh: <code>postgresql://user:pass@ep-xyz.neon.tech/neondb?sslmode=require</code>).</li>
                <li>Buka dashboard di <strong>Vercel.com</strong> &rarr; Pilih project <strong>Cookies Intan</strong> &rarr; Tab <strong>Settings</strong> &rarr; <strong>Environment Variables</strong>.</li>
                <li>Tambahkan variable baru:
                    <div style="background: #2C1A0E; color: #F0C96B; padding: 8px 12px; border-radius: 6px; font-family: monospace; font-size: 0.82rem; margin: 6px 0;">
                        Key: DATABASE_URL<br>
                        Value: [paste connection string Neon Anda]
                    </div>
                </li>
                <li>Buka tab <strong>Deployments</strong> di Vercel &rarr; klik menu (•••) pada commit paling atas &rarr; pilih <strong>Redeploy</strong>.</li>
                <li><strong>Selesai!</strong> Sistem akan otomatis membuat tabel & data awal. Setelah itu, produk yang Anda tambah/edit langsung di web Vercel akan tersimpan <strong>permanen selamanya</strong>!</li>
            </ol>

            <h4 style="font-size: 0.98rem; font-weight: 700; color: var(--brown-dark); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                <span style="background: var(--brown); color: white; border-radius: 50%; width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem;">2</span>
                Jika Mengedit di Komputer Lokal (Laragon)
            </h4>
            <p style="font-size: 0.88rem; color: #4B3B2B; line-height: 1.6; margin-left: 24px; margin-bottom: 20px;">
                Jika Anda menambah produk di Laragon (localhost), klik tombol <strong>"Sync ke SQLite"</strong> di pojok kanan atas navbar admin ini. File <code>database/database.sqlite</code> akan ter-update otomatis. Lalu cukup lakukan <code>git add . && git commit -m "update produk" && git push</code> agar Vercel ikut ter-update!
            </p>

            <div style="text-align: right; border-top: 1px solid rgba(200, 149, 108, 0.2); padding-top: 16px;">
                <button type="button" onclick="closeDbModal()" style="padding: 9px 24px; background: var(--brown-dark); color: white; border: none; border-radius: var(--radius-full); font-weight: 600; cursor: pointer;">
                    Mengerti, Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        function openDbModal() {
            var modal = document.getElementById('dbGuideModal');
            if (modal) modal.classList.add('active');
        }
        function closeDbModal() {
            var modal = document.getElementById('dbGuideModal');
            if (modal) modal.classList.remove('active');
        }
    </script>

    @yield('scripts')
</body>
</html>
