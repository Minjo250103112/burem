@extends('layouts.master')
@section('title', 'Ubah User')
@section('title-content', 'Ubah User')
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
            <h6 class="m-0 font-weight-bold text-primary">Form Ubah User</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}"
                enctype="application/x-www-form-urlencoded">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="inputAddress">Nama</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan nama.."
                        name="nama" value="{{ $user->nama }}" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Role</label>
                    <select class="form-control" name="role">
                        <option value="" disabled>---Pilih Role---</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Divisi</label>
                    <select class="form-control" name="department_id">
                        <option value="">---Pilih Divisi---</option>
                        @forelse ($departments as $department)
                            <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                        @empty
                            <option value=""></option>
                        @endforelse
                    </select>
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
                    <textarea class="form-control" id="content" rows="4" name="alamat">{{ $user->alamat }}</textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
