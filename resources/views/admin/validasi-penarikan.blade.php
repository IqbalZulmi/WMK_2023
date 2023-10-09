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
        function formatInput(input) {
            // Menghapus semua karakter selain angka
            let value = input.value.replace(/\D/g, '');

            // Menggunakan fungsi toLocaleString() untuk menampilkan format ribuan
            input.value = parseInt(value).toLocaleString();
        }

        function formatValue(input) {
            // Menghapus semua karakter selain angka
            let value = input.value.replace(/\D/g, '');

            // Menghilangkan format ribuan saat input kehilangan fokus
            input.value = value;
        }
    </script>

    <script>
        $(document).ready(function () {
            // Saat halaman dimuat, sembunyikan label dan input bukti pembayaran
            $('label[for="bukti_pembayaran"]').hide();
            $('input[name="bukti_pembayaran"]').hide();

            // Saat halaman dimuat, tampilkan label dan input komentar
            $('label[for="komentar"]').hide();
            $('textarea[name="komentar"]').hide();

            // Ketika dropdown "Status Verifikasi" berubah
            $('select[name="status"]').change(function () {
                var selectedStatus = $(this).val();

                if (selectedStatus === 'selesai') {
                    // Jika status "Selesai" dipilih, tampilkan label dan input bukti pembayaran, dan sembunyikan label dan input komentar
                    $('label[for="bukti_pembayaran"]').show();
                    $('input[name="bukti_pembayaran"]').show();
                    $('label[for="komentar"]').hide();
                    $('textarea[name="komentar"]').hide();
                } else if (selectedStatus === 'ditolak') {
                    // Jika status "Tolak" dipilih, sembunyikan label dan input bukti pembayaran, dan tampilkan label dan input komentar
                    $('label[for="bukti_pembayaran"]').hide();
                    $('input[name="bukti_pembayaran"]').hide();
                    $('label[for="komentar"]').show();
                    $('textarea[name="komentar"]').show();
                } else {
                    // Jika tidak ada yang dipilih, kembalikan ke keadaan awal
                    $('label[for="bukti_pembayaran"]').hide();
                    $('input[name="bukti_pembayaran"]').hide();
                    $('label[for="komentar"]').hide();
                    $('textarea[name="komentar"]').hide();
                }
            });
        });
    </script>
@endpush

@section('content')

    @include('components.header')

    @include('components.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Validasi Penarikan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminDashboardPage') }}">Home</a></li>
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
                                            <td>
                                                @if(isset($totalSaldos[$data->penyedia->id]))
                                                    Rp. {{ number_format($totalSaldos[$data->penyedia->id], 0, ',', '.') }},00
                                                @endif
                                            </td>
                                            <td>{{ $data->penyedia->rekening->daftar_bank->nama_bank }}</td>
                                            <td>{{ $data->penyedia->rekening->no_rekening }}</td>
                                            <td>{{ $data->penyedia->rekening->nama_rekening }}</td>
                                            <td>Rp. {{ number_format($data->jumlah_penarikan, 0, ',', '.') }},00</td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                    <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#validasiModal{{ $index+1 }}">
                                                        <i class="bi bi-pen" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Validasi"></i>
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
                        <form action="{{ route('validasiPenarikan',['id_penarikan' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('put')
                            <div class="container-fluid">
                                <div class="row gy-2">
                                    <div class="col-12">
                                        <label for="" class="form-label mb-2">Nama Bisnis</label>
                                        <input name="nama_bisnis" type="text" class="form-control @error('nama_bisnis') is-invalid @enderror" value="{{ old('nama_bisnis',$data->penyedia->nama_bisnis) }}" disabled>
                                        @error('nama_bisnis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="form-label mb-2">Bank</label>
                                        <input name="bank" type="text" class="form-control @error('bank') is-invalid @enderror" value="{{ $data->penyedia->rekening->daftar_bank->nama_bank }}" disabled>
                                        @error('bank')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="form-label mb-2">Nomor Rekening</label>
                                        <input name="no_rekening" type="text" class="form-control @error('no_rekening') is-invalid @enderror" value="{{ $data->penyedia->rekening->no_rekening }}" disabled>
                                        @error('no_rekening')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="form-label mb-2">Nama Rekening</label>
                                        <input name="nama_rekening" type="text" class="form-control @error('nama_rekening') is-invalid @enderror" value="{{ $data->penyedia->rekening->nama_rekening }}" disabled>
                                        @error('nama_rekening')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if(isset($totalSaldos[$data->penyedia->id]))
                                        <div class="col-12">
                                            <label for="inputBusinessName" class="form-label">Total Saldo</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp.</span>
                                                <input name="total_saldo" type="text" class="form-control @error('total_saldo') is-invalid @enderror" onkeyup="formatInput(this)" onblur="formatValue(this)" value="{{ old('total_saldo',$totalSaldos[$data->penyedia->id]) }}" readonly>
                                                @error('total_saldo')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <span class="input-group-text">,00</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12">
                                        <label for="inputBusinessName" class="form-label">Jumlah Penarikan</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp.</span>
                                            <input name="jumlah_penarikan" type="text" class="form-control @error('jumlah_penarikan') is-invalid @enderror" onkeyup="formatInput(this)" onblur="formatValue(this)" placeholder="Masukkan harga per jam" value="{{ old('jumlah_penarikan',$data->jumlah_penarikan) }}" readonly>
                                            @error('jumlah_penarikan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <span class="input-group-text">,00</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="form-label mb-2">Status Verifikasi</label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                                            <option value="" disabled selected>Pilih Status</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="ditolak">Tolak</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="bukti_pembayaran" class="form-label mb-2">Bukti Pembayaran</label>
                                        <input name="bukti_pembayaran" type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror">
                                        @error('bukti_pembayaran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="komentar" class="form-label mb-2">Komentar</label>
                                        <textarea name="komentar" rows="4" class="form-control @error('komentar') is-invalid @enderror" placeholder="Isikan alasan mengapa anda menolak penarikan ini !"></textarea>
                                        @error('komentar')
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
