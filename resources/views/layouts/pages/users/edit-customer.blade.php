@extends('layouts.master')
@section('title', 'Ubah Pelanggan')
@section('title-content', 'Ubah Pelanggan')
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
            <h6 class="m-0 font-weight-bold text-primary">Form Ubah Pelanggan</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('customer.update', ['id' => $customer->id]) }}"
                enctype="application/x-www-form-urlencoded">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="inputAddress">Nama</label>
                    <input type="text" class="form-control" id="inputsubject" placeholder="Masukkkan nama.."
                        name="name" value="{{ $customer->name }}" required>
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
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
