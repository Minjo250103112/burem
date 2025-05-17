@extends('layouts.master')
@section('title', 'Pelanggan')
@section('title-content', 'Data Pelanggan')
@push('styles')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama</th>
                                <th>Instansi</th>
                                <th>Paket</th>
                                <th>Kontak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 1)
                            @forelse ($customers as $customer)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    <a href="" class="btn btn-primary"><i class="fas fa-fw fa-eye"></i></a>
                                    <a href="" class="btn btn-warning"><i class="fas fa-fw fa-edit"></i></a>
                                    <a href="" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td rowspan="6">Data tidak ada.</td>
                            </tr>
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
<script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
@endpush
