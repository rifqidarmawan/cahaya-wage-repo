@extends('layouts.main')

@section('container')
@if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="container-fluid g-0">
    <section style="background-color: #eee;">
        <div class="container p-5 ">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
              <div class="card">
                <div class="card-body p-4">

                  <div class="row">

                    <div class="col-lg-7">
                      <h5 class="mb-3"><a href="/products" class="text-body"><i
                            class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                      <hr>

                      <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                          <p class="mb-1"><b class="text-uppercase">Shopping cart</b></p>
                          <p class="mb-0">Anda mempunyai <b>{{ Cart::count() }}</b> barang di keranjang</p>
                        </div>
                      </div>

                        @foreach (Cart::content() as $item)
                        <div class="card mb-3">
                            <div class="card-body">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                  <div>
                                    <img
                                      src="{{ asset($item->options['image']) }}" alt="{{ $item->name }}"
                                      class="img-fluid rounded-3" alt="Shopping item" style="width: 200px;">
                                  </div>
                                  <div class="ms-3">
                                    <h5>{{ $item->name }}</h5>
                                  </div>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                  <div style="width: 50px;">
                                    <h5 class="fw-normal mb-0">{{ $item->qty }}</h5>
                                  </div>
                                  <div style="width: 80px;">
                                    <h5 class="mb-0">{{ $item->total }}</h5>
                                  </div>
                                  <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach

                    </div>
                    <div class="col-lg-5">

                      <div class="card bg-primary text-white rounded-3">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Checkout</h5>
                          </div>

                          <div class="d-flex justify-content-between mb-4">
                            <p class="mb-2">Total Harga</p>
                            <p class="mb-2 fw-bold mb-0 ">{{Cart::total()}}</p>
                          </div>

                          <hr class="my-4">
                          <div class="d-flex justify-content-start">
                            <button type="button" class="btn btn-success btn-lg me-2" onclick="window.location.href='https://api.whatsapp.com/send?phone=628992900929&text=Halo,%20saya%20ingin%20membeli%20produk%20Anda%20via%20transfer%20dan%20ini%20bukti%20transfernya'">Via Transfer <i class="bi bi-whatsapp"></i></button>
                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                               <button type="submit" class="btn btn-info btn-lg me-2">Cash On Delivery <i class="bi bi-arrow-right"></i></button>
                            </form>
                          </div>

                        </div>
                      </div>

                    </div>

                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <hr class="featurette-divider mt-5">

      </section>
    </div>
<footer class="container">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>&copy; 2017–2022 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
</footer>
  <script>
    function openWhatsApp() {
      window.location.href = 'https://api.whatsapp.com/send?phone=628992900929&text=Halo,%20saya%20ingin%20membeli%20produk%20Anda%20via%20transfer%20dan%20ini%20bukti%20transfernya';
    }
  </script>

@endsection
