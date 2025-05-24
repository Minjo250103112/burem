@extends('layouts.master')
@section('title', 'Detail Pelanggan')
@section('title-content', 'Detail Pelanggan')
@push('styles')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Data Pelanggan</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="inputAddress">Nama</label>
                    <input type="text" name="id" id="id" value="{{ $customer->id }}" hidden>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan nama.." name="name"
                        value="{{ $customer->name }}" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Instansi</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan instansi.."
                        name="agency" value="{{ $customer->agency }}" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Email</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan email.."
                        name="email" value="{{ $customer->email }}" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Telepon</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan telepon.."
                        name="phone" value="{{ $customer->phone }}" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Alamat</label>
                    <textarea class="form-control" id="content" rows="4" name="address" required>{{ $customer->address }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Paket Langganan</h6>
                <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#packageModal"
                    id="createPackageBtn"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Domain</th>
                                <th>Paket</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 1)
                            @forelse ($package_customers as $package_customer)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $package_customer->domain }}</td>
                                <td>{{ $package_customer->package->name }}</td>
                                <td>{{ $package_customer->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <button class="btn btn-warning edit-btn" data-id="{{ $package_customer->id }}"><i class="fas fa-fw fa-edit"></i></button>
                                    <button class="btn btn-danger delete-btn" data-id="{{ $package_customer->id }}"><i class="fas fa-fw fa-trash"></i></button>
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
                            <label for="inputAddress">Domain</label>
                            <input type="text" name="customer_id" id="customer_id" value="{{ $customer->id }}" hidden>
                            <input type="text" class="form-control" id="domain" placeholder="Masukkkan domain.."
                                name="domain" required>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Layanan</label>
                            <select name="package_id" id="package_id" class="form-control" required>
                                <option value="">Pilih Layanan</option>
                                @forelse ($packages as $package)
                                <option value="{{ $package->id }}">{{ $package->name }}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                            </select>
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
            $('#customer_id').val("{{ $customer->id }}");
            $('#packageForm').attr('action', "{{ route('customer.store-package') }}");
            $('#method').val('POST');
            $('#packageModalLabel').text('Tambah Layanan Pelanggan');
            $('#formErrors').hide();
        });

        $('.edit-btn').click(function() {
            var packageId = $(this).data('id');
            $.get("{{ route('customer.index') }}/package/detail/" + packageId + "", function(data) {
                $('#customer_id').val(data.customer_id);
                $('#package_id').val(data.package_id);
                $('#domain').val(data.domain);
                $('#status').val(data.status);
                $('#packageForm').attr('action', "{{ route('customer.index') }}/package/" + packageId);
                $('#method').val('PUT');
                $('#packageModalLabel').text('Edit Layanan Pelanggan');
                $('#formErrors').hide();
                $('#packageModal').modal('show');
            });
        });

        $('.delete-btn').click(function() {
                var packageId = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: "{{ route('customer.index') }}/package/" + packageId,
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
