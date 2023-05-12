@extends('layouts.main')


@section('container')
<div class="container mt-4">
<div class="row justify-content-center">
    <div class="col-lg-5">

        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <main class="form-registration w-100 m-auto">
            <h1 class="h3 mb-3 fw-normal text-center">Form Registrasi</h1>
            <form action="/register" method="post">
                @csrf
              <div class="form-floating">
                <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Name" required value="{{old('name')}}">
                <label for="name">Name</label>
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{old('username')}}">
                <label for="username">Username</label>
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              <div class="form-floating">
                <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"  placeholder="Masukkan nomor handphone Anda" required value="{{old('phone_numb')}}">
                <label for="phone_number">Phone Number</label>
                @error('phone_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-floating">
                <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Address" required value="{{old('address')}}"></textarea>
                <label for="address">Address</label>
                @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{old('email')}}">
                <label for="email">Email Address</label>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>

              {{-- UNTUK MENGIRIM DATA ROLES --}}
              <input type="hidden" name="roles" value="0">

              <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
            </form>
            <small class="d-block text-center mt-3">Sudah Terdaftar? <a href="/login">Masuk Disini!</a></small>
        </main>

    </div>
</div>
</div>
@endsection
