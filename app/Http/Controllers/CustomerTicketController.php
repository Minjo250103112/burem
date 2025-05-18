<?php

namespace App\Http\Controllers;

use App\Models\CustomerPackage;
use App\Models\Department;
use App\Models\Ticket;
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
}
