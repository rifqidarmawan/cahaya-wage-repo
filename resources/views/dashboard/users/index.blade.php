@extends('dashboard.layouts.main')

@section('container')
@auth
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ Auth::user()->name }}<span data-feather="heart"></span>, Ini adalah daftar pengguna yang telah melakukan registrasi</h1>
</div>
@endauth
<div class="table-responsive col-lg-8">
    <table class="table table-striped table-sm table-hover">
        <thead class="table-dark">
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone_number }}</td>
        <td>{{ $user->address }}</td>
        <td>
            <a href="#" class="badge bg-primary" data-bs-toggle="modal" data-bs-target="#myModal-{{ $user->id }}">
                <span data-feather="shopping-bag"></span>
            </a>
            <div class="modal fade" id="myModal-{{ $user->id }}">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Daftar Belanja - {{ $user->name }}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <table class="table table-striped table-sm table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Kuantitas</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->product_id }}</td>
                                        <td>{{ $order->product_name }}</td>
                                        <td>{{ $order->product_price }}</td>
                                        <td>{{ $order->kuantitas }}</td>
                                        <td>{{ $order->total_harga }}</td>
                                        <td class="table-info">
                                            <b class="text-uppercase">
                                                @if ($order->status == 0)
                                                    Pending
                                                @elseif ($order->status == 1)
                                                    Diproses
                                                @elseif ($order->status == 2)
                                                    Dikirim
                                                @elseif ($order->status == 3)
                                                    Selesai
                                                @else
                                                    Unknown
                                                @endif
                                            </b>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
@endforeach




        </tbody>
    </table>
</div>
@endsection
