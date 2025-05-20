<?php

namespace App\Http\Controllers;

use App\Models\CustomerPackage;
use App\Models\Department;
use App\Models\Ticket;
use App\Models\TicketResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('customer_id', Auth::guard('customer')->user()->id)->latest()->get();

        return view('layouts.pages.customers.index', compact('tickets'));
    }

    public function create()
    {
        $departments = Department::all();
        $packages = CustomerPackage::where('customer_id', Auth::guard('customer')->user()->id)->get();

        return view('layouts.pages.customers.create', compact(['departments', 'packages']));
    }

    public function store(Request $request)
    {
        $now = now()->format('dmYHi');
        $file = empty($request->file('file')) ? null : $request->file('file')->store('file');

        $customer = Ticket::create([
            'code' => $now,
            'customer_id' => $request->customer_id,
            'department_id' => $request->department_id,
            'package_id' => $request->package_id,
            'priority' => $request->priority,
            'subject' => $request->subject,
            'content' => $request->content,
            'file' => $file,
        ]);

        return redirect()->back()->with(['success' => 'Tiket berhasil dibuat dengan nomor tiket '. $customer->code .'']);
    }

    public function show($code)
    {
        $ticket = Ticket::where('code', $code)->get()->first();

        if (empty($ticket)) {
            return redirect()->back()->with(['danger' => 'Tiket tidak ada!']);
        }

        if ($ticket->priority == 2) {
            $badge = 'bg-warning';
            $text = 'Sedang';
        } elseif ($ticket->priority == 2) {
            $badge = 'bg-danger';
            $text = 'Tinggi';
        } else {
            $badge = 'bg-primary';
            $text = 'Rendah';
        }

        if ($ticket->status == 1) {
            $badge_status = 'bg-success';
            $status = 'Dibuka';
        } else {
            $badge_status = 'bg-secondary';
            $status = 'Ditutup';
        }

        return view('layouts.pages.customers.show', compact(['ticket', 'badge', 'text', 'badge_status', 'status']));
    }

    public function reply($code)
    {
        $ticket = Ticket::where('code', $code)->get()->first();

        if (empty($ticket)) {
            return redirect()->back()->with(['danger' => 'Tiket tidak ada!']);
        }

        if ($ticket->priority == 2) {
            $badge = 'bg-warning';
            $text = 'Sedang';
        } elseif ($ticket->priority == 2) {
            $badge = 'bg-danger';
            $text = 'Tinggi';
        } else {
            $badge = 'bg-primary';
            $text = 'Rendah';
        }

        return view('layouts.pages.customers.reply-ticket', compact(['badge', 'text', 'ticket']));
    }

    public function response(Request $request)
    {
        if (Auth::guard('web')->check()) {
            $column = 'user_id';
            $id = Auth::guard('web')->user()->id;
        } elseif (Auth::guard('customer')->check()) {
            $column = 'customer_id';
            $id = Auth::guard('customer')->user()->id;
        } else {
            // Handle case where neither guard is authenticated
            // You might want to redirect or throw an exception here
            throw new \Exception('No authenticated user found');
        }

        $file = empty($request->file('file')) ? null : $request->file('file')->store('file');

        $response = TicketResponse::create([
            'ticket_id' => $request->ticket_id,
            ''.$column.'' => $id,
            'message' => $request->message,
            'file' => $file
        ]);

        return redirect()->route('ticket.show', ['code' => $request->code])->with(['success' => 'Balasan laporan berhasil dibuat.']);
    }

    public function closed($id)
    {
        $ticket = Ticket::find($id);

        if (empty($ticket)) {
            return redirect()->back()->with(['danger' => 'Tiket tidak ada!']);
        }

        $ticket->update(['status' => 2]);
        return redirect()->back()->with(['success' => 'Laporan berhasil ditutup.']);
    }
}
