<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil produk aktif dari database, urutkan berdasarkan sort_order
        $products = Product::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('home', compact('products'));
    }

    public function checkBooking(Request $request)
    {
        return redirect()->route('home');
    }
}
