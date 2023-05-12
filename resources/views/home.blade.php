@extends('layouts.main')

@section('container')

    {{-- IKLAN TOKO --}}
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
          <div class="container">
            <div class="carousel-caption text-start">
              <h1>Example headline.</h1>
              <p>Some representative placeholder content for the first slide of the carousel.</p>
              <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
          <div class="container">
            <div class="carousel-caption">
              <h1>Another example headline.</h1>
              <p>Some representative placeholder content for the second slide of the carousel.</p>
              <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
          <div class="container">
            <div class="carousel-caption text-end">
              <h1>One more for good measure.</h1>
              <p>Some representative placeholder content for the third slide of this carousel.</p>
              <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">
        <h1 class="text-center mb-5">Barang Terlaris!</h1>

        <!-- Three columns of text below the carousel -->
        {{-- UNTUK BARANG YANG SERING DIBELI --}}
        <div class="row">

            @foreach ($barangTerlaris as $barang)

                <div class="col-lg-4">
                    <img src="{{ asset('storage/' . $barang->gambar)}}" alt="Gambar Produk" class="img-fluid rounded-circle" width="140" height="140">
                    <h2 class="fw-normal">{{ $barang->product_name }}</h2>
                    <p>
                        <small>
                            {{ $barang->tagline }} <!-- Mengambil tagline produk -->
                        </small>
                    </p>
                    <p>{{ $barang->harga }}</p> <!-- Mengambil harga produk -->
                    <p><a class="btn btn-secondary" href="#">Beli &raquo;</a></p>
                </div>
            @endforeach

        </div>


      <!-- START THE FEATURETTES -->
        <hr class="featurette-divider">
        <div class="row row-cols-1 row-cols-md-3 g-4">

        @foreach ($barangAll as $product)
        <div class="col-md-8 col-lg-6 col-xl-4">
            <div class="card" style="border-radius: 15px;">
              <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light"
                data-mdb-ripple-color="light">
                <img src="{{ asset('storage/' . $product->gambar)}}"
                  style="border-top-left-radius: 15px; border-top-right-radius: 15px;" class="img-fluid"
                  alt="Laptop" />
                <a href="#!">
                  <div class="mask"></div>
                </a>
              </div>
              <div class="card-body pb-0">
                <div class="d-flex justify-content-between">
                  <div>
                    <p><a href="#!" class="text-dark">{{ $product->judul }}</a></p>
                    <p class="small text-muted text-capitalize">{{ $product->tagline }}</p>
                  </div>
                  <div class="d-flex justify-content-between">
                    <p class="text-dark">${{ $product->harga }}</p>
                  </div>
                </div>
              </div>
              <hr class="my-0" />
              <div class="card-body pb-0">
                <div class="d-flex justify-content-between">
                  <p class="text-dark">desc:</p>
                </div>
                <p class="text-dark text-muted">{{ $product->deskripsi }}</p>
              </div>
              <hr class="my-0" />
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center pb-2 mb-1">
                    @auth
                    <button type="button" class="btn btn-primary">
                        <a href="{{ route('cart.add', $product->id) }}" class="text-decoration-none text-light" role="button">Add to Cart</a> <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    </button>
                    @else
                        <a href="/login" class="btn btn-primary">Add to Cart</a>
                    @endauth

                </div>
              </div>
            </div>
          </div>
        @endforeach

        </div>

    </div><!-- /.container -->

    <hr class="featurette-divider">
    <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2017–2022 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>
@endsection


