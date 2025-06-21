@extends('layouts.master')
@section('title', 'Karyawan')
@section('title-content', 'Data Karyawan')
@push('styles')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Karyawan</h6>
                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i> Tambah
                    Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama</th>
                                <th>Divisi</th>
                                <th>Kontak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 1)
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ empty($user->department) ? '-' : $user->department->name }}</td>
                                    <td>{{ $user->nomor_telepon }}</td>
                                    <td>
                                        {{-- <a href="" class="btn btn-primary"><i class="fas fa-fw fa-eye"></i></a> --}}
                                        <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-warning"><i class="fas fa-fw fa-edit"></i></a>
                                        <button class="btn btn-danger delete-btn" data-id="{{ $user->id }}"><i class="fas fa-fw fa-trash"></i></button>
                                        <a onclick="updatePassword('{{ route('user.reset', ['id' => $user->id]) }}')" class="btn btn-secondary"><i class="fas fa-fw fa-key"></i></a>
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
@endsection
@push('script')
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
    <script>
        function updatePassword(routeUrl) {
            if (confirm('Apakah yakin mereset password ?')) {
                // User clicked "Yes"
                window.location.href = routeUrl;
            }
        }

        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var departmentId = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: "{{ route('user.index') }}/" + departmentId,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            alert(response.message);
                            location.reload();
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    });
                }
            });
        });
    </script>
@endpush
