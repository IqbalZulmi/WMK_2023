@extends('html.html')

@push('js')
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                info: true,
                dom: '<"row"<"col-sm-6 d-flex justify-content-center justify-content-sm-start mb-2 mb-sm-0"l><"col-sm-6 d-flex justify-content-center justify-content-sm-end"f>>rt<"row"<"col-sm-6 mt-0"i><"col-sm-6 mt-2"p>>',
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.review').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                image: {
                    verticalFit: true
                },
                tClose: 'Tutup',
                tLoading: 'Memuat gambar...',
            });
        });
    </script>
@endpush

@section('content')

    @include('components.header')

    @include('components.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Riwayat Validasi Pemesanan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('adminDashboardPage') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">Riwayat Validasi</li>
                    <li class="breadcrumb-item active">Pemesanan</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Selesai</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Ditolak</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover border table-bordered align-middle">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">No Handphone</th>
                                                    <th scope="col">Total Harga</th>
                                                    <th scope="col">Tanggal Pembayaran</th>
                                                    <th scope="col">Bukti Pembayaran</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Komentar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($dataBerhasil as $index => $data )
                                                    <tr>
                                                        <th>{{ $index+1 }}</th>
                                                        <td>{{ $data->pemesanan->pelanggan->nama }}</td>
                                                        <td>{{ $data->pemesanan->pelanggan->user->email }}</td>
                                                        <td>{{ $data->pemesanan->pelanggan->no_hp }}</td>
                                                        <td>
                                                            Rp. {{ number_format($data->pemesanan->total_harga, 0, ',', '.') }},00
                                                        </td>
                                                        <td>{{ $data->tanggal_pembayaran }}</td>
                                                        <td class="text-center">
                                                            <a href="{{ asset('storage/'. $data->bukti_pembayaran) }}" class="btn btn-main review">
                                                                <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lihat Bukti"></i>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-success" disabled>
                                                                {{ $data->pemesanan->status }}
                                                            </button>
                                                        </td>
                                                        <td>{{ $data->pemesanan->komentar ?? '-' }}</td>
                                                    </tr>
                                                @empty

                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade profile-edit" id="profile-edit">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover border table-bordered align-middle">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">No Handphone</th>
                                                    <th scope="col">Total Harga</th>
                                                    <th scope="col">Tanggal Pembayaran</th>
                                                    <th scope="col">Bukti Pembayaran</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Komentar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($dataGagal as $index => $data )
                                                    <tr>
                                                        <th>{{ $index+1 }}</th>
                                                        <td>{{ $data->pemesanan->pelanggan->nama }}</td>
                                                        <td>{{ $data->pemesanan->pelanggan->user->email }}</td>
                                                        <td>{{ $data->pemesanan->pelanggan->no_hp }}</td>
                                                        <td>
                                                            Rp. {{ number_format($data->pemesanan->total_harga, 0, ',', '.') }},00
                                                        </td>
                                                        <td>{{ $data->tanggal_pembayaran }}</td>
                                                        <td class="text-center">
                                                            <a href="{{ asset('storage/'. $data->bukti_pembayaran) }}" class="btn btn-main review">
                                                                <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lihat Bukti"></i>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger" disabled>
                                                                {{ $data->pemesanan->status }}
                                                            </button>
                                                        </td>
                                                        <td>{{ $data->pemesanan->komentar }}</td>
                                                    </tr>
                                                @empty

                                                @endforelse
                                            </tbody>
                                        </table>
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
