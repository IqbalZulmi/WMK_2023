@extends('html.html')

@section('content')

    @include('components.header')

    @include('components.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Lapangan dan Jadwal</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboardPage') }}">Home</a></li>
                    <li class="breadcrumb-item">Kelola</li>
                    <li class="breadcrumb-item active">Lapangan</li>
                    </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row mb-3">
                <div class="d-flex">
                    <button type="button" class="btn btn-main" data-bs-toggle="modal" data-bs-target="#tambahModal">
                        <i class="bi bi-plus-circle"></i> Tambah Lapangan
                    </button>
                </div>
            </div>
            <div class="row">
                @forelse ($dataLapangan as $index => $data)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ $data->foto_lapangan ? asset('storage/'.$data->foto_lapangan) : asset('assets/img/c7.jpg') }}" class="card-img-top object-fit-cover lapangan-img">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">{{ $data->nama_lapangan }}</h5>
                                <button type="button" class="btn btn-sm btn-main ms-auto" data-bs-toggle="modal" data-bs-target="#editLapanganModal{{ $data->id }}">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#hapusLapanganModal{{ $data->id }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                            <ul class="sidebar-nav">
                                <li class="nav-item">
                                    <a class="nav-link collapsed" data-bs-target="#jadwal{{ $index+1 }}" data-bs-toggle="collapse" href="#">
                                        <i class="bi bi-calendar-event"></i><span>Jadwal Lapangan</span><i class="bi bi-chevron-down ms-auto"></i>
                                    </a>
                                    <ul id="jadwal{{ $index+1 }}" class="nav-content collapse list-group" data-bs-parent="#sidebar-nav">
                                        @foreach ($data->jadwal_lapangan as $indexJadwal => $dataJadwal )
                                            <li class="list-group-item p-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    {{ $dataJadwal->jam_mulai }} - {{ $dataJadwal->jam_selesai }}
                                                    <button type="button" class="btn btn-sm btn-main ms-auto" data-bs-toggle="modal" data-bs-target="#editJadwalModal{{ $dataJadwal->id }}">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#hapusJadwalModal{{ $dataJadwal->id }}">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </div>
                                                <div class="fw-semibold">
                                                    Rp. {{ number_format($dataJadwal->harga, 0, ',', '.') }},00
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <img src="" alt="">
                    <p>tidak ada data lapangan</p>
                </div>
                @endforelse
            </div>
        </section>
    </main>

    <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah Lapangan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tambahLapangan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="inputBusinessName" class="form-label">Nama Lapangan</label>
                                    <input name="nama_lapangan" type="text" class="form-control @error('nama_lapangan') is-invalid @enderror" placeholder="Masukkan Nama Lapangan" value="{{ old('nama_lapangan') }}" required>
                                    @error('nama_lapangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputBusinessName" class="form-label">Jenis Lapangan</label>
                                    <select name="jenis_lapangan" class="form-select @error('jenis_lapangan') is-invalid @enderror" required>
                                        <option value="" disabled selected>Pilih jenis lapangan</option>
                                        @foreach ($jenisLapangan as $index => $data )
                                            <option value="{{ $data->id }}">{{ $data->jenis_lapangan }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_lapangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputBusinessName" class="form-label">Harga Lapangan per jam</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp.</span>
                                        <input name="harga_lapangan" type="text" class="form-control @error('harga_lapangan') is-invalid @enderror" placeholder="Masukkan harga per jam" value="{{ old('harga_lapangan') }}" required>
                                        @error('harga_lapangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputBusinessName" class="form-label">Foto Lapangan</label>
                                    <input name="foto_lapangan" type="file" class="form-control @error('foto_lapangan') is-invalid @enderror" required>
                                    @error('foto_lapangan')
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

    @foreach ($dataLapangan as $index => $dataModal )
        <div class="modal fade" id="editLapanganModal{{ $dataModal->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Tambah Lapangan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tambahLapangan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="inputBusinessName" class="form-label">Nama Lapangan</label>
                                        <input name="nama_lapangan" type="text" class="form-control @error('nama_lapangan') is-invalid @enderror" placeholder="Masukkan Nama Lapangan" value="{{ old('nama_lapangan') }}" required>
                                        @error('nama_lapangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputBusinessName" class="form-label">Jenis Lapangan</label>
                                        <select name="jenis_lapangan" class="form-select @error('jenis_lapangan') is-invalid @enderror" required>
                                            <option value="" disabled selected>Pilih jenis lapangan</option>
                                            @foreach ($jenisLapangan as $index => $data )
                                                <option value="{{ $data->id }}">{{ $data->jenis_lapangan }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenis_lapangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputBusinessName" class="form-label">Harga Lapangan per jam</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp.</span>
                                            <input name="harga_lapangan" type="text" class="form-control @error('harga_lapangan') is-invalid @enderror" placeholder="Masukkan harga per jam" value="{{ old('harga_lapangan') }}" required>
                                            @error('harga_lapangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputBusinessName" class="form-label">Foto Lapangan</label>
                                        <input name="foto_lapangan" type="file" class="form-control @error('foto_lapangan') is-invalid @enderror" required>
                                        @error('foto_lapangan')
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

        <div class="modal fade" id="hapusLapanganModal{{ $dataModal->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Tambah Lapangan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-capitalize">
                            Apakah anda yakin ingin menghapus <span class="fw-bold text-danger">{{ $dataModal->nama_lapangan }} ?</span>
                        </h4>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="">
                            <button type="submit" class="btn btn-main">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @include('components.footer')
@endsection
