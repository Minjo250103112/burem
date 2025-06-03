@extends('layouts.master')
@section('title', 'Laporan')
@section('title-content', 'Laporan')
@push('styles')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
                <div class="row" id="myForm">
                    {{-- <div > --}}
                    <div class="col-md-5 mr-1">
                        <div class="form-group row">
                            <select name="bulan" id="bulan" class="form-control">
                                <option value="">-- Pilih Bulan --</option>
                                @forelse ($bulans as $bulan)
                                    <option value="{{ $bulan['no'] }}" {{ $getbulan === $bulan['no'] ? 'selected' : '' }}>
                                        {{ $bulan['nama'] }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mr-1">
                        <div class="form-group row">
                            <select name="tahun" id="tahun" class="form-control">
                                <option value="">-- Pilih Tahun --</option>
                                @forelse ($tahuns as $tahun)
                                    <option value="{{ $tahun }}" {{ $gettahun == $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <button type="submit" class="btn btn-primary" onclick="submitForm()"><i
                                    class="fas fa-fw fa-search"></i></button>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jml. Pelanggan</th>
                                <th>Jml. Laporan</th>
                                <th>Laporan Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $item['tanggal'] }}</td>
                                    <td>{{ $item['customers'] }}</td>
                                    <td>{{ $item['tickets'] }}</td>
                                    <td>{{ $item['done'] }}</td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "pageLength": 50, // Jumlah data per halaman
                "lengthMenu": [5, 10, 25, 50, 100], // Pilihan jumlah data per halaman
                "paging": true
            });
        });

        function submitForm() {
            var bulan = document.getElementById('bulan').value;
            var tahun = document.getElementById('tahun').value;

            window.location.href = `report?bulan=${bulan}&tahun=${tahun}`;
        }
    </script>
@endpush
