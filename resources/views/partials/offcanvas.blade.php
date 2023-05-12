<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasRightLabel">Daftar Belanja</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <p>{{Cart::total()}}</p>
        @foreach (Cart::content() as $item)
            <div>
                <img src="{{ asset($item->options['image']) }}" alt="{{ $item->name }}">
                <h2>{{ $item->name }}</h2>
                <p>Kuantitas: {{ $item->qty }}</p>
                <p>Harga: {{ $item->price }}</p>
            </div>
            <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                <form action="{{ route('cart.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                    <button type="submit">Hapus</button>
                </form>
            </div>
        @endforeach

        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
            </div>
        </div>
    </div>
</div>
