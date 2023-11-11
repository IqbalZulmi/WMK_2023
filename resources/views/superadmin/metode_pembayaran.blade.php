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
            <h1>Metode Pembayaran</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('superadminDashboardPage') }}">Home</a></li>
                    <li class="breadcrumb-item">Kelola</li>
                    <li class="breadcrumb-item active">Metode Pembayaran</li>
                    </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Kelola Metode Pembayaran</h5>
                            <div class="d-flex justify-content-end mb-2">
                                <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#TambahModal">
                                    <i class="bi bi-plus-circle-fill"></i> Tambah Metode
                                </button>
                            </div>
                            <table class="table table-striped table-hover border table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Metode</th>
                                        <th scope="col">No Rekening</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Foto Ikon</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataMetode as $index => $data )
                                        <tr>
                                            <th>{{ $index+1 }}</th>
                                            <td>{{ $data->nama_metode }}</td>
                                            <td>{{ $data->no_rekening }}</td>
                                            <td>{{ $data->kategori }}</td>
                                            <td>
                                                <img src="{{ asset('storage/'.$data->foto) }}" alt="" width="50" height="40" class="object-fit-cover">
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                    <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#editModal{{ $index+1 }}">
                                                        <i class="bi bi-pen"></i> Edit
                                                    </button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $index+1 }}">
                                                        <i class="bi bi-trash3"></i> Hapus
                                                    </button>
                                                </div>
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
        </section>
    </main>

    <div class="modal fade" id="TambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah Metode</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tambahMetodePembayaran') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container-fluid">
                            <div class="row gy-2">
                                <div class="col-12">
                                    <label for="" class="mb-2">Nama Metode</label>
                                    <input name="nama_metode" type="text" class="form-control @error('nama_metode') is-invalid @enderror" value="{{ old('nama_metode') }}" required>
                                    @error('nama_metode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="mb-2">No Rekening</label>
                                    <input name="no_rekening" type="text" class="form-control @error('no_rekening') is-invalid @enderror" value="{{ old('no_rekening') }}" required>
                                    @error('no_rekening')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="mb-2">Kategori</label>
                                    <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                                        <option value="" selected disabled>Pilih Kategori</option>
                                        @foreach ($dataKategori as $index => $value )
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="mb-2">Foto Ikon</label>
                                    <input name="foto" type="file" class="form-control @error('foto') is-invalid @enderror" required>
                                    @error('foto')
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

    @foreach ($dataMetode as $index => $data )
        <div class="modal fade" id="editModal{{ $index+1 }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit Metode</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('editMetodePembayaran',['id_metode_pembayaran' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('put')
                            <div class="container-fluid">
                                <div class="row gy-2">
                                    <div class="col-12">
                                        <label for="" class="mb-2">Nama Metode</label>
                                        <input name="nama_metode" type="text" class="form-control @error('nama_metode') is-invalid @enderror" value="{{ old('nama_metode',$data->nama_metode) }}" required>
                                        @error('nama_metode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="mb-2">No Rekening</label>
                                        <input name="no_rekening" type="text" class="form-control @error('no_rekening') is-invalid @enderror" value="{{ old('no_rekening',$data->no_rekening) }}" required>
                                        @error('no_rekening')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="mb-2">Kategori</label>
                                        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                                            <option value="" disabled>Pilih Kategori</option>
                                            @foreach ($dataKategori as $key => $value )
                                                <option value="{{ $value }}"@if ($data->kategori == $value) selected @endif>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="mb-2">Foto Ikon</label>
                                        <input name="foto" type="file" class="form-control @error('foto') is-invalid @enderror">
                                        @error('foto')
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

        <div class="modal fade" id="hapusModal{{ $index+1 }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Hapus Metode Pembayaran</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-capitalize">
                            Apakah anda yakin ingin menghapus metode <span class="fw-bold text-danger">{{ $data->nama_metode }} ?</span>
                        </h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('hapusMetodePembayaran',['id_metode_pembayaran' => $data->id]) }}" method="POST">
                            @csrf @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
            </div>
            </div>
        </div>
    @endforeach

    @include('components.footer')
@endsection
