@extends('layouts.master')
@section('title', 'Balas Laporan')
@section('title-content', 'Balas Laporan')
@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Balas Laporan</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('ticket.response') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputname">Nomor Laporan</label>
                        <input type="text" id="inputname" name="ticket_id" value="{{ $ticket->id }}" hidden>
                        <input type="text" id="inputname" name="code" value="{{ $ticket->code }}" hidden>
                        <input type="text" class="form-control" id="inputname" name="code" value="{{ $ticket->code }}" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputemail">Paket</label>
                        <input type="text" class="form-control" id="inputemail" name="package" value="{{ $ticket->package->name }}" disabled>
                    </div>
                       {{-- <div class="form-group col-md-4">
                            <label for="prioritas">Prioritas</label>
                            <select id="prioritas" name="prioritas" class="form-control {{ $badge }}" style="font-weight: bold; color: white;">
                                <option value="Rendah" {{ $text == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="Sedang" {{ $text == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="Tinggi" {{ $text == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                            </select>
                        </div> --}}

                         <div class="form-group col-md-4">Add commentMore actions
                            <label for="inputemail">Prioritas</label>
                            <input type="text" class="form-control {{ $badge }}" id="inputemail" name="email" value="{{ $text }}" style="font-weight: bold; color: white;" disabled>
                        </div>

                </div>
                <div class="form-group">
                    <label for="inputAddress">Subjek</label>
                    <input type="text" class="form-control" id="inputsubject" value="{{ $ticket->subject }}" name="subject" disabled>
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Pesan</label>
                    <textarea  class="form-control" id="content" rows="5" name="message" required></textarea>
                </div>
                <div class="form-group">
                    <label for="inputAddress">File</label>
                    <input type="file" class="form-control" id="inputfile" placeholder="Unggah berkas.." name="file">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Balas</button>
                </div>
            </form>
        </div>
    </div>
@endsection

