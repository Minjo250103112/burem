@extends('layouts.master')
@section('title', 'Buat Laporan')
@section('title-content', 'Buat Laporan')
@push('styles')
    <style>
        .custom-radio-group {
            border: none;
            /* Hilangkan border */
            text-align: justify;
            /* Rata kanan kiri */
        }
    </style>
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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Buat Laporan</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputname">Nama</label>
                        <input type="text" hidden name="admin" value="{{ $customer->id }}">
                        <input type="text" hidden name="customer_id" value="{{ $customer->id }}">
                        <input type="text" class="form-control" id="inputname" name="name"
                            value="{{ $customer->name }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputemail">Email</label>
                        <input type="text" class="form-control" id="inputemail" name="email"
                            value="{{ $customer->email }}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputdivisi">Divisi</label>
                        <select class="form-control" name="department_id" required>
                            <option value="" selected disabled>---Pilih Divisi---</option>
                            @forelse ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->code }} | {{ $department->name }}
                                </option>
                            @empty
                                <option value=""></option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputemail">Layanan</label>
                        <select class="form-control" name="package_id" required>
                            <option value="" selected disabled>---Pilih Layanan---</option>
                            @forelse ($customer->packages as $package)
                                <option value="{{ $package->package_id }}">{{ $package->package->code }} |
                                    {{ $package->package->name }}</option>
                            @empty
                                <option value=""></option>
                            @endforelse
                        </select>
                    </div>                                          
                    <div class="form-group col-md-4">
                        <label for="inputemail">Prioritas</label>
                        <div class="custom-radio-group px-3 py-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="priority" id="inlineRadio1"
                                    value="1">
                                <label class="form-check-label" for="inlineRadio1">Rendah</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="priority" id="inlineRadio2"
                                    value="2">
                                <label class="form-check-label" for="inlineRadio2">Sedang</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="priority" id="inlineRadio3"
                                    value="3">
                                <label class="form-check-label" for="inlineRadio3">Tinggi</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label for="inputAddress">Subjek</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan Subjek.."
                        name="subject" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Pesan</label>
                    <textarea class="form-control" id="content" rows="3" name="content" required></textarea>
                </div>
                <div class="form-group">
                    <label for="inputAddress">File</label>
                    <input type="file" class="form-control" id="inputfile" placeholder="Unggah berkas.." name="file">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection
