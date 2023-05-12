<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $orders = Order::select('orders.id as order_id', 'users.name as user_name', 'users.address as user_address', 'users.phone_number as user_phone_number', 'orders.created_at as created_at', 'products.judul as product_name', 'orders.kuantitas as quantity', 'orders.status as status')
    ->join('users', 'users.id', '=', 'orders.user_id')
    ->join('products', 'products.id', '=', 'orders.product_id')
    ->get();

return view('dashboard.orders.index', compact('orders'));
    // $orders = Order::with('user', 'products')->get();
    // $orderItems = [];

    // foreach ($orders as $order) {
    //     foreach ($order->products as $product) {
    //         $orderItems[] = [
    //             'order_id' => $order->pivot->order_id,
    //             'user_name' => $order->user->name,
    //             'user_address' => $order->user->address,
    //             'user_phone_number' => $order->user->phone_number,
    //             'created_at' => $order->created_at,
    //             'product_name' => $product->judul,
    //             'quantity' => $product->pivot->kuantitas,
    //             'status' => $order->status
    //         ];
    //     }
    // }
    // dd($orderItems);
    // return view('dashboard.orders.index', compact('orderItems'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $items = $order->items;

        return view('dashboard.orders.show', [
            'order' => $order,
            'items' => $items,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Order has been deleted.');
    }

    public function getImageUrl($filename)
    {
        return Storage::url('/gambar-produk/' . $filename);
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);



        // $product->save();

        $cartItem = Cart::add($product = [
            'id' => $product->id,
            'name'  =>  $product->judul,
            'qty' => 1,
            'price' =>  $product->harga,
            'options' => ['image' => $product->gambar]
        ]);

        Cart::associate($cartItem->rowId, 'App\Models\Product');
        return redirect('/products');
    }
    public function remove(Request $request)
    {
        Cart::remove($request->rowId);

        return redirect()->back();
    }
    public function checkout(Request $request)
    {
        $user_id = Auth::user()->id;

        foreach (Cart::content() as $item) {
            $order = new Order();
            $order->user_id = $user_id;
            $order->product_id = $item->id;
            $order->kuantitas = $item->qty;
            $order->total_harga = $item->total;

            $order->save();
        }

        Cart::destroy();

        return redirect('/products');
    }

    public function updateStatus($id, $status)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        $order->status = $status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully');
    }

}
