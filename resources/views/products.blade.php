@extends('layouts.main')

@section('container')

<div class="container mt-4">
<h1 class="text-center">Halaman Produk</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/products">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search.." name="search" value="{{request('search')}}">
                    <button class="btn btn-success" type="submit">Cari Barang</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif
        <div class="row ">
            <div class="row row-cols-1 row-cols-md-4 g-4 mb-4">

                @foreach ($products as $product)
                <div class="col">
                    <div class="card shadow-sm cart-item-image">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @if ($product->gambar)
                            <img src="{{ asset('storage/' . $product->gambar)}}" alt="" class="img-fluid mx-auto" width="500" height="500">
                        @else
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                        @endif
                      <div class="card-body ">
                        <div class="card-header">
                            {{$product->judul}}
                          </div>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$product->tagline}}</li>
                            <li class="list-group-item">{{$product->harga}}</li>
                          </ul>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            @auth
                                <button type="button" class="btn btn-sm btn-outline-success">
                                    <a href="{{ route('cart.add', $product->id) }}" class="text-decoration-none" role="button">Add to cart</a>
                                </button>
                            @else
                                <a href="/login" class="btn btn-sm btn-outline-success">Add to Cart</a>
                            @endauth
                          </div>
                          <small class="h6 text-muted">Stok : {{$product->stok}}</small>
                        </div>
                      </div>
                    </div>
                  </div>
            @endforeach
            </div>

            {{ $products->links() }}
        </div>

    </div>

</div>

<hr class="featurette-divider">
<footer class="container">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>&copy; 2017–2022 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
</footer>
@endsection
