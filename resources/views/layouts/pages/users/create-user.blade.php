@extends('layouts.master')
@section('title', 'Buat User')
@section('title-content', 'Buat User')
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
            <h6 class="m-0 font-weight-bold text-primary">Form Buat User</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.store') }}" enctype="application/x-www-form-urlencoded">
                @csrf
                <div class="form-group">
                    <label for="inputAddress">Nama</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan nama.."
                        name="nama" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Role</label>
                    <select class="form-control" name="role">
                        <option value="" selected disabled>---Pilih Role---</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Divisi</label>
                    <select class="form-control" name="department_id">
                        <option value="" selected disabled>---Pilih Divisi---</option>
                        @forelse ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @empty
                            <option value=""></option>
                        @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Email</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan email.."
                        name="email" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Password</label>
                    <input type="password" class="form-control" id="inputsubject" placeholder="Masukkkan password.."
                        name="password" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Telepon</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan telepon.."
                        name="nomor_telepon" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Alamat</label>
                    <textarea class="form-control" id="content" rows="4" name="alamat" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
