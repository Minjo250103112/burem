@extends('layouts.master')
@section('title', 'Layanan')
@section('title-content', 'Layanan')
@push('styles')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Layanan</h6>
                <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#packageModal"
                    id="createPackageBtn"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Nama Layanan</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 1)
                            @forelse ($packages as $package)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $package->code }}</td>
                                <td>{{ $package->name }}</td>
                                <td>{{ $package->price }}</td>
                                <td>{{ $package->description }}</td>
                                <td>
                                    <button data-id="{{ $package->id }}" class="btn btn-warning edit-btn"><i class="fas fa-fw fa-edit"></i></button>
                                    <button data-id="{{ $package->id }}" class="btn btn-danger delete-btn"><i class="fas fa-fw fa-trash"></i></button>
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

    <!-- Modal -->
    <div class="modal fade" id="packageModal" tabindex="-1" role="dialog" aria-labelledby="packageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="packageModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="packageForm">
                    @csrf
                    <input type="hidden" id="method" name="_method" value="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputAddress">Kode</label>
                            <input type="text" class="form-control" id="code" placeholder="Masukkkan kode layanan.."
                                name="code" required>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Nama Layanan</label>
                            <input type="text" class="form-control" id="name" placeholder="Masukkkan nama layanan.."
                                name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Harga</label>
                            <input type="text" class="form-control" id="price" placeholder="Masukkkan harga layanan.."
                                name="price" required>
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

            $('#createPackageBtn').click(function() {
                $('#packageForm')[0].reset();
                $('#packageForm').attr('action', "{{ route('package.store') }}");
                $('#method').val('POST');
                $('#packageModalLabel').text('Tambah Layanan');
                $('#formErrors').hide();
            });

            $('.edit-btn').click(function() {
                var packageId = $(this).data('id');
                $.get("{{ route('package.index') }}/" + packageId + "/edit", function(data) {
                    $('#code').val(data.code);
                    $('#name').val(data.name);
                    $('#price').val(data.price);
                    $('#description').val(data.description);
                    $('#packageForm').attr('action', "{{ route('package.index') }}/" + packageId);
                    $('#method').val('PUT');
                    $('#packageModalLabel').text('Edit Layanan');
                    $('#formErrors').hide();
                    $('#packageModal').modal('show');
                });
            });

            $('.delete-btn').click(function() {
                var packageId = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: "{{ route('package.index') }}/" + packageId,
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

            $('#packageForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var url = $(this).attr('action');
                var method = $('#method').val();

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function(response) {
                        $('#packageModal').modal('hide');
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
