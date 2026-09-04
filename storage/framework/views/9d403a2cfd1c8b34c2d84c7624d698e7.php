<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?> - Cookies Intan</title>

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
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>

    <!-- Admin Top Navbar -->
    <header class="admin-nav">
        <div class="admin-nav-inner">
            <a href="<?php echo e(route('admin.catalog.index')); ?>" class="admin-brand">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo Cookies Intan">
                <div class="admin-brand-text">
                    <span class="admin-brand-title">Cookies Intan</span>
                    <span class="admin-brand-badge">Admin Panel</span>
                </div>
            </a>

            <nav class="admin-menu">
                <a href="<?php echo e(route('admin.catalog.index')); ?>" class="nav-link-btn <?php echo e(request()->routeIs('admin.catalog.*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-cookie-bite"></i> Kelola Katalog & Foto
                </a>
                <a href="<?php echo e(route('home')); ?>" target="_blank" class="nav-link-btn" title="Buka website publik di tab baru">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Website
                </a>
            </nav>

            <div class="admin-user-info">
                <div class="user-pill">
                    <i class="fa-solid fa-user-shield" style="color: var(--orange);"></i>
                    <span><?php echo e(Auth::user()->name ?? 'Admin'); ?></span>
                </div>

                <form action="<?php echo e(route('admin.logout')); ?>" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin logout?');">
                    <?php echo csrf_field(); ?>
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
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i>
                <div><?php echo e(session('success')); ?></div>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation" style="font-size: 1.2rem;"></i>
                <div><?php echo e(session('error')); ?></div>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation" style="font-size: 1.2rem;"></i>
                <div>
                    <strong>Perhatian:</strong>
                    <ul style="margin-left: 20px; margin-top: 4px;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($err); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\LENOVO\.gemini\antigravity-ide\scratch\barbershop\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>