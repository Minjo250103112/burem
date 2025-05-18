@extends('layouts.master')
@section('title', 'Riwayat Laporan')
@section('title-content', 'Riwayat Laporan')
@push('styles')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Laporan</h6>
                <a href="{{ route('ticket.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Divisi</th>
                                <th>Subjek</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tickets as $ticket)
                            <tr onclick="window.location='{{ route('ticket.show', $ticket->code) }}'" style="cursor: pointer;">
                                <td>{{ $ticket->code }}</td>
                                <td>{{ $ticket->department->name }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td><span class="badge badge-{{ $ticket->status == 1 ? 'success' : 'secondary' }}">{{ $ticket->status == 1 ? 'Dibuka' : 'Ditutup' }}</span></td>
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
<script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
@endpush
