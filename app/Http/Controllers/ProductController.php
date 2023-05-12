<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('dashboard.products.index', [
            'products' =>  Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->gambar->getClientOriginalName();

        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'slug'  =>  'required|unique:products',
            'tagline' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'image|file|max:2048',
            'deskripsi' => 'required'
        ]);
        if($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('gambar-produk');
        }

        Product::create($validatedData);

        return redirect('/dashboard/products')->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('dashboard.products.show',[
            "product" => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('dashboard.products.edit', [
            "product" => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'judul' => 'required|max:255',
            'tagline' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'image|file|max:2048',
            'deskripsi' => 'required'
        ];



        if($request->slug != $product->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if($request->file('gambar')) {
            if($request->gambarLama) {
                Storage::delete($request->gambarLama);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('gambar-produk');
        }

        Product::where('id', $product->id)
            ->update($validatedData);

        return redirect('/dashboard/products')->with('success', 'Berhasil Mengganti POST!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->gambar) {
            Storage::delete($product->gambar);
        }
        Product::destroy($product->id);
        return redirect('/dashboard/products')->with('success', 'Berhasil Menghapus Post!!!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);

    }

    public function showAll()
    {
        return view('dashboard.products.show', [

        ]);
    }


    // ADD TO CART FUNCTION START HERE
    public function cart()
    {
        return view('cart',[
            "active" => 'products',
        ]);
    }
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

            $product = Product::find($product);
            Cart::add($product->id, $product->name, 1, $product->price);
            dd(Cart::get());
            return redirect()->back();

    }

    public function updatecart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }
}
