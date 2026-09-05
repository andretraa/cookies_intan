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
                'name' => 'Fudgy Brownies',
                'category' => 'brownies',
                'description' => 'Brownies super moist dengan lapisan cokelat rich yang intense.',
                'price' => 45000,
                'price_unit' => '/box',
                'badge' => 'Best Seller',
                'image' => 'images/brownies.jpg',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Choco Chip Cookies',
                'category' => 'cookies',
                'description' => 'Crispy di luar, chewy di dalam, penuh chocolate chip lumer.',
                'price' => 38000,
                'price_unit' => '/pcs',
                'badge' => 'Favorit',
                'image' => 'images/cookies.jpg',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Sweet Moment Hampers',
                'category' => 'hampers',
                'description' => 'Kado manis berisi pilihan cookies & brownies premium siap kirim.',
                'price' => 125000,
                'price_unit' => '/set',
                'badge' => 'Gift',
                'image' => 'images/hampers.jpg',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Birthday Cake',
                'category' => 'cake',
                'description' => 'Kue ulang tahun cokelat mewah dengan dekorasi premium.',
                'price' => 150000,
                'price_unit' => '/mulai dari',
                'badge' => 'Spesial',
                'image' => 'images/birthday_cake.jpg',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Caramel Pudding',
                'category' => 'pudding',
                'description' => 'Puding karamel creamy dengan saus karamel homemade yang kaya rasa.',
                'price' => 35000,
                'price_unit' => '/cup',
                'badge' => null,
                'image' => 'images/caramel_pudding.jpg',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Brownies Walnut',
                'category' => 'brownies',
                'description' => 'Brownies fudgy dengan tambahan walnut renyah yang gurih.',
                'price' => 55000,
                'price_unit' => '/box',
                'badge' => null,
                'image' => 'images/brownies.jpg',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        return collect($items)->map(function ($attributes) {
            $p = new Product();
            $p->fill($attributes);
            return $p;
        });
    }
}

