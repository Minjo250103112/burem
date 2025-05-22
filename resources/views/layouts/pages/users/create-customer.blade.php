@extends('layouts.master')
@section('title', 'Buat Pelanggan')
@section('title-content', 'Buat Pelanggan')
@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Buat Pelanggan</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('customer.store') }}" enctype="application/x-www-form-urlencoded">
                @csrf
                <div class="form-group">
                    <label for="inputAddress">Nama</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan nama.." name="name" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Instansi</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan instansi.." name="agency" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Email</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan email.." name="email" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Telepon</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan telepon.." name="phone" required>
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Alamat</label>
                    <textarea  class="form-control" id="content" rows="4" name="address" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
