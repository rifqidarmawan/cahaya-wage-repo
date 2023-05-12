<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('posts', [
            "title" => "User Posts",
            "posts" => $user->posts
        ]);
    }

    // public function cart(User $user)
    // {
    //     $orders = Order::select('orders.id', 'orders.kuantitas', 'orders.total_harga', 'orders.status', 'products.judul')
    //         ->join('products', 'orders.product_id', '=', 'products.id')
    //         ->where('orders.user_id', $user->id)
    //         ->get();

    //     return view('users.show', compact('users', 'orders'));
    // }

    public function users()
{
    $users = User::where('roles', '<>', '1')->get();

    return view('dashboard.users.index', [
        'active' => 'pengguna',
        'users' => $users
    ]);
}

public function orders(User $user)
{
    $orders = Order::select('orders.id as order_id', 'users.name as user_name', 'users.address as user_address', 'users.phone_number as user_phone_number', 'orders.created_at as created_at', 'products.judul as product_name', 'orders.kuantitas as quantity', 'orders.status as status')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('products', 'products.id', '=', 'orders.product_id')
        ->where('orders.user_id', $user->id)
        ->get();

    return view('dashboard.users.index', [
        'active' => 'pengguna',
        'users' => [$user],
        'orders' => $orders
    ]);
}





}
