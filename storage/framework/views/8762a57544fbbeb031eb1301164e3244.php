

<?php $__env->startSection('title', 'Cookies Intan - Manis untuk Setiap Momen | Homemade Bakery'); ?>

<?php $__env->startSection('content'); ?>

<!-- ===== HERO SECTION ===== -->
<section class="hero" id="home">
    <!-- Floating decorations -->
    <div class="hero-floats">
        <span class="float-item">🍪</span>
        <span class="float-item">🍫</span>
        <span class="float-item">🎂</span>
        <span class="float-item">🍮</span>
        <span class="float-item">✨</span>
    </div>

    <div class="hero-inner">
        <!-- Content -->
        <div class="hero-content">
            <div class="hero-eyebrow">
                <?php echo \App\Models\SiteSetting::get('hero_eyebrow', '<span>🍪</span> Homemade dengan Cinta'); ?>

            </div>

            <h1 class="hero-title">
                <?php echo e(\App\Models\SiteSetting::get('hero_title_1', 'Manis untuk')); ?><br>
                <span class="highlight"><?php echo e(\App\Models\SiteSetting::get('hero_title_highlight', 'Setiap Momen')); ?></span>
            </h1>

            <p class="hero-subtitle">
                <?php echo e(\App\Models\SiteSetting::get('hero_subtitle', 'Dessert homemade yang dibuat fresh dan sepenuh hati — dari bahan pilihan, hadir di setiap kesempatan spesialmu dengan rasa yang tak terlupakan.')); ?>

            </p>

            <div class="hero-cta">
                <a href="#menu" class="btn btn-primary">
                    <i class="fa-solid fa-book-open"></i> <?php echo e(\App\Models\SiteSetting::get('hero_btn_catalog', 'Lihat Katalog')); ?>

                </a>
                <a href="https://wa.me/<?php echo e(\App\Models\SiteSetting::get('contact_whatsapp_number', '6287789235490')); ?>" target="_blank" class="btn btn-outline">
                    <i class="fa-brands fa-whatsapp"></i> <?php echo e(\App\Models\SiteSetting::get('hero_btn_order', 'Pesan Sekarang')); ?>

                </a>
            </div>

            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number"><?php echo e(\App\Models\SiteSetting::get('stat_1_num', '100%')); ?></div>
                    <div class="stat-label"><?php echo e(\App\Models\SiteSetting::get('stat_1_label', 'Freshly Made')); ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo e(\App\Models\SiteSetting::get('stat_2_num', '5+')); ?></div>
                    <div class="stat-label"><?php echo e(\App\Models\SiteSetting::get('stat_2_label', 'Menu Manis')); ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo e(\App\Models\SiteSetting::get('stat_3_num', '❤️')); ?></div>
                    <div class="stat-label"><?php echo e(\App\Models\SiteSetting::get('stat_3_label', 'Dibuat Sepenuh Hati')); ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo e(\App\Models\SiteSetting::get('stat_4_num', '🎁')); ?></div>
                    <div class="stat-label"><?php echo e(\App\Models\SiteSetting::get('stat_4_label', 'Made for Sharing')); ?></div>
                </div>
            </div>
        </div>

        <!-- Image -->
        <div class="hero-image">
            <div class="hero-image-main">
                <img src="<?php echo e(\App\Models\SiteSetting::getImageUrl('hero_image', 'images/hero_cookies.jpg')); ?>" alt="Cookies dan Brownies Homemade Cookies Intan" loading="eager">
            </div>

            <!-- Floating badges -->
            <div class="hero-badge-float left">
                <div class="badge-icon"><?php echo e(\App\Models\SiteSetting::get('hero_badge_left_icon', '🍫')); ?></div>
                <div class="badge-text"><?php echo e(\App\Models\SiteSetting::get('hero_badge_left_title', 'Best Seller')); ?></div>
                <div class="badge-sub"><?php echo e(\App\Models\SiteSetting::get('hero_badge_left_sub', 'Fudgy Brownies')); ?></div>
            </div>

            <div class="hero-badge-float right">
                <div class="badge-icon"><?php echo e(\App\Models\SiteSetting::get('hero_badge_right_icon', '⭐')); ?></div>
                <div class="badge-text"><?php echo e(\App\Models\SiteSetting::get('hero_badge_right_title', '4.9 / 5.0')); ?></div>
                <div class="badge-sub"><?php echo e(\App\Models\SiteSetting::get('hero_badge_right_sub', 'Rating Pelanggan')); ?></div>
            </div>
        </div>
    </div>
</section>

<!-- ===== FEATURE STRIP ===== -->
<section class="feature-strip">
    <div class="feature-strip-inner">
        <div class="feature-item">
            <div class="feature-icon"><?php echo e(\App\Models\SiteSetting::get('feature_1_icon', '🌿')); ?></div>
            <div class="feature-item-text">
                <div class="title"><?php echo e(\App\Models\SiteSetting::get('feature_1_title', '100% Freshly Made')); ?></div>
                <div class="sub"><?php echo e(\App\Models\SiteSetting::get('feature_1_sub', 'Dibuat segar setiap hari')); ?></div>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><?php echo e(\App\Models\SiteSetting::get('feature_2_icon', '🍪')); ?></div>
            <div class="feature-item-text">
                <div class="title"><?php echo e(\App\Models\SiteSetting::get('feature_2_title', '5+ Menu Manis')); ?></div>
                <div class="sub"><?php echo e(\App\Models\SiteSetting::get('feature_2_sub', 'Pilihan lengkap & beragam')); ?></div>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><?php echo e(\App\Models\SiteSetting::get('feature_3_icon', '❤️')); ?></div>
            <div class="feature-item-text">
                <div class="title"><?php echo e(\App\Models\SiteSetting::get('feature_3_title', 'Dibuat Sepenuh Hati')); ?></div>
                <div class="sub"><?php echo e(\App\Models\SiteSetting::get('feature_3_sub', 'Bahan premium pilihan')); ?></div>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><?php echo e(\App\Models\SiteSetting::get('feature_4_icon', '🎁')); ?></div>
            <div class="feature-item-text">
                <div class="title"><?php echo e(\App\Models\SiteSetting::get('feature_4_title', 'Made for Sharing')); ?></div>
                <div class="sub"><?php echo e(\App\Models\SiteSetting::get('feature_4_sub', 'Cocok untuk hadiah & momen spesial')); ?></div>
            </div>
        </div>
    </div>
</section>

<!-- ===== MENU / PRODUCTS SECTION ===== -->
<section class="section" id="menu">
    <div class="container">
        <div class="text-center reveal">
            <div class="section-badge"><?php echo e(\App\Models\SiteSetting::get('menu_section_badge', '✨ Favorit Cookies Intan ✨')); ?></div>
            <h2 class="section-title"><?php echo e(\App\Models\SiteSetting::get('menu_section_title', 'Menu Pilihan Kami')); ?></h2>
            <p class="section-subtitle"><?php echo e(\App\Models\SiteSetting::get('menu_section_subtitle', 'Setiap produk dibuat dengan bahan premium pilihan, menghadirkan cita rasa terbaik yang memanjakan lidah.')); ?></p>
        </div>

        <!-- Category Tabs -->
        <div class="category-tabs reveal">
            <button class="tab-btn active" data-filter="all" id="tab-all">Semua</button>
            <button class="tab-btn" data-filter="brownies" id="tab-brownies">Brownies</button>
            <button class="tab-btn" data-filter="cookies" id="tab-cookies">Cookies</button>
            <button class="tab-btn" data-filter="hampers" id="tab-hampers">Hampers</button>
            <button class="tab-btn" data-filter="cake" id="tab-cake">Birthday Cake</button>
            <button class="tab-btn" data-filter="pudding" id="tab-pudding">Pudding</button>
        </div>

        <!-- Products Grid -->
        <div class="products-grid" id="productsGrid">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="product-card reveal delay-<?php echo e(($index % 5) + 1); ?>" data-category="<?php echo e($product->category); ?>">
                    <div class="product-card-img-wrap">
                        <img class="product-card-img" src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?> Cookies Intan" loading="lazy">
                        <?php if($product->badge): ?>
                            <span class="product-badge"><?php echo e($product->badge); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="product-card-body">
                        <div class="product-name"><?php echo e($product->name); ?></div>
                        <div class="product-desc"><?php echo e($product->description); ?></div>
                        <div class="product-price"><?php echo e($product->formatted_price); ?> <span class="product-price-sub"><?php echo e($product->price_unit); ?></span></div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--text-muted);">
                    <p>Belum ada produk dalam katalog saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ===== ABOUT SECTION ===== -->
<section class="about-section" id="about">
    <div class="about-inner">
        <!-- Images -->
        <div class="about-images reveal-left">
            <img class="about-img-main" src="<?php echo e(\App\Models\SiteSetting::getImageUrl('about_image_main', 'images/hero_cookies.jpg')); ?>" alt="Tentang Cookies Intan" loading="lazy">
            <img class="about-img-secondary" src="<?php echo e(\App\Models\SiteSetting::getImageUrl('about_image_secondary', 'images/cookies.jpg')); ?>" alt="Proses pembuatan cookies" loading="lazy">
            <div class="about-heart">❤️</div>
        </div>

        <!-- Content -->
        <div class="about-content reveal-right">
            <div class="section-badge"><?php echo e(\App\Models\SiteSetting::get('about_section_badge', '🍪 A Little About Us 🍪')); ?></div>
            <h2 class="section-title"><?php echo e(\App\Models\SiteSetting::get('about_section_title', 'Tentang Cookies Intan')); ?></h2>

            <blockquote class="about-quote">
                <?php echo e(\App\Models\SiteSetting::get('about_quote', '"Cookies Intan lahir dari cinta dan kesenangan membuat dessert dengan bahan pilihan."')); ?>

            </blockquote>

            <p class="about-desc">
                <?php echo e(\App\Models\SiteSetting::get('about_desc_1', 'Setiap cookies kami dibuat fresh dengan bahan-bahan berkualitas pilihan, hadir di setiap momen spesial — dari ulang tahun, hadiah, hingga camilan sehari-hari yang memanjakan. Semua sweet things made inside and made with love.')); ?>

            </p>

            <p class="about-desc">
                <?php echo e(\App\Models\SiteSetting::get('about_desc_2', 'Kami percaya bahwa makanan yang dibuat dengan hati akan selalu terasa berbeda. Setiap gigitan adalah bukti cinta kami kepada pelanggan setia Cookies Intan.')); ?>

            </p>

            <p class="about-tagline">
                <em><?php echo e(\App\Models\SiteSetting::get('about_tagline', 'Small treats. Big feelings. ✨')); ?></em>
            </p>

            <div style="margin-top: 32px; display: flex; gap: 16px; flex-wrap: wrap;">
                <a href="https://wa.me/<?php echo e(\App\Models\SiteSetting::get('contact_whatsapp_number', '6287789235490')); ?>" target="_blank" class="btn btn-primary">
                    <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
                </a>
                <a href="#menu" class="btn btn-outline">
                    <i class="fa-solid fa-cookie-bite"></i> Lihat Menu
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ===== HOW TO ORDER SECTION ===== -->
<section class="section how-section" id="cara-pesan">
    <div class="container">
        <div class="text-center reveal">
            <div class="section-badge"><?php echo e(\App\Models\SiteSetting::get('order_section_badge', '✨ Simple & Easy ✨')); ?></div>
            <h2 class="section-title"><?php echo e(\App\Models\SiteSetting::get('order_section_title', 'Cara Pesan Cookies Intan')); ?></h2>
            <p class="section-subtitle"><?php echo e(\App\Models\SiteSetting::get('order_section_subtitle', 'Pesan homemade cookies & dessert favoritmu sangat mudah!')); ?></p>
        </div>

        <div class="steps-grid">
            <div class="step-card reveal delay-1">
                <div class="step-number">01</div>
                <span class="step-icon">🛒</span>
                <h3 class="step-title"><?php echo e(\App\Models\SiteSetting::get('order_step_1_title', 'Pilih Menu')); ?></h3>
                <p class="step-desc"><?php echo e(\App\Models\SiteSetting::get('order_step_1_desc', 'Browse menu favorit di katalog kami — Brownies, Cookies, Hampers, Birthday Cake, atau Pudding sesuai selera.')); ?></p>
            </div>

            <div class="step-card reveal delay-2">
                <div class="step-number">02</div>
                <span class="step-icon">💬</span>
                <h3 class="step-title"><?php echo e(\App\Models\SiteSetting::get('order_step_2_title', 'Chat Kami')); ?></h3>
                <p class="step-desc"><?php echo e(\App\Models\SiteSetting::get('order_step_2_desc', 'Hubungi kami lewat WhatsApp untuk konfirmasi pesanan, alamat, dan detail pengiriman. Kami siap membantu!')); ?></p>
            </div>

            <div class="step-card reveal delay-3">
                <div class="step-number">03</div>
                <span class="step-icon">❤️</span>
                <h3 class="step-title"><?php echo e(\App\Models\SiteSetting::get('order_step_3_title', 'Nikmati Manisnya')); ?></h3>
                <p class="step-desc"><?php echo e(\App\Models\SiteSetting::get('order_step_3_desc', 'Pesanan dikirim fresh dan siap dinikmati. Bagi kebahagiaan manis bersama orang-orang terkasih!')); ?></p>
            </div>
        </div>

        <div class="text-center reveal" style="margin-top: 48px;">
            <a href="https://wa.me/<?php echo e(\App\Models\SiteSetting::get('contact_whatsapp_number', '6287789235490')); ?>?text=Halo%20Cookies%20Intan%2C%20saya%20mau%20pesan!" target="_blank" class="btn btn-primary" style="font-size: 1rem; padding: 14px 36px;">
                <i class="fa-brands fa-whatsapp"></i> <?php echo e(\App\Models\SiteSetting::get('order_btn_text', 'Pesan via WhatsApp Sekarang')); ?>

            </a>
        </div>
    </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section class="section" id="testimoni">
    <div class="container">
        <div class="text-center reveal">
            <div class="section-badge"><?php echo e(\App\Models\SiteSetting::get('testimonial_section_badge', '💬 Kata Mereka 💬')); ?></div>
            <h2 class="section-title"><?php echo e(\App\Models\SiteSetting::get('testimonial_section_title', 'Apa Kata Pelanggan Kami?')); ?></h2>
            <p class="section-subtitle"><?php echo e(\App\Models\SiteSetting::get('testimonial_section_subtitle', 'Ribuan pelanggan puas dengan kelezatan Cookies Intan setiap harinya.')); ?></p>
        </div>

        <div class="testimonials-grid" style="margin-top: 48px;">
            <div class="testimonial-card reveal delay-1">
                <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                <p class="testimonial-text">
                    "Brownies-nya enak banget! Moist, rich, dan rasanya beneran premium. Sudah pesan berkali-kali dan selalu puas. Highly recommended!"
                </p>
                <div class="testimonial-author">
                    <div class="author-avatar">A</div>
                    <div>
                        <div class="author-name">AndreTraa, Bandung</div>
                        <div class="author-city">Pelanggan Setia</div>
                    </div>
                </div>
            </div>

            <div class="testimonial-card reveal delay-2">
                <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                <p class="testimonial-text">
                    "Hampers-nya cantik dan isinya banyak! Teman-teman suka banget ketika saya hadiahin Hampers Cookies Intan waktu arisan. Pasti pesan lagi!"
                </p>
                <div class="testimonial-author">
                    <div class="author-avatar">W</div>
                    <div>
                        <div class="author-name">Wulan, Bandung</div>
                        <div class="author-city">Pelanggan Setia</div>
                    </div>
                </div>
            </div>

            <div class="testimonial-card reveal delay-3">
                <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                <p class="testimonial-text">
                    "Pudding caramel-nya enak banget, creamy, saus karamelnya pas tidak terlalu manis. Birthday cake-nya juga cantik dan lezat. Terima kasih!"
                </p>
                <div class="testimonial-author">
                    <div class="author-avatar">B</div>
                    <div>
                        <div class="author-name">Budi, Surabaya</div>
                        <div class="author-city">Pelanggan Setia</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== FAQ SECTION ===== -->
<section class="section" id="faq" style="background: var(--cream-dark);">
    <div class="container">
        <div class="text-center reveal">
            <div class="section-badge"><?php echo e(\App\Models\SiteSetting::get('faq_section_badge', '❓ FAQ ❓')); ?></div>
            <h2 class="section-title"><?php echo e(\App\Models\SiteSetting::get('faq_section_title', 'Pertanyaan yang Sering Ditanya')); ?></h2>
        </div>

        <div style="max-width: 720px; margin: 48px auto 0;" class="reveal">
            <div class="faq-item" style="background: var(--white); border-radius: var(--radius-md); margin-bottom: 12px; overflow: hidden; box-shadow: var(--shadow-sm);">
                <button class="faq-question" onclick="toggleFaq(this)" style="width:100%; text-align:left; padding: 20px 24px; background:none; border:none; cursor:pointer; font-family:'Poppins',sans-serif; font-size:0.95rem; font-weight:600; color:var(--brown-dark); display:flex; align-items:center; justify-content:space-between;">
                    <?php echo e(\App\Models\SiteSetting::get('faq_1_q', 'Berapa lama waktu pembuatan pesanan?')); ?>

                    <i class="fa-solid fa-chevron-down" style="transition: all 0.3s; color: var(--orange);"></i>
                </button>
                <div class="faq-answer" style="display:none; padding: 0 24px 20px; font-size:0.9rem; color:var(--text-medium); line-height:1.7;">
                    <?php echo e(\App\Models\SiteSetting::get('faq_1_a', 'Waktu pembuatan biasanya 1-2 hari kerja setelah konfirmasi pesanan dan pembayaran. Untuk pesanan hampers atau birthday cake besar, kami sarankan pesan 3-4 hari sebelumnya.')); ?>

                </div>
            </div>

            <div class="faq-item" style="background: var(--white); border-radius: var(--radius-md); margin-bottom: 12px; overflow: hidden; box-shadow: var(--shadow-sm);">
                <button class="faq-question" onclick="toggleFaq(this)" style="width:100%; text-align:left; padding: 20px 24px; background:none; border:none; cursor:pointer; font-family:'Poppins',sans-serif; font-size:0.95rem; font-weight:600; color:var(--brown-dark); display:flex; align-items:center; justify-content:space-between;">
                    <?php echo e(\App\Models\SiteSetting::get('faq_2_q', 'Apakah bisa pesan dengan custom rasa atau packaging?')); ?>

                    <i class="fa-solid fa-chevron-down" style="transition: all 0.3s; color: var(--orange);"></i>
                </button>
                <div class="faq-answer" style="display:none; padding: 0 24px 20px; font-size:0.9rem; color:var(--text-medium); line-height:1.7;">
                    <?php echo e(\App\Models\SiteSetting::get('faq_2_a', 'Ya! Kami menerima custom pesanan untuk rasa, ukuran, dan packaging. Hubungi kami via WhatsApp untuk diskusi lebih lanjut.')); ?>

                </div>
            </div>

            <div class="faq-item" style="background: var(--white); border-radius: var(--radius-md); margin-bottom: 12px; overflow: hidden; box-shadow: var(--shadow-sm);">
                <button class="faq-question" onclick="toggleFaq(this)" style="width:100%; text-align:left; padding: 20px 24px; background:none; border:none; cursor:pointer; font-family:'Poppins',sans-serif; font-size:0.95rem; font-weight:600; color:var(--brown-dark); display:flex; align-items:center; justify-content:space-between;">
                    <?php echo e(\App\Models\SiteSetting::get('faq_3_q', 'Berapa lama ketahanan produk?')); ?>

                    <i class="fa-solid fa-chevron-down" style="transition: all 0.3s; color: var(--orange);"></i>
                </button>
                <div class="faq-answer" style="display:none; padding: 0 24px 20px; font-size:0.9rem; color:var(--text-medium); line-height:1.7;">
                    <?php echo e(\App\Models\SiteSetting::get('faq_3_a', 'Brownies & Cookies: 5-7 hari suhu ruang, 2 minggu di kulkas. Pudding & Cake: 3-4 hari di kulkas. Semua produk tanpa bahan pengawet, fresh dan sehat!')); ?>

                </div>
            </div>

            <div class="faq-item" style="background: var(--white); border-radius: var(--radius-md); margin-bottom: 12px; overflow: hidden; box-shadow: var(--shadow-sm);">
                <button class="faq-question" onclick="toggleFaq(this)" style="width:100%; text-align:left; padding: 20px 24px; background:none; border:none; cursor:pointer; font-family:'Poppins',sans-serif; font-size:0.95rem; font-weight:600; color:var(--brown-dark); display:flex; align-items:center; justify-content:space-between;">
                    <?php echo e(\App\Models\SiteSetting::get('faq_4_q', 'Apakah bisa dikirim ke luar kota?')); ?>

                    <i class="fa-solid fa-chevron-down" style="transition: all 0.3s; color: var(--orange);"></i>
                </button>
                <div class="faq-answer" style="display:none; padding: 0 24px 20px; font-size:0.9rem; color:var(--text-medium); line-height:1.7;">
                    <?php echo e(\App\Models\SiteSetting::get('faq_4_a', 'Untuk saat ini pengiriman dilayani melalui jasa ekspedisi untuk produk Brownies & Cookies (dikemas khusus agar tetap aman). Hubungi kami untuk info biaya ongkir ke daerah Anda.')); ?>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== FINAL CTA ===== -->
<section style="background: linear-gradient(135deg, var(--brown-dark), var(--chocolate)); padding: 100px 24px; position: relative; overflow: hidden; text-align: center;" id="kontak">
    <!-- Decorative images -->
    <div style="position:absolute; right:0; bottom:0; opacity:0.15; font-size: 12rem; pointer-events:none; line-height:1;">🍪</div>
    <div style="position:absolute; left:0; top:0; opacity:0.08; font-size: 10rem; pointer-events:none; line-height:1;">🍫</div>

    <div style="max-width: 700px; margin: 0 auto; position: relative; z-index: 2;" class="reveal">
        <p style="font-size: 0.85rem; font-weight: 700; color: var(--gold-light); letter-spacing: 3px; text-transform: uppercase; margin-bottom: 16px;">
            <?php echo e(\App\Models\SiteSetting::get('final_cta_eyebrow', '🍪 READY FOR A SWEET MOMENT? 🍪')); ?>

        </p>
        <h2 style="font-family: 'Playfair Display', serif; font-size: 3rem; font-weight: 700; color: var(--white); line-height: 1.2; margin-bottom: 16px;">
            <?php echo e(\App\Models\SiteSetting::get('final_cta_title', 'Siap untuk Momen Manis?')); ?>

        </h2>
        <p style="font-size: 1rem; color: rgba(255,255,255,0.7); margin-bottom: 36px; line-height: 1.7;">
            <?php echo e(\App\Models\SiteSetting::get('final_cta_subtitle', 'Pesan sekarang via WhatsApp dan rasakan sendiri kelezatan homemade cookies & dessert Cookies Intan yang dibuat penuh cinta!')); ?>

        </p>
        <a href="https://wa.me/<?php echo e(\App\Models\SiteSetting::get('contact_whatsapp_number', '6287789235490')); ?>?text=Halo%20Cookies%20Intan%2C%20saya%20mau%20pesan!" target="_blank"
           style="display:inline-flex; align-items:center; gap:14px; background: linear-gradient(135deg, #25D366, #128C7E);
                  color: #fff; padding: 18px 44px; border-radius: 50px; font-size: 1.1rem; font-weight: 700;
                  box-shadow: 0 8px 30px rgba(37,211,102,0.5); transition: all 0.3s ease; text-decoration:none;">
            <i class="fa-brands fa-whatsapp" style="font-size:1.5rem;"></i>
            <?php echo e(\App\Models\SiteSetting::get('final_cta_btn_text', 'Pesan via WhatsApp')); ?> · <?php echo e(\App\Models\SiteSetting::get('contact_whatsapp_display', '0877 8923 5490')); ?>

        </a>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    // Product filter tabs
    const tabBtns = document.querySelectorAll('.tab-btn');
    const productCards = document.querySelectorAll('#productsGrid .product-card');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Update active tab
            tabBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.dataset.filter;

            productCards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = '';
                    setTimeout(() => card.style.opacity = '1', 10);
                } else {
                    card.style.opacity = '0';
                    setTimeout(() => card.style.display = 'none', 300);
                }
            });
        });
    });

    // FAQ Toggle
    function toggleFaq(btn) {
        const answer = btn.nextElementSibling;
        const icon = btn.querySelector('.fa-chevron-down');
        const isOpen = answer.style.display === 'block';

        // Close all
        document.querySelectorAll('.faq-answer').forEach(a => a.style.display = 'none');
        document.querySelectorAll('.faq-question .fa-chevron-down').forEach(i => {
            i.style.transform = '';
        });

        if (!isOpen) {
            answer.style.display = 'block';
            icon.style.transform = 'rotate(180deg)';
        }
    }

    // Hover on final CTA WA button
    const finalWaBtn = document.querySelector('#kontak a');
    if (finalWaBtn) {
        finalWaBtn.addEventListener('mouseenter', () => {
            finalWaBtn.style.transform = 'translateY(-3px)';
            finalWaBtn.style.boxShadow = '0 14px 40px rgba(37,211,102,0.6)';
        });
        finalWaBtn.addEventListener('mouseleave', () => {
            finalWaBtn.style.transform = '';
            finalWaBtn.style.boxShadow = '0 8px 30px rgba(37,211,102,0.5)';
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\.gemini\antigravity-ide\scratch\barbershop\resources\views/home.blade.php ENDPATH**/ ?>