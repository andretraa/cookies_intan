<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Cookies Intan - Homemade Bakery dengan Cinta'); ?></title>
    <meta name="description" content="Cookies Intan - Toko kue homemade premium. Brownies, Cookies, Hampers, Birthday Cake & Pudding. Dibuat fresh dari bahan pilihan dengan penuh cinta. Pesan via WhatsApp!">

    <!-- Favicon / App Icon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo.png')); ?>">
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('images/logo.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/logo.png')); ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&family=Fredoka:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Cookies Intan Styles -->
    <link rel="stylesheet" href="<?php echo e(asset('css/cookies.css')); ?>">

    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="navbar-inner">
            <a href="<?php echo e(route('home')); ?>" class="navbar-brand">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Cookies Intan Logo" style="height: 50px; width: 50px; border-radius: 50%; object-fit: cover; box-shadow: 0 2px 8px rgba(140, 94, 60, 0.18);">
                <div class="brand-text">
                    <span class="brand-name">Cookies Intan</span>
                    <span class="brand-tagline">Homemade &amp; Premium</span>
                </div>
            </a>

            <ul class="nav-links" id="navLinks">
                <li><a href="<?php echo e(route('home')); ?>#menu">Katalog</a></li>

                <li><a href="<?php echo e(route('home')); ?>#about">Tentang Kami</a></li>
                <li><a href="<?php echo e(route('home')); ?>#cara-pesan">Cara Pesan</a></li>

                <li><a href="<?php echo e(route('home')); ?>#testimoni">Testimoni</a></li>
                <li><a href="<?php echo e(route('home')); ?>#faq">FAQ</a></li>
                <li><a href="<?php echo e(route('home')); ?>#kontak">Kontak</a></li>
            </ul>

            <div class="nav-actions">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->isAdmin()): ?>
                        <a href="<?php echo e(route('admin.catalog.index')); ?>" class="btn-nav-admin">
                            <i class="fa-solid fa-gauge"></i> Panel Admin
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo e(route('admin.login')); ?>" class="btn-nav-login">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Login Admin
                    </a>
                <?php endif; ?>
            </div>

            <a href="https://wa.me/<?php echo e(\App\Models\SiteSetting::get('contact_whatsapp_number', '6287789235490')); ?>" target="_blank" class="btn btn-primary btn-sm" style="display:none;" id="navWaBtn">
                <i class="fa-brands fa-whatsapp"></i> Pesan Sekarang
            </a>

            <button class="hamburger" id="hamburger" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-inner">
            <!-- Brand -->
            <div class="footer-brand">
                <div class="navbar-brand" style="margin-bottom:14px;">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Cookies Intan Logo" style="height: 56px; width: 56px; border-radius: 50%; object-fit: cover; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                    <div class="brand-text">
                        <span class="brand-name" style="color: var(--white);">Cookies Intan</span>
                        <span class="brand-tagline" style="color: rgba(255,255,255,0.7);">Homemade Bakery</span>
                    </div>
                </div>
                <p class="footer-desc">
                    <?php echo e(\App\Models\SiteSetting::get('footer_description', 'Cookies Intan lahir dari cinta dan kesenangan membuat dessert dengan bahan pilihan. Setiap cookies dibuat fresh untuk kebahagiaan setiap momen.')); ?>

                </p>
                <div class="footer-socials">
                    <a href="<?php echo e(\App\Models\SiteSetting::get('contact_instagram_url', 'https://instagram.com/cookiesIntan')); ?>" target="_blank" class="social-btn" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="<?php echo e(\App\Models\SiteSetting::get('contact_tiktok_url', '#')); ?>" target="_blank" class="social-btn" title="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="https://wa.me/<?php echo e(\App\Models\SiteSetting::get('contact_whatsapp_number', '6287789235490')); ?>" target="_blank" class="social-btn" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="<?php echo e(\App\Models\SiteSetting::get('contact_facebook_url', '#')); ?>" target="_blank" class="social-btn" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
            </div>

            <!-- Navigasi -->
            <div>
                <h4 class="footer-title">Navigasi</h4>
                <ul class="footer-links">
                    <li><a href="#menu"><i class="fa-solid fa-chevron-right"></i> Katalog</a></li>
                    <li><a href="#about"><i class="fa-solid fa-chevron-right"></i> Tentang Kami</a></li>
                    <li><a href="#cara-pesan"><i class="fa-solid fa-chevron-right"></i> Cara Pesan</a></li>
                    <li><a href="#kontak"><i class="fa-solid fa-chevron-right"></i> Kontak</a></li>
                </ul>
            </div>

            <!-- Kategori -->
            <div>
                <h4 class="footer-title">Kategori</h4>
                <ul class="footer-links">
                    <li><a href="#menu"><i class="fa-solid fa-chevron-right"></i> Brownies</a></li>
                    <li><a href="#menu"><i class="fa-solid fa-chevron-right"></i> Cookies</a></li>
                    <li><a href="#menu"><i class="fa-solid fa-chevron-right"></i> Hampers</a></li>
                    <li><a href="#menu"><i class="fa-solid fa-chevron-right"></i> Birthday Cake</a></li>
                    <li><a href="#menu"><i class="fa-solid fa-chevron-right"></i> Pudding</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h4 class="footer-title">Hubungi Kami</h4>
                <div class="footer-contact-item">
                    <i class="fa-brands fa-whatsapp"></i>
                    <div>
                        <div style="color: rgba(255,255,255,0.85); font-weight: 600;"><?php echo e(\App\Models\SiteSetting::get('contact_whatsapp_display', '0877 8923 5490')); ?></div>
                        <div style="font-size:0.78rem;"><?php echo e(\App\Models\SiteSetting::get('contact_hours', 'Senin - Minggu, 08.00 - 21.00')); ?></div>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-brands fa-instagram"></i>
                    <span><?php echo e(\App\Models\SiteSetting::get('contact_instagram', '@cookiesIntan')); ?></span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <span><?php echo e(\App\Models\SiteSetting::get('contact_address_tagline', 'Freshly baked with love ❤️')); ?></span>
                </div>
                <a href="https://wa.me/<?php echo e(\App\Models\SiteSetting::get('contact_whatsapp_number', '6287789235490')); ?>" target="_blank" class="btn btn-primary btn-sm" style="margin-top: 16px;">
                    <i class="fa-brands fa-whatsapp"></i> Pesan Sekarang
                </a>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-copy">© <?php echo e(date('Y')); ?> <span>Cookies Intan</span>. All Rights Reserved. Freshly made with <span>♥</span> love.</p>
            <div style="display: flex; align-items: center; gap: 16px;">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->isAdmin()): ?>
                        <a href="<?php echo e(route('admin.catalog.index')); ?>" style="color: var(--gold-light); font-size: 0.82rem; display: inline-flex; align-items: center; gap: 6px; font-weight: 600;">
                            <i class="fa-solid fa-gauge"></i> Panel Admin
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo e(route('admin.login')); ?>" style="color: rgba(255,255,255,0.4); font-size: 0.82rem; display: inline-flex; align-items: center; gap: 6px; transition: color 0.2s;" onmouseover="this.style.color='#F0C96B'" onmouseout="this.style.color='rgba(255,255,255,0.4)'">
                        <i class="fa-solid fa-lock"></i> Admin Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/<?php echo e(\App\Models\SiteSetting::get('contact_whatsapp_number', '6287789235490')); ?>" target="_blank" id="waFloat"
       style="position:fixed; bottom:28px; right:28px; z-index:9999; width:58px; height:58px;
              background: linear-gradient(135deg, #25D366, #128C7E);
              border-radius:50%; display:flex; align-items:center; justify-content:center;
              box-shadow: 0 6px 24px rgba(37,211,102,0.5); transition: all 0.3s ease;
              animation: waPulse 2s ease-in-out infinite;"
       title="Chat WhatsApp">
        <i class="fa-brands fa-whatsapp" style="font-size:1.8rem; color:#fff;"></i>
    </a>

    <style>
        @keyframes waPulse {
            0%, 100% { box-shadow: 0 6px 24px rgba(37,211,102,0.5); }
            50% { box-shadow: 0 6px 36px rgba(37,211,102,0.8), 0 0 0 8px rgba(37,211,102,0.12); }
        }
        #waFloat:hover { transform: scale(1.1) translateY(-3px); }
    </style>

    <!-- Base Scripts -->
    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Hamburger menu
        const hamburger = document.getElementById('hamburger');
        const navLinks = document.getElementById('navLinks');
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('open');
            const spans = hamburger.querySelectorAll('span');
            spans[0].style.transform = navLinks.classList.contains('open') ? 'rotate(45deg) translate(5px, 5px)' : '';
            spans[1].style.opacity = navLinks.classList.contains('open') ? '0' : '1';
            spans[2].style.transform = navLinks.classList.contains('open') ? 'rotate(-45deg) translate(5px, -5px)' : '';
        });

        // Scroll reveal
        const reveals = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        reveals.forEach(el => observer.observe(el));
    </script>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\LENOVO\.gemini\antigravity-ide\scratch\barbershop\resources\views/layouts/app.blade.php ENDPATH**/ ?>