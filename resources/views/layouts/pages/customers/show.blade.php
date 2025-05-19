@extends('layouts.master')
@section('title', 'Detail Laporan')
@section('title-content', 'Detail Laporan')
@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Laporan</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputname">Nama</label>
                        <input type="text" hidden name="customer_id" value="{{ $ticket->customer_id }}">
                        <input type="text" class="form-control" id="inputname" name="name" value="{{ $ticket->customer->name }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputemail">Email</label>
                        <input type="text" class="form-control" id="inputemail" name="email" value="{{ $ticket->customer->email }}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputdivisi">Divisi</label>
                        <input type="text" class="form-control" id="inputdepartment" name="department_id" value="{{ $ticket->department->name }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputemail">Layanan</label>
                        <input type="text" class="form-control" id="inputdepartment" name="package_id" value="{{ $ticket->package->name }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputemail">Prioritas</label>
                        <input type="text" class="form-control {{ $badge }}" id="inputdepartment" name="priority" value="{{ $text }}" style="font-weight: bold; color: white;" disabled >
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputemail">Status</label>
                        <input type="text" class="form-control {{ $badge_status }}" id="inputdepartment" name="status" value="{{ $status }}" style="font-weight: bold; color: white;" disabled >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Subjek</label>
                    <input type="text" class="form-control" id="inputsubject" value="{{ $ticket->subject }}" name="subject" disabled>
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Pesan</label>
                    <textarea  class="form-control" id="content" rows="3" name="content" disabled>{{ $ticket->content }}</textarea>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Dokumen</label>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Balas</button>
                </div>
            </form>
        </div>
    </div>
@endsection
