@extends('html.html')

@section('content')
    <div class="container-fluid bg-white">
        <div class="row min-vh-100">
            <div class="col-lg-6 d-none d-lg-block">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="3000">
                            <img src="{{ asset('assets/img/c7.jpg') }}" class="d-block w-100" alt="Image 1">
                            <div class="spasi-atas">
                                <h5>Kelola lapanganmu di SportsCamp!</h5>
                                <p>ayo Kelola informasi dan status lapangan milikmu disini!</p>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="{{ asset('assets/img/c8.jpg') }}" class="d-block w-100" alt="Image 2">
                            <div class="spasi-atas">
                                <h5>Atur Jadwalnya</h5>
                                <p>perbanyak jadwalnya, semakin banyak pertandingannya!</p>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="{{ asset('assets/img/c9.jpg') }}" class="d-block w-100" alt="Image 3">
                            <div class="spasi-atas">
                                <h5>pemesanan dan konfirmasi!</h5>
                                <p>pantau pemesanannya, konfirmasi secepatnya!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex justify-content-center align-items-center main-color">
                <div>
                    <img src="{{ asset('assets/img/logo.png') }}" alt="SportsCamp Logo" class="my-3 mb-lg-3" style="width: 300px; display: block; margin-left: auto; margin-right: auto;">
                    <form action="{{ route('loginProcess') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" required placeholder="Masukkan alamat email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Masukkan password" value="{{ old('password') }}">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <a href="#" class="anchor">Forgot password?</a>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Login</button>
                    </form>
                    <div class="my-3 text-center">
                        Belum punya akun penyedia lapangan? <a href="{{ route('registerPage') }}" class="anchor">Daftar disini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
