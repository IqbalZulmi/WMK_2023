@extends('html.html')

@section('content')
    @include('components.header')
    @include('components.sidebar')
    <main id="main" class="main">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <img src="{{ asset('assets/img/not-available.svg') }}" alt="" height="400">
                <div class="text-center">
                    <h3>Akun Anda belum diaktifkan.</h3>
                    <p>Mohon tunggu hingga administrator mengaktifkan akun Anda.</p>
                </div>
            </div>
        </div>
    </main>
    @include('components.footer')
@endsection
