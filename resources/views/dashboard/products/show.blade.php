@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Product</h1>
    <a href="/dashboard/products" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all my posts</a>
</div>
<style>
    .featurette-heading{

        color: #555;
        margin-bottom: 0.2rem;
    }
    .price {
        color: #FE980F;
        font-size: 1.5em;
        font-weight: bold;
    }
    .tagline {
        color: #555;
        text-transform: capitalize;
    }

</style>
<div class="container">
    <div class="row mb-5">
        <div class="row featurette">
            <div class="col-md-5">
                @if ($product->gambar)
                    <img src="{{ asset('storage/' . $product->gambar)}}" alt="" class="img-fluid mx-auto" width="500" height="500">
                @endif
            </div>
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1 text-uppercase">{{$product->judul}}</span></h2>
                <p class="lead tagline"><strong>{{$product->tagline}}</strong></p>
                <p class="lead price">Harga Rp.{{$product->harga}}</p>
                <p class="lead"><strong>Stock:</strong> {{$product->stok}}</p>
                <p class="lead">{!! $product->deskripsi !!}</p>
            </div>
        </div>
    </div>
</div>
@endsection
