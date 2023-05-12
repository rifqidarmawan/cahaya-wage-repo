@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Produk</h1>
    <a href="/dashboard/products" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all my posts</a>
</div>
<div class="col-lg-8">
    <form method="post" action="/dashboard/products/{{$product->slug}}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control @error ('judul') is-invalid @enderror" id="judul" name="judul" required autofocus value="{{old('judul', $product->judul)}}">
            @error('judul')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error ('slug') @enderror" id="slug" name="slug" required value="{{old('slug', $product->slug)}}">
            @error('slug')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tagline" class="form-label">Tagline</label>
            <input type="text" class="form-control @error ('tagline') @enderror" id="tagline" name="tagline" required value="{{old('tagline', $product->tagline)}}">
            @error('tagline')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control @error ('harga') @enderror" id="harga" name="harga" required value="{{old('harga', $product->harga)}}">
            @error('harga')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control @error ('stok') @enderror" id="stok" name="stok" required value="{{old('stok', $product->stok)}}">
            @error('stok')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label ">Gambar Produk</label>
            <input type="hidden" name="gambarLama" value="{{ $product->gambar }}">
            @if ($product->gambar)
                <img src="{{ asset('storage/' . $product->gambar)}}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
                <img class="img-preview img-fluid mb-3 col-sm-5">
            @endif

            <input class="form-control @error ('gambar') @enderror" type="file" id="gambar" name="gambar" onchange="previewImage()">
            @error('gambar')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            @error('deskripsi')
                <p class="text-danger">{{ $message}}</p>
            @enderror
                <input id="deskripsi" type="hidden" name="deskripsi" value="{{old('deskripsi', $product->deskripsi)}}">
                <trix-editor input="deskripsi"></trix-editor>
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>

<script>
    const judul = document.querySelector('#judul');
    const slug = document.querySelector('#slug');

    judul.addEventListener('change', function(){
        fetch('/dashboard/products/checkSlug?judul=' + judul.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    });

    function previewImage() {
        const gambar = document.querySelector('#gambar');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(gambar.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>



@endsection
