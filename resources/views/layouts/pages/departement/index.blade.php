@extends('layouts.master')
@section('title', 'Divisi')
@section('title-content', 'Divisi')
@push('styles')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Divisi</h6>
                <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#departmentModal"
                    id="createDepartmentBtn"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 10%">No.</th>
                                <th style="width: 15%">Kode</th>
                                <th style="width: 25%">Nama Divisi</th>
                                <th style="width: 35%">Deskripsi</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 1)
                            @forelse ($departments as $department)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $department->code }}</td>
                                    <td>{{ $department->name }}</td>
                                    <td>{{ $department->description }}</td>
                                    <td>
                                        <button class="btn btn-warning edit-btn" data-id="{{ $department->id }}"><i class="fas fa-fw fa-edit"></i></button>
                                        <button class="btn btn-danger delete-btn" data-id="{{ $department->id }}"><i class="fas fa-fw fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <td rowspan="5">Data tidak ada.</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="departmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="departmentModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="departmentForm">
                    @csrf
                    <input type="hidden" id="method" name="_method" value="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputAddress">Kode</label>
                            <input type="text" class="form-control" id="code" placeholder="Masukkkan kode divisi.."
                                name="code" required>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Nama Divisi</label>
                            <input type="text" class="form-control" id="name" placeholder="Masukkkan nama divisi.."
                                name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Deskripsi</label>
                            <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('#dataTable').DataTable();

            $('#createDepartmentBtn').click(function() {
                $('#departmentForm')[0].reset();
                $('#departmentForm').attr('action', "{{ route('departement.store') }}");
                $('#method').val('POST');
                $('#departmentModalLabel').text('Tambah Divisi');
                $('#formErrors').hide();
            });

            $('.edit-btn').click(function() {
                var departmentId = $(this).data('id');
                $.get("{{ route('departement.index') }}/" + departmentId + "/edit", function(data) {
                    $('#code').val(data.code);
                    $('#name').val(data.name);
                    $('#description').val(data.description);
                    $('#departmentForm').attr('action', "{{ route('departement.index') }}/" + departmentId);
                    $('#method').val('PUT');
                    $('#departmentModalLabel').text('Edit Divisi');
                    $('#formErrors').hide();
                    $('#departmentModal').modal('show');
                });
            });

            $('.delete-btn').click(function() {
                var departmentId = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: "{{ route('departement.index') }}/" + departmentId,
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

            $('#departmentForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var url = $(this).attr('action');
                var method = $('#method').val();

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function(response) {
                        $('#form-department').modal('hide');
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorHtml = '';

                        $.each(errors, function(key, value) {
                            errorHtml += '<p>' + value + '</p>';
                        });

                        $('#formErrors').html(errorHtml).show();
                    }
                });
            });
        });
    </script>
@endpush
