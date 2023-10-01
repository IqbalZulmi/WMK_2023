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
            <h1>Daftar Bank</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('superadminDashboardPage') }}">Home</a></li>
                    <li class="breadcrumb-item">Validasi</li>
                    <li class="breadcrumb-item active">Penarikan</li>
                    </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Validasi Penarikan</h5>
                            <table class="table table-striped table-hover border table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Bisnis</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">No Handphone</th>
                                        <th scope="col">Total Saldo</th>
                                        <th scope="col">Nama Bank</th>
                                        <th scope="col">No Rekening</th>
                                        <th scope="col">Nama Rekening</th>
                                        <th scope="col">Jumlah Penarikan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataPenarikan as $index => $data )
                                        <tr>
                                            <th>{{ $index+1 }}</th>
                                            <td>{{ $data->penyedia->nama_bisnis }}</td>
                                            <td>{{ $data->penyedia->user->email }}</td>
                                            <td>{{ $data->penyedia->no_hp }}</td>
                                            <td>{{ $data->penyedia->lapangan->pemesanan->sum('total_harga')->where('status','berhasil') - $data->sum('jumlah_penarikan')->where('status','selesai') }}</td>
                                            <td>{{ $data->penyedia->rekening->daftar_bank->nama_bank }}</td>
                                            <td>{{ $data->penyedia->rekening->no_rekening }}</td>
                                            <td>{{ $data->penyedia->rekening->nama_rekening }}</td>
                                            <td>{{ $data->jumlah_penarikan }}</td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                    <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#validasiModal{{ $index+1 }}">
                                                        <i class="bi bi-pen"></i> Edit
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

    @foreach ($dataPenarikan as $index => $data )
        <div class="modal fade" id="validasiModal{{ $index+1 }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Validasi Penarikan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('editDaftarBank',['kode_bank' => $data->kode_bank]) }}" method="POST">
                            @csrf @method('put')
                            <div class="container-fluid">
                                <div class="row gy-2">
                                    <input type="hidden" name="old_kode_bank" value="{{ $data->kode_bank }}">
                                    <div class="col-12">
                                        <label for="" class="mb-2">Kode Bank</label>
                                        <input name="kode_bank" type="text" class="form-control @error('kode_bank') is-invalid @enderror" value="{{ old('kode_bank', $data->kode_bank) }}" required>
                                        @error('kode_bank')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="mb-2">Nama Bank</label>
                                        <input name="nama_bank" type="text" class="form-control @error('nama_bank') is-invalid @enderror" value="{{ old('nama_bank', $data->nama_bank) }}" required>
                                        @error('nama_bank')
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
