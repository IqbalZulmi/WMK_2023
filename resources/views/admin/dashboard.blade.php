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
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminDashboardPage') }}">Home</a></li>
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
                                    <h5 class="card-title">Akun Penyedia yang belum aktif</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person-fill-lock"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $dataPenyedia->count() }}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-1">
                                        <a href="#kelola-penyedia" class="btn btn-main">Kelola Penyedia <i class="bi bi-pencil-square"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Penarikan yang belum divalidasi</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cash-coin"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $dataPenarikan->count() }}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-1">
                                        <a href="{{ route('penarikanPage') }}" class="btn btn-main">Kelola Penarikan <i class="bi bi-pencil-square"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Pemesanan yang belum divalidasi</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart3"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $dataPemesanan->count() }}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-1">
                                        <a href="{{ route('jenisLapangan') }}" class="btn btn-main">Kelola Pemesanan <i class="bi bi-pencil-square"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12" id="kelola-penyedia">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Kelola Penyedia</h5>
                                    <table class="table table-striped table-hover border table-bordered align-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Logo Bisnis</th>
                                                <th scope="col">Nama Bisnis</th>
                                                <th scope="col">Alamat</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Nomor handphone</th>
                                                <th scope="col">Jam Buka</th>
                                                <th scope="col">Jam Tutup</th>
                                                <th scope="col">Status Akun</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($dataPenyedia as $index => $data )
                                                <tr>
                                                    <th>{{ $index+1 }}</th>
                                                    <td>
                                                        <img src="{{ asset('storage/'.$data->penyedia->foto) }}" alt="" class="table-img">
                                                    </td>
                                                    <td>{{ $data->penyedia->nama_bisnis }}</td>
                                                    <td>{{ $data->penyedia->alamat }}</td>
                                                    <td>{{ $data->email }}</td>
                                                    <td>{{ $data->penyedia->no_hp }}</td>
                                                    <td>{{ $data->penyedia->jam_buka }}</td>
                                                    <td>{{ $data->penyedia->jam_tutup }}</td>
                                                    <td>
                                                        <span class="btn btn-sm disabled {{ $data->status == 'aktif' ? 'text-bg-success' : 'text-bg-danger' }}">{{ $data->status }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                            <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#editModal{{ $index+1 }}">
                                                                <i class="bi bi-pen"></i> Edit
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="100%" class="text-center">Tidak Ada Data Untuk Ditampilkan!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @foreach ($dataPenyedia as $index => $data )
        <div class="modal fade" id="editModal{{ $index+1 }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit Status</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('editStatusPenyedia',['id_user' => $data->id ]) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('put')
                            <div class="container-fluid">
                                <div class="row gy-2">
                                    <div class="col-12">
                                        <label for="" class="mb-2">Status</label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                            <option value="aktif" {{ $data->status == 'aktif' ? 'selected' : '' }}>aktif</option>
                                            <option value="belum aktif" {{ $data->status == 'belum aktif' ? 'selected' : '' }}>belum aktif</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-main">Simpan</button>
                        </form>
                    </div>
            </div>
            </div>
        </div>
    @endforeach

    @include('components.footer')
@endsection
