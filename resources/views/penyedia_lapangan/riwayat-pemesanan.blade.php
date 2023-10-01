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
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pending">Pending</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#berhasil">Berhasil</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="pending">
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
