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
                    <li class="breadcrumb-item"><a href="{{ route('superadminDashboardPage') }}">Home</a></li>
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
                                    <h5 class="card-title">Admin Terdaftar</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person-fill-lock"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $dataAdmin->count() }}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-1">
                                        <a href="#kelola-admin" class="btn btn-main">Kelola Admin <i class="bi bi-pencil-square"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Daftar Bank</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-bank2"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $daftarBank->count() }}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-1">
                                        <a href="" class="btn btn-main">Kelola Daftar Bank <i class="bi bi-pencil-square"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Jenis Lapangan</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-football-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $dataLapangan->count() }}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-1">
                                        <a href="" class="btn btn-main">Kelola Jenis Lapangan <i class="bi bi-pencil-square"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12" id="kelola-admin">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Kelola Admin</h5>
                                    <div class="d-flex justify-content-end mb-2">
                                        <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#TambahModal">
                                            <i class="bi bi-plus-circle-fill"></i> Tambah Admin
                                        </button>
                                    </div>
                                    <table class="table table-striped table-hover border table-bordered align-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Nomor handphone</th>
                                                <th scope="col">Status Akun</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($dataAdmin as $index => $data )
                                                <tr>
                                                    <th>{{ $index+1 }}</th>
                                                    <td>{{ $data->nama }}</td>
                                                    <td>{{ $data->user->email }}</td>
                                                    <td>{{ $data->no_hp }}</td>
                                                    <td>
                                                        <span class="btn btn-sm disabled {{ $data->user->status == 'aktif' ? 'text-bg-success' : 'text-bg-danger' }}">{{ $data->user->status }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                            <button class="btn btn-main">
                                                                <i class="bi bi-pen"></i> Edit
                                                            </button>
                                                            <button class="btn btn-danger">
                                                                <i class="bi bi-trash3"></i> Hapus
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="100%">Tidak Ada Data Untuk Ditampilkan!</td>
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

    <div class="modal fade" id="TambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Understood</button>
            </div>
          </div>
        </div>
    </div>

    @include('components.footer')
@endsection
