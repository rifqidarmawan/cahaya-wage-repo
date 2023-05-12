@extends('dashboard.layouts.main')

@section('container')
@auth
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    <h1 class="h2">{{ Auth::user()->name }}<span data-feather="heart"></span>, Daftar Pesanan</h1>

</div>
@endauth
@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{session('success')}}
</div>
@endif
<div class="table-responsive col-lg-8">
    <table class="table table-striped table-sm table-hover">
        <thead class="table-dark text-center">
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nomor Handphone</th>
                <th>Tanggal Pesan</th>
                <th>Nama Produk</th>
                <th>Kuantitas</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($orders as $item)
    <tr>
        <td>{{ $item->user_name }}</td>
        <td>{{ $item->user_address }}</td>
        <td>{{ $item->user_phone_number }}</td>
        <td>{{ date_format(date_create($item->created_at), 'H:i:s d/m/Y') }}</td>
        <td>{{ $item->product_name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>
            <button style="margin-right: 0;" class="btn btn-sm {{$item->status == 'Pending' ? 'btn-warning' : ($item->status == 'Dikirim' ? 'btn-info' : ($item->status == 'Selesai' ? 'btn-success' : ($item->status == 'Diproses' ? 'btn-primary' : 'btn-danger')))}} w-100 p-1 border-0 fw-bold text-uppercase" id="dropdownMenuButton{{$item->order_id}}" data-bs-toggle="dropdown" aria-expanded="false">
                {{ $item->status }}
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton{{$item->order_id}}">
                <li><a class="dropdown-item" href="{{ route('update.order.status', ['id' => $item->order_id, 'status' => '0']) }}">Pending</a></li>
                <li><a class="dropdown-item" href="{{ route('update.order.status', ['id' => $item->order_id, 'status' => '1']) }}">Diproses</a></li>
                <li><a class="dropdown-item" href="{{ route('update.order.status', ['id' => $item->order_id, 'status' => '2']) }}">Dikirim</a></li>
                <li><a class="dropdown-item" href="{{ route('update.order.status', ['id' => $item->order_id, 'status' => '3']) }}">Selesai</a></li>
            </ul>
        </td>
        <td>
            <form action="{{ route('orders.destroy', $item->order_id) }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button style="" class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">
                    <span data-feather="x-circle"></span>
                </button>
            </form>
        </td>
    </tr>
@endforeach

        </tbody>
    </table>
</div>






@endsection
