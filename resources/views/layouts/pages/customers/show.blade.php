@extends('layouts.master')
@section('title', 'Detail Laporan')
@section('title-content', 'Detail Laporan')
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
            <h6 class="m-0 font-weight-bold text-primary">Detail Laporan</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputname">Nama</label>
                        <input type="text" hidden name="customer_id" value="{{ $ticket->customer_id }}">
                        <input type="text" class="form-control" id="inputname" name="name"
                            value="{{ $ticket->customer->name }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputemail">Email</label>
                        <input type="text" class="form-control" id="inputemail" name="email"
                            value="{{ $ticket->customer->email }}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputdivisi">Divisi</label>
                        <input type="text" class="form-control" id="inputdepartment" name="department_id"
                            value="{{ $ticket->department->name }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputemail">Layanan</label>
                        <input type="text" class="form-control" id="inputdepartment" name="package_id"
                            value="{{ $ticket->package->name }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputemail">Prioritas</label>
                        <input type="text" class="form-control {{ $badge }}" id="inputdepartment" name="priority"
                            value="{{ $text }}" style="font-weight: bold; color: white;" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputemail">Status</label>
                        <input type="text" class="form-control {{ $badge_status }}" id="inputdepartment" name="status"
                            value="{{ $status }}" style="font-weight: bold; color: white;" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Subjek</label>
                    <input type="text" class="form-control" id="inputsubject" value="{{ $ticket->subject }}"
                        name="subject" disabled>
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Pesan</label>
                    <textarea class="form-control" id="content" rows="3" name="content" disabled>{{ $ticket->content }}</textarea>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Dokumen</label>
                </div>
                @if ($ticket->status == 1)
                <div class="text-right">
                    <a href="{{ route('ticket.reply', $ticket->code) }}" class="btn btn-primary">Balas</a>
                    <a onclick="confirmAction('{{ route('ticket.closed', $ticket->id) }}')" class="btn btn-danger">Tutup</a>
                </div>
                @else

                @endif
            </form>
        </div>
    </div>
    @forelse ($ticket->responses as $response)
        <div class="card mb-4 border-left-{{ empty($response->user) ? 'primary' : 'warning'}} shadow h-100">
            <div class="card-header">
                {{ empty($response->user) ? $response->customer->name : $response->user->nama}}
            </div>
            <div class="card-body">
                {{ $response->message }}
            </div>
        </div>
    @empty
    @endforelse
@endsection
@push('script')
<script>
function confirmAction(routeUrl) {
    if (confirm('Apakah yakin akan menutup laporan ini ?')) {
        // User clicked "Yes"
        window.location.href = routeUrl;

        // OR for POST requests:
        /*
        fetch(routeUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            window.location.reload(); // Reload after success
        });
        */
    }
    // User clicked "No" - do nothing
}
</script>
@endpush
