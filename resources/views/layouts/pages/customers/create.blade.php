@extends('layouts.master')
@section('title', 'Buat Laporan')
@section('title-content', 'Buat Laporan')
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
                        <input type="text" hidden name="customer_id" value="{{ Auth::guard('customer')->user()->id }}">
                        <input type="text" class="form-control" id="inputname" name="name" value="{{ Auth::guard('customer')->user()->name }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputemail">Email</label>
                        <input type="text" class="form-control" id="inputemail" name="email" value="{{ Auth::guard('customer')->user()->email }}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputdivisi">Divisi</label>
                        <select class="form-control" name="department_id" required>
                            <option value="" selected disabled>---Pilih Divisi---</option>
                            @forelse ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->code }} | {{ $department->name }}</option>
                            @empty
                                <option value=""></option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputemail">Layanan</label>
                        <select class="form-control" name="package_id" required>
                            <option value="" selected disabled>---Pilih Layanan---</option>
                            @forelse ($packages as $package)
                                <option value="{{ $package->id }}">{{ $package->package->code }} | {{ $package->package->name }}</option>
                            @empty
                                <option value=""></option>
                            @endforelse
                        </select>
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label for="inputemail">Prioritas</label>
                        <select class="form-control" name="priority" required>
                            <option value="" selected disabled>---Pilih Prioritas---</option>
                            <option value="1">Rendah</option>
                            <option value="2">Sedang</option>
                            <option value="3">Tinggi</option>
                        </select>
                    </div> --}}
                </div>
                <div class="form-group">
                    <label for="inputAddress">Subjek</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan Subjek.." name="subject" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Pesan</label>
                    <textarea  class="form-control" id="content" rows="3" name="content" required></textarea>
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
