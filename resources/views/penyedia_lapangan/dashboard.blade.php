@extends('html.html')

@section('content')

    @include('components.header')

    @include('components.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboardPage') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Saldo</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-wallet-3-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>Rp. {{ number_format($totalSaldo, 0, ',', '.') }},00</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-1">
                                        <a href="#kelola-penyedia" class="btn btn-main">Tarik Saldo <i class="ri-exchange-box-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Penarikan yang telah selesai</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cash-coin"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $dataPenarikan->where('status','selesai')->count() }}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-1">
                                        <a href="{{ route('penarikanPage') }}" class="btn btn-main">Lihat <i class="bi bi-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Penarikan yang ditolak</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-file-close-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $dataPenarikan->where('status','ditolak')->count() }}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-1">
                                        <a href="{{ route('jenisLapangan') }}" class="btn btn-main">Lihat <i class="bi bi-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Jumlah Lapangan</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-football-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $dataLapangan->count() }}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-1">
                                        <a href="{{ route('jenisLapangan') }}" class="btn btn-main">Kelola Lapangan <i class="bi bi-pencil-square"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Pemesanan yang Berhasil</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class='bx bx-task'></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>
                                                {{ $pemesananBerhasil }}
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-1">
                                        <a href="{{ route('jenisLapangan') }}" class="btn btn-main">Lihat <i class="bi bi-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Pemesanan yang gagal</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class='bx bx-task-x'></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $pemesananGagal }}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-1">
                                        <a href="{{ route('jenisLapangan') }}" class="btn btn-main">Lihat <i class="bi bi-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    @include('components.footer')
@endsection
