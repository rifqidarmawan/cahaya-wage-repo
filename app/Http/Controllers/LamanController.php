<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class LamanController extends Controller
{
    public function home()
    {
        $barangTerlaris = Order::select('product_id', DB::raw('SUM(kuantitas) as total_kuantitas'))
            ->groupBy('product_id')
            ->orderByDesc('total_kuantitas')
            ->take(3) // Ambil 3 produk terlaris
            ->get();

        $barangTerlaris = $barangTerlaris->map(function ($item) {
            $product = Product::find($item->product_id);
            $item->gambar = $product->gambar;
            $item->product_name = $product->judul; // Ganti dengan nama kolom yang sesuai di tabel "products"
            $item->quantity = $item->total_kuantitas;
            $item->harga = $product->harga; // Ganti dengan nama kolom yang sesuai di tabel "products"
            $item->tagline = $product->tagline; // Ganti dengan nama kolom yang sesuai di tabel "products"
            unset($item->product_id);
            unset($item->total_kuantitas);
            return $item;
        });

        $barangAll = Product::latest()->limit(9)->get();

        return view('home', [
            'active' => 'home',
            'barangTerlaris' => $barangTerlaris,
            'barangAll' => $barangAll
        ]);
    }

    // public function home()
    // {
    //     $barangTerlaris = Order::select('product_id', DB::raw('SUM(kuantitas) as total_kuantitas'))
    //     ->groupBy('product_id')
    //     ->orderByDesc('total_kuantitas')
    //     ->take(3) // Ambil 3 produk terlaris
    //     ->get();

    //     $barangAll = Product::latest()->limit(9)->get();

    //     return view('home', [
    //         'active' => 'home',
    //         'barangTerlaris' => $barangTerlaris,
    //         'barangAll' => $barangAll
    //     ]);

    // }

    public function index()
    {
        return view('products',[
            "active" => 'products',
            "products" => Product::latest()->filter(request(['search']))
            ->paginate(12)->withQueryString()
        ]);
    }

    public function about()
    {
        return view('about',[
            "active" => 'about',
        ]);
    }

    public function dashboard()
    {
        return view ('dashboard.main',[
            'products' => Product::latest()
            // ->filter(request(['search']))
            ->paginate(12)->withQueryString()
        ]);
    }

    public function dashboard_pelanggan()
    {
        return view ('dashboard_pelanggan',[
            "active" => 'about',
            // 'products' => Product::latest()
            // // ->filter(request(['search']))
            // ->paginate(12)->withQueryString()
        ]);
    }



}
