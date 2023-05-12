@extends('dashboard.layouts.main')

@section('container')
@auth
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    <h1 class="h2">Selamat Datang {{ Auth::user()->name }}<span data-feather="heart"></span>, Inilah Daftar Barang Anda</h1>

</div>
@endauth
    <div class="album py-5">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($products as $product)
                <div cl ass="col">
                    <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $product->gambar)}}" alt="gambar_produk" class="bd-placeholder-img card-img-top" width="100%" height="225" focusable="false">

                      <div class="card-body ">
                        <div class="card-header">
                            {{$product->judul}}
                          </div>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$product->tagline}}</li>
                            <li class="list-group-item">Harga: Rp.{{$product->harga}}</li>
                            <li class="list-group-item">Stok: {{$product->stok}}</li>

                          </ul>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-success">View</button>
                            <button type="button" class="btn btn-sm btn-outline-info">Edit</button>
                            <button type="button" class="btn btn-sm btn-outline-danger">Hapus</button>
                          </div>
                          <small class="h6 text-muted">Terjual : {{$product->terjual}}</small>
                        </div>
                      </div>
                    </div>
                  </div>
            @endforeach
            {{ $products->links() }}
        </div>
      </div>
    </div>

@endsection


