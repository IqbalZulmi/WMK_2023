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
@endpush

@section('content')

    @include('components.header')

    @include('components.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Riwayat Pemesanan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboardPage') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">Riwayat</li>
                    <li class="breadcrumb-item active">Pemesanan Lapangan</li>
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
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#draft">Belum Dibayar Pelanggan</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pending">Belum Divalidasi Admin</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#berhasil">Berhasil</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="draft">
                                    <div class="alert alert-info d-flex align-items-center" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-info-circle flex-shrink-0 me-2" viewBox="0 0 16 16" style="height: 1em; width: 1em; vertical-align: -0.125em;" role="img" aria-label="Warning:">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                        </svg>
                                        <div style="font-size: 10pt">
                                            Pemesanan yang belum dilunasi akan otomatis dibatalkan dalam waktu 10 menit. Status lapangan sementara akan menjadi "Sedang Dipesan" dan kembali "Tersedia" jika dibatalkan oleh sistem. Cek ketersediaan di halaman <a href="{{ route('lapanganPage') }}" class="alert-link">Jadwal Lapangan</a>.
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover border table-bordered align-middle">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama Pemesan</th>
                                                    <th scope="col">Nama Lapangan</th>
                                                    <th scope="col">Jam Mulai</th>
                                                    <th scope="col">Jam Selesai</th>
                                                    <th scope="col">Tanggal Pemesanan</th>
                                                    <th scope="col">Total Harga</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($dataDraft as $index => $data )
                                                    <tr>
                                                        <td>{{ $index+1 }}</td>
                                                        <td>{{ $data->pelanggan->nama }}</td>
                                                        <td>{{ $data->lapangan->nama_lapangan }}</td>
                                                        <td>{{ $data->jadwal_lapangan->jam_mulai }}</td>
                                                        <td>{{ $data->jadwal_lapangan->jam_selesai }}</td>
                                                        <td>{{ $data->tanggal_pemesanan }}</td>
                                                        <td>{{ $data->total_harga }}</td>
                                                        <td>
                                                            <button class="btn btn-info text-white" disabled>{{ $data->status }}</button>
                                                        </td>
                                                    </tr>
                                                @empty

                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade profile-overview" id="pending">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover border table-bordered align-middle">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama Pemesan</th>
                                                    <th scope="col">Nama Lapangan</th>
                                                    <th scope="col">Jam Mulai</th>
                                                    <th scope="col">Jam Selesai</th>
                                                    <th scope="col">Tanggal Pemesanan</th>
                                                    <th scope="col">Total Harga</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($dataPending as $index => $data )
                                                    <tr>
                                                        <td>{{ $index+1 }}</td>
                                                        <td>{{ $data->pelanggan->nama }}</td>
                                                        <td>{{ $data->lapangan->nama_lapangan }}</td>
                                                        <td>{{ $data->jadwal_lapangan->jam_mulai }}</td>
                                                        <td>{{ $data->jadwal_lapangan->jam_selesai }}</td>
                                                        <td>{{ $data->tanggal_pemesanan }}</td>
                                                        <td>{{ $data->total_harga }}</td>
                                                        <td>
                                                            <button class="btn btn-warning" disabled>{{ $data->status }}</button>
                                                        </td>
                                                    </tr>
                                                @empty

                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade profile-edit" id="berhasil">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover border table-bordered align-middle">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama Pemesan</th>
                                                    <th scope="col">Nomor Hp</th>
                                                    <th scope="col">Nama Lapangan</th>
                                                    <th scope="col">Jam Mulai</th>
                                                    <th scope="col">Jam Selesai</th>
                                                    <th scope="col">Tanggal Pemesanan</th>
                                                    <th scope="col">Total Harga</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($dataBerhasil as $index => $data )
                                                    <tr>
                                                        <td>{{ $index+1 }}</td>
                                                        <td>{{ $data->pelanggan->nama }}</td>
                                                        <td>{{ $data->pelanggan->no_hp }}</td>
                                                        <td>{{ $data->lapangan->nama_lapangan }}</td>
                                                        <td>{{ $data->jadwal_lapangan->jam_mulai }}</td>
                                                        <td>{{ $data->jadwal_lapangan->jam_selesai }}</td>
                                                        <td>{{ $data->tanggal_pemesanan }}</td>
                                                        <td>{{ $data->total_harga }}</td>
                                                        <td>
                                                            <button class="btn btn-success" disabled>{{ $data->status }}</button>
                                                        </td>
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
