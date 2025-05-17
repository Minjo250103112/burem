@extends('layouts.master')
@section('title', 'Buat Laporan')
@section('title-content', 'Buat Laporan')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Buat Laporan</h6>
        </div>
        <div class="card-body">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputname">Nama</label>
                        <input type="text" hidden name="id" value="{{ Auth::guard('customer')->user()->id }}" disabled>
                        <input type="text" class="form-control" id="inputname" name="name" value="{{ Auth::guard('customer')->user()->name }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputemail">Email</label>
                        <input type="text" class="form-control" id="inputemail" name="email" value="{{ Auth::guard('customer')->user()->email }}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputdivisi">Divisi</label>
                        <select class="form-control" name="departement">
                            <option value="" selected disabled>---Pilih Divisi---</option>
                            @forelse ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->code }} | {{ $department->name }}</option>
                            @empty
                                <option value="">Support</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputemail">Layanan</label>
                        <select class="form-control" name="package">
                            <option value="" selected disabled>---Pilih Layanan---</option>
                            <option value="">Website 1 Tahun Profesional</option>
                            <option value="">CBT 1 Tahun</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputemail">Prioritas</label>
                        <select class="form-control" name="priority">
                            <option value="" selected disabled>---Pilih Prioritas---</option>
                            <option value="">Rendah</option>
                            <option value="">Sedang</option>
                            <option value="">Tinggi</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Subjek</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan Subjek.." name="subject">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Pesan</label>
                    <textarea  class="form-control" id="content" rows="3" name="content"></textarea>
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
