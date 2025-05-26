@extends('layouts.master')
@section('title', 'Edit Profile')
@section('title-content', 'Edit Profile')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ubah Data Profil</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.user') }}"
                        enctype="application/x-www-form-urlencoded">
                        @csrf
                        <div class="form-group">
                            <label for="inputAddress">Nama</label>
                            <input type="text" name="id" id="id" value="{{ $user->id }}" hidden>
                            <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan nama.."
                                name="nama" value="{{ $user->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Email</label>
                            <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan email.."
                                name="email" value="{{ $user->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Telepon</label>
                            <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan telepon.."
                                name="nomor_telepon" value="{{ $user->nomor_telepon }}" required>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Alamat</label>
                            <textarea class="form-control" id="content" rows="4" name="alamat" required>{{ $user->alamat }}</textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ubah Password</h6>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="form-group">
                            <label for="inputAddress">Password Lama</label>
                            <input type="text" class="form-control" id="inputsubject"
                                placeholder="Masukkkan password lama.." name="current" required>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Password Baru</label>
                            <input type="text" class="form-control" id="inputsubject"
                                placeholder="Masukkkan password baru.." name="new" required>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Konfirmasi Password</label>
                            <input type="text" class="form-control" id="inputsubject"
                                placeholder="Masukkkan konfirmasi password.." name="confirm" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
