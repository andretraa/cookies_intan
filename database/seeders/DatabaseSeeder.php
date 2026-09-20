<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed or update Admin User
        User::updateOrCreate(
            ['email' => 'admin@cookiesintan.com'],
            [
                'name' => 'Admin Cookies Intan',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Also ensure any previous admin has access if preferred
        User::updateOrCreate(
            ['email' => 'admin@barbershop.com'],
            [
                'name' => 'Admin Cookies Intan',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 2. Seed Initial Products
        Product::truncate();

        $initialProducts = [
            [
                'name' => 'Puding Buah Segar Vla Vanilla',
                'category' => 'pudding',
                'description' => 'Puding lapis buah segar kombinasi jeruk sankis, kiwi, stroberi, leci, dan biji selasih berpadu puding susu lembut, disajikan lengkap dengan saus vla vanilla spesial yang creamy dan nikmat.',
                'price' => 120000,
                'price_unit' => '/loyang',
                'badge' => 'Best Seller',
                'image' => 'images/puding_buah_vla.jpg',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Lilac Vintage Birthday Cake',
                'category' => 'cake',
                'description' => 'Kue ulang tahun bergaya Korean vintage warna pastel lilac elegan, dihiasi piping ruffle bertingkat, mutiara edible, dan aksen pita satin ungu manis. Tekstur bolu super lembut dengan lapisan krim lezat, bisa custom ucapan.',
                'price' => 150000,
                'price_unit' => '/cake',
                'badge' => 'Favorit',
                'image' => 'images/lilac_vintage_cake.jpg',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Strawberry Basque Cheesecake',
                'category' => 'cake',
                'description' => 'Cheesecake lembut dan creamy khas Basque dengan tekstur lumer di mulut, dipadukan lelehan selai strawberry murni di bagian tengah, swirl whipped cream lembut, serta topping buah strawberry segar pilihan.',
                'price' => 135000,
                'price_unit' => '/cake',
                'badge' => 'Rekomendasi',
                'image' => 'images/strawberry_cheesecake.jpg',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Classic Red Velvet Cake',
                'category' => 'cake',
                'description' => 'Bolu red velvet moist nan lembut berpadu dengan cream cheese frosting premium yang gurih dan manis pas, diselimuti taburan red velvet crumb serta potongan buah strawberry segar melingkar di atasnya.',
                'price' => 165000,
                'price_unit' => '/cake',
                'badge' => 'Premium',
                'image' => 'images/red_velvet_cake.jpg',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Chocolate Fruit Tart Cake',
                'category' => 'cake',
                'description' => 'Kue tart cokelat istimewa berbalut lapisan cokelat ganache pekat dan lezat, dipercantik aneka buah segar (jeruk sankis, anggur hijau & ungu, leci, stroberi) serta cokelat batangan, lengkap dengan tulisan ucapan custom.',
                'price' => 160000,
                'price_unit' => '/cake',
                'badge' => 'Spesial',
                'image' => 'images/chocolate_fruit_cake.jpg',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Mini Puding Cokelat Buah',
                'category' => 'pudding',
                'description' => 'Puding cokelat lembut dan kaya rasa dalam porsi personal bento, bertabur kombinasi buah-buahan segar seperti kiwi, mangga manis, stroberi, dan anggur. Pilihan manis praktis untuk camilan harian atau hampers mini.',
                'price' => 45000,
                'price_unit' => '/box',
                'badge' => 'Mini Dessert',
                'image' => 'images/mini_puding_cokelat_buah.jpg',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Puding Tart Cokelat Buah Segar',
                'category' => 'pudding',
                'description' => 'Puding tart cokelat premium loyang besar dengan lapisan puding pekat yang lumer, dihiasi aneka buah-buahan segar penuh warna seperti mangga harum manis, kiwi, stroberi, jeruk sankis, serta anggur merah & hijau.',
                'price' => 130000,
                'price_unit' => '/loyang',
                'badge' => 'Best Seller',
                'image' => 'images/puding_tart_cokelat_buah.jpg',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Custom Celebration Cake',
                'category' => 'cake',
                'description' => 'Kue perayaan ulang tahun istimewa bertabur aneka cookies renyah, buah kiwi & stroberi segar, dan cokelat bar mini. Dilengkapi hiasan pita elegan dan tulisan cokelat custom sesuai momen spesial Anda.',
                'price' => 165000,
                'price_unit' => '/cake',
                'badge' => 'Spesial',
                'image' => 'images/custom_celebration_cake.jpg',
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'name' => 'Puding Cokelat Buah Tropis',
                'category' => 'pudding',
                'description' => 'Puding cokelat lembut bertabur aneka buah tropis segar berwarna-warni (jeruk sankis, leci manis, stroberi segar, anggur merah & hijau) berlapis jelly bening berkilau. Paduan rasa manis cokelat dan kesegaran buah yang sempurna.',
                'price' => 125000,
                'price_unit' => '/loyang',
                'badge' => 'Segar & Sehat',
                'image' => 'images/puding_cokelat_buah_tropis.jpg',
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'name' => 'Brownies Tower Birthday Cake',
                'category' => 'brownies',
                'description' => 'Susunan menara potongan fudgy brownies super moist & chewy berhiaskan lelehan cokelat putih, cokelat Milo & Cadbury, hiasan manis, serta topper karakter (custom tema seperti Kuromi). Alternatif kue ulang tahun modern yang unik dan lezat.',
                'price' => 175000,
                'price_unit' => '/tower',
                'badge' => 'Kekinian',
                'image' => 'images/brownies_tower_birthday.jpg',
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'name' => 'Korean Bento Cake',
                'category' => 'cake',
                'description' => 'Kue ulang tahun mini ala Korea (Lunchbox / Bento Cake) dengan hiasan motif ceri lucu, buttercream lembut, lengkap dengan lilin emas dan sendok serta pita satin merah manis. Praktis untuk kejutan ultah personal yang aesthetic.',
                'price' => 55000,
                'price_unit' => '/box',
                'badge' => 'Cute & Viral',
                'image' => 'images/korean_bento_cake.jpg',
                'is_active' => true,
                'sort_order' => 11,
            ],
            [
                'name' => 'Classic Mocha Nougat Cake',
                'category' => 'cake',
                'description' => 'Kue tart mocha legendaris ukuran persegi besar berbalut taburan kacang nougat renyah dan karamel gurih. Dihiasi aneka cookies butter, biskuit oreo, wafer kelapa, mini chocolate bar, dan buah ceri merah manis. Cocok untuk perayaan keluarga besar.',
                'price' => 220000,
                'price_unit' => '/loyang',
                'badge' => 'Spesial Keluarga',
                'image' => 'images/mocha_nougat_cake.jpg',
                'is_active' => true,
                'sort_order' => 12,
            ],
            [
                'name' => 'Chocolate Strawberry Delight Cake',
                'category' => 'cake',
                'description' => 'Kue ulang tahun cokelat ganache pekat berlapis rasa kaya, berhiaskan potongan stroberi segar manis, aneka cookies mentega renyah, butiran cokelat, dan tulisan custom dari cokelat putih berkualitas tinggi.',
                'price' => 160000,
                'price_unit' => '/cake',
                'badge' => 'Favorit',
                'image' => 'images/choco_strawberry_cake.jpg',
                'is_active' => true,
                'sort_order' => 13,
            ],
            [
                'name' => 'Barbie Pink Brownies Tower',
                'category' => 'brownies',
                'description' => 'Menara brownies bertingkat dengan lelehan cokelat pink stroberi manis, marshmallow hati lembut, buah stroberi & ceri segar, serta dekorasi topper tema Barbie cantik. Pilihan kado ulang tahun impian anak & remaja.',
                'price' => 175000,
                'price_unit' => '/tower',
                'badge' => 'Spesial Anak',
                'image' => 'images/barbie_brownies_tower.jpg',
                'is_active' => true,
                'sort_order' => 14,
            ],
            [
                'name' => 'Brownies Cake Cookies & Cream',
                'category' => 'brownies',
                'description' => 'Kue tart berbasis fudgy brownies cokelat panggang yang pekat dan chewy, dilapisi lelehan cokelat putih, remahan kacang renyah, biskuit oreo, butter cookies, mini chocolate bar, dan buah ceri merah segar. Lengkap dengan custom ucapan cokelat.',
                'price' => 150000,
                'price_unit' => '/cake',
                'badge' => 'Best Seller',
                'image' => 'images/brownies_cake_cookies_cream.jpg',
                'is_active' => true,
                'sort_order' => 15,
            ],
        ];

        foreach ($initialProducts as $data) {
            Product::create($data);
        }

        // 3. Seed Site Settings
        $this->call(SiteSettingSeeder::class);
    }
}
