<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // === HERO SECTION ===
            ['key' => 'hero_eyebrow', 'value' => '🍪 Homemade dengan Cinta', 'group' => 'hero'],
            ['key' => 'hero_title_1', 'value' => 'Manis untuk', 'group' => 'hero'],
            ['key' => 'hero_title_highlight', 'value' => 'Setiap Momen', 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => 'Dessert homemade yang dibuat fresh dan sepenuh hati — dari bahan pilihan, hadir di setiap kesempatan spesialmu dengan rasa yang tak terlupakan.', 'group' => 'hero'],
            ['key' => 'hero_btn_catalog', 'value' => 'Lihat Katalog', 'group' => 'hero'],
            ['key' => 'hero_btn_order', 'value' => 'Pesan Sekarang', 'group' => 'hero'],
            
            // Hero Badges
            ['key' => 'hero_badge_left_icon', 'value' => '🍫', 'group' => 'hero'],
            ['key' => 'hero_badge_left_title', 'value' => 'Best Seller', 'group' => 'hero'],
            ['key' => 'hero_badge_left_sub', 'value' => 'Fudgy Brownies', 'group' => 'hero'],
            
            ['key' => 'hero_badge_right_icon', 'value' => '⭐', 'group' => 'hero'],
            ['key' => 'hero_badge_right_title', 'value' => '4.9 / 5.0', 'group' => 'hero'],
            ['key' => 'hero_badge_right_sub', 'value' => 'Rating Pelanggan', 'group' => 'hero'],

            // Hero Stats
            ['key' => 'stat_1_num', 'value' => '100%', 'group' => 'hero'],
            ['key' => 'stat_1_label', 'value' => 'Freshly Made', 'group' => 'hero'],
            ['key' => 'stat_2_num', 'value' => '5+', 'group' => 'hero'],
            ['key' => 'stat_2_label', 'value' => 'Menu Manis', 'group' => 'hero'],
            ['key' => 'stat_3_num', 'value' => '❤️', 'group' => 'hero'],
            ['key' => 'stat_3_label', 'value' => 'Dibuat Sepenuh Hati', 'group' => 'hero'],
            ['key' => 'stat_4_num', 'value' => '🎁', 'group' => 'hero'],
            ['key' => 'stat_4_label', 'value' => 'Made for Sharing', 'group' => 'hero'],

            // === KEUNGGULAN / FEATURE STRIP ===
            ['key' => 'feature_1_icon', 'value' => '🌿', 'group' => 'features'],
            ['key' => 'feature_1_title', 'value' => '100% Freshly Made', 'group' => 'features'],
            ['key' => 'feature_1_sub', 'value' => 'Dibuat segar setiap hari', 'group' => 'features'],
            
            ['key' => 'feature_2_icon', 'value' => '🍪', 'group' => 'features'],
            ['key' => 'feature_2_title', 'value' => '5+ Menu Manis', 'group' => 'features'],
            ['key' => 'feature_2_sub', 'value' => 'Pilihan lengkap & beragam', 'group' => 'features'],

            ['key' => 'feature_3_icon', 'value' => '❤️', 'group' => 'features'],
            ['key' => 'feature_3_title', 'value' => 'Dibuat Sepenuh Hati', 'group' => 'features'],
            ['key' => 'feature_3_sub', 'value' => 'Bahan premium pilihan', 'group' => 'features'],

            ['key' => 'feature_4_icon', 'value' => '🎁', 'group' => 'features'],
            ['key' => 'feature_4_title', 'value' => 'Made for Sharing', 'group' => 'features'],
            ['key' => 'feature_4_sub', 'value' => 'Cocok untuk hadiah & momen spesial', 'group' => 'features'],

            // === KATALOG / MENU SECTION ===
            ['key' => 'menu_section_badge', 'value' => '✨ Favorit Cookies Intan ✨', 'group' => 'menu'],
            ['key' => 'menu_section_title', 'value' => 'Menu Pilihan Kami', 'group' => 'menu'],
            ['key' => 'menu_section_subtitle', 'value' => 'Setiap produk dibuat dengan bahan premium pilihan, menghadirkan cita rasa terbaik yang memanjakan lidah.', 'group' => 'menu'],

            // === ABOUT SECTION ===
            ['key' => 'about_section_badge', 'value' => '🍪 A Little About Us 🍪', 'group' => 'about'],
            ['key' => 'about_section_title', 'value' => 'Tentang Cookies Intan', 'group' => 'about'],
            ['key' => 'about_quote', 'value' => '"Cookies Intan lahir dari cinta dan kesenangan membuat dessert dengan bahan pilihan."', 'group' => 'about'],
            ['key' => 'about_desc_1', 'value' => 'Setiap cookies kami dibuat fresh dengan bahan-bahan berkualitas pilihan, hadir di setiap momen spesial — dari ulang tahun, hadiah, hingga camilan sehari-hari yang memanjakan. Semua sweet things made inside and made with love.', 'group' => 'about'],
            ['key' => 'about_desc_2', 'value' => 'Kami percaya bahwa makanan yang dibuat dengan hati akan selalu terasa berbeda. Setiap gigitan adalah bukti cinta kami kepada pelanggan setia Cookies Intan.', 'group' => 'about'],
            ['key' => 'about_tagline', 'value' => 'Small treats. Big feelings. ✨', 'group' => 'about'],

            // === CARA PESAN SECTION ===
            ['key' => 'order_section_badge', 'value' => '✨ Simple & Easy ✨', 'group' => 'order'],
            ['key' => 'order_section_title', 'value' => 'Cara Pesan Cookies Intan', 'group' => 'order'],
            ['key' => 'order_section_subtitle', 'value' => 'Pesan homemade cookies & dessert favoritmu sangat mudah!', 'group' => 'order'],
            
            ['key' => 'order_step_1_title', 'value' => 'Pilih Menu', 'group' => 'order'],
            ['key' => 'order_step_1_desc', 'value' => 'Browse menu favorit di katalog kami — Brownies, Cookies, Hampers, Birthday Cake, atau Pudding sesuai selera.', 'group' => 'order'],

            ['key' => 'order_step_2_title', 'value' => 'Chat Kami', 'group' => 'order'],
            ['key' => 'order_step_2_desc', 'value' => 'Hubungi kami lewat WhatsApp untuk konfirmasi pesanan, alamat, dan detail pengiriman. Kami siap membantu!', 'group' => 'order'],

            ['key' => 'order_step_3_title', 'value' => 'Nikmati Manisnya', 'group' => 'order'],
            ['key' => 'order_step_3_desc', 'value' => 'Pesanan dikirim fresh dan siap dinikmati. Bagi kebahagiaan manis bersama orang-orang terkasih!', 'group' => 'order'],

            ['key' => 'order_btn_text', 'value' => 'Pesan via WhatsApp Sekarang', 'group' => 'order'],

            // === TESTIMONI SECTION ===
            ['key' => 'testimonial_section_badge', 'value' => '💬 Kata Mereka 💬', 'group' => 'testimonials'],
            ['key' => 'testimonial_section_title', 'value' => 'Apa Kata Pelanggan Kami?', 'group' => 'testimonials'],
            ['key' => 'testimonial_section_subtitle', 'value' => 'Ribuan pelanggan puas dengan kelezatan Cookies Intan setiap harinya.', 'group' => 'testimonials'],

            // === FAQ SECTION ===
            ['key' => 'faq_section_badge', 'value' => '❓ FAQ ❓', 'group' => 'faq'],
            ['key' => 'faq_section_title', 'value' => 'Pertanyaan yang Sering Ditanya', 'group' => 'faq'],
            
            ['key' => 'faq_1_q', 'value' => 'Berapa lama waktu pembuatan pesanan?', 'group' => 'faq'],
            ['key' => 'faq_1_a', 'value' => 'Waktu pembuatan biasanya 1-2 hari kerja setelah konfirmasi pesanan dan pembayaran. Untuk pesanan hampers atau birthday cake besar, kami sarankan pesan 3-4 hari sebelumnya.', 'group' => 'faq'],

            ['key' => 'faq_2_q', 'value' => 'Apakah bisa pesan dengan custom rasa atau packaging?', 'group' => 'faq'],
            ['key' => 'faq_2_a', 'value' => 'Ya! Kami menerima custom pesanan untuk rasa, ukuran, dan packaging. Hubungi kami via WhatsApp untuk diskusi lebih lanjut.', 'group' => 'faq'],

            ['key' => 'faq_3_q', 'value' => 'Berapa lama ketahanan produk?', 'group' => 'faq'],
            ['key' => 'faq_3_a', 'value' => 'Brownies & Cookies: 5-7 hari suhu ruang, 2 minggu di kulkas. Pudding & Cake: 3-4 hari di kulkas. Semua produk tanpa bahan pengawet, fresh dan sehat!', 'group' => 'faq'],

            ['key' => 'faq_4_q', 'value' => 'Apakah bisa dikirim ke luar kota?', 'group' => 'faq'],
            ['key' => 'faq_4_a', 'value' => 'Untuk saat ini pengiriman dilayani melalui jasa ekspedisi untuk produk Brownies & Cookies (dikemas khusus agar tetap aman). Hubungi kami untuk info biaya ongkir ke daerah Anda.', 'group' => 'faq'],

            // === KONTAK, FOOTER & FINAL CTA ===
            ['key' => 'contact_whatsapp_number', 'value' => '6287789235490', 'group' => 'contact'],
            ['key' => 'contact_whatsapp_display', 'value' => '0877 8923 5490', 'group' => 'contact'],
            ['key' => 'contact_hours', 'value' => 'Senin - Minggu, 08.00 - 21.00', 'group' => 'contact'],
            ['key' => 'contact_instagram', 'value' => '@cookiesIntan', 'group' => 'contact'],
            ['key' => 'contact_instagram_url', 'value' => 'https://instagram.com/cookiesIntan', 'group' => 'contact'],
            ['key' => 'contact_tiktok_url', 'value' => '#', 'group' => 'contact'],
            ['key' => 'contact_facebook_url', 'value' => '#', 'group' => 'contact'],
            ['key' => 'contact_address_tagline', 'value' => 'Freshly baked with love ❤️', 'group' => 'contact'],
            ['key' => 'footer_description', 'value' => 'Cookies Intan lahir dari cinta dan kesenangan membuat dessert dengan bahan pilihan. Setiap cookies dibuat fresh untuk kebahagiaan setiap momen.', 'group' => 'contact'],

            ['key' => 'final_cta_eyebrow', 'value' => '🍪 READY FOR A SWEET MOMENT? 🍪', 'group' => 'contact'],
            ['key' => 'final_cta_title', 'value' => 'Siap untuk Momen Manis?', 'group' => 'contact'],
            ['key' => 'final_cta_subtitle', 'value' => 'Pesan sekarang via WhatsApp dan rasakan sendiri kelezatan homemade cookies & dessert Cookies Intan yang dibuat penuh cinta!', 'group' => 'contact'],
            ['key' => 'final_cta_btn_text', 'value' => 'Pesan via WhatsApp', 'group' => 'contact'],
        ];

        foreach ($settings as $item) {
            SiteSetting::updateOrCreate(
                ['key' => $item['key']],
                ['value' => $item['value'], 'group' => $item['group']]
            );
        }

        SiteSetting::clearCache();
    }
}
