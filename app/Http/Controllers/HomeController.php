<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $products = Product::where('is_active', true)
                ->orderBy('sort_order', 'asc')
                ->orderBy('id', 'desc')
                ->get();

            if ($products->isEmpty()) {
                $products = $this->getDefaultProducts();
            }
        } catch (\Throwable $e) {
            $products = $this->getDefaultProducts();
        }

        return view('home', compact('products'));
    }

    public function checkBooking(Request $request)
    {
        return redirect()->route('home');
    }

    private function getDefaultProducts()
    {
        $items = [
            [
                'name' => 'Puding Buah Segar Vla Vanilla',
                'category' => 'pudding',
                'description' => 'Puding lapis buah segar kombinasi jeruk sankis, kiwi, stroberi, leci, dan biji selasih berpadu puding susu lembut, disajikan lengkap dengan saus vla vanilla spesial yang creamy dan nikmat.',
                'price' => 120000,
                'price_unit' => '/loyang',
                'badge' => 'Best Seller',
                'image' => 'uploads/products/puding_buah_vla.jpg',
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
                'image' => 'uploads/products/lilac_vintage_cake.jpg',
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
                'image' => 'uploads/products/strawberry_cheesecake.jpg',
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
                'image' => 'uploads/products/red_velvet_cake.jpg',
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
                'image' => 'uploads/products/chocolate_fruit_cake.jpg',
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
                'image' => 'uploads/products/mini_puding_cokelat_buah.jpg',
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
                'image' => 'uploads/products/puding_tart_cokelat_buah.jpg',
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
                'image' => 'uploads/products/custom_celebration_cake.jpg',
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
                'image' => 'uploads/products/puding_cokelat_buah_tropis.jpg',
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
                'image' => 'uploads/products/brownies_tower_birthday.jpg',
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
                'image' => 'uploads/products/korean_bento_cake.jpg',
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
                'image' => 'uploads/products/mocha_nougat_cake.jpg',
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
                'image' => 'uploads/products/choco_strawberry_cake.jpg',
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
                'image' => 'uploads/products/barbie_brownies_tower.jpg',
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
            [
                'name' => 'Fudgy Brownies Box Mix Topping (18 Bites)',
                'category' => 'brownies',
                'description' => 'Potongan fudgy brownies cokelat pekat nan lezat bertekstur moist & chewy dalam kemasan box eksklusif isi 18 bites. Dilengkapi 6 varian topping favorit sekaligus: Keju Parut Gurih, Choco Chips Premium, Sliced Almond, Candy Milo Cube, Biskuit Oreo, dan Cincangan Kacang Renyah.',
                'price' => 85000,
                'price_unit' => '/box',
                'badge' => 'Best Seller',
                'image' => 'images/fudgy_brownies_mix_topping.jpg',
                'is_active' => true,
                'sort_order' => 16,
            ],
            [
                'name' => 'Puding Buah Segar Personal Cup',
                'category' => 'pudding',
                'description' => 'Dessert puding sutra super lembut dalam kemasan cup personal praktis. Dilengkapi topping kombinasi buah segar melimpah seperti potongan Stroberi, Kiwi, Anggur Merah manis, dan Biji Selasih dengan lapisan jelly bening yang berkilau & menyegarkan.',
                'price' => 15000,
                'price_unit' => '/cup',
                'badge' => 'Segar & Sehat',
                'image' => 'images/puding_buah_personal_cup.jpg',
                'is_active' => true,
                'sort_order' => 17,
            ],
            [
                'name' => 'Lekker Holland Almond Raisin Premium',
                'category' => 'cake',
                'description' => 'Kue mentega khas Belanda (Dutch Butter Cake) dengan tekstur luar renyah dan bagian dalam yang sangat rich, buttery, & lembut. Dihiasi motif ukir emas dengan irisan almond panggang berbentuk bunga yang cantik dan kismis manis.',
                'price' => 85000,
                'price_unit' => '/loyang',
                'badge' => 'Klasik Premium',
                'image' => 'images/lekker_holland_almond_raisin.jpg',
                'is_active' => true,
                'sort_order' => 18,
            ],
            [
                'name' => 'Birthday Brownies Box Custom Ucapan',
                'category' => 'brownies',
                'description' => 'Kue ulang tahun kekinian berbasis fudgy brownies cokelat pekat berbentuk box persegi. Bertabur hiasan Ceri Merah segar, Cokelat Batangan (Dark & Milk), Butter Cookies, Biskuit Oreo, dan siraman cokelat. Dilengkapi tulisan ucapan custom dari cokelat putih.',
                'price' => 145000,
                'price_unit' => '/box',
                'badge' => 'Spesial Ultah',
                'image' => 'images/birthday_brownies_custom_box.jpg',
                'is_active' => true,
                'sort_order' => 19,
            ],
            [
                'name' => 'Fudgy Brownies Potong Satuan',
                'category' => 'brownies',
                'description' => 'Potongan fudgy brownies cokelat moist bertabur choco chips gurih manis, dikemas higienis menggunakan plastik sealer individual berlogo Cookies Intan. Sangat praktis untuk camilan harian, bekal anak, souvenir event, atau isian snack box.',
                'price' => 8000,
                'price_unit' => '/pcs',
                'badge' => 'Praktis',
                'image' => 'images/fudgy_brownies_satuan.png',
                'is_active' => true,
                'sort_order' => 20,
            ],
            [
                'name' => 'Brownies Ring Bundt Melted White Choco',
                'category' => 'brownies',
                'description' => 'Kue brownies bundt/ring panggang cokelat pekat berdiameter besar disiram glazed cokelat putih lumer yang melimpah. Dihiasi topping istimewa: taburan kacang cincang renyah, biskuit Oreo, butter cookies, choco ball, dan potongan wafer kelapa lezat. Disajikan cantik dalam kotak hampers eksklusif motif pink gingham.',
                'price' => 95000,
                'price_unit' => '/box',
                'badge' => 'Kreatif & Viral',
                'image' => 'images/brownies_bundt_white_glaze.jpg',
                'is_active' => true,
                'sort_order' => 21,
            ],
            [
                'name' => 'Birthday Brownies Deluxe Fruit & Cookie Box',
                'category' => 'brownies',
                'description' => 'Fudgy brownies ultah edisi deluxe berbentuk box persegi berhias lelehan cokelat pekat. Dilengkapi kombinasi topping melimpah: potongan buah Stroberi segar, Ceri Merah, Cokelat Batangan Mini, Biskuit Oreo, Butter Cookies, Lamington Coconut Cake, dan tulisan ucapan custom dari huruf cokelat putih.',
                'price' => 160000,
                'price_unit' => '/box',
                'badge' => 'Deluxe Ultah',
                'image' => 'images/birthday_brownies_deluxe_box.jpg',
                'is_active' => true,
                'sort_order' => 22,
            ],
        ];

        return collect($items)->map(function ($attributes) {
            $p = new Product();
            $p->fill($attributes);
            return $p;
        });
    }
}

