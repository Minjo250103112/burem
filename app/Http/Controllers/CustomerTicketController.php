<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerPackage;
use App\Models\Department;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\User;
use App\Notifications\TicketNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

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
        $priority = !empty($request->admin) ? $request->priority : 0;

        $customer = Ticket::create([
            'code' => $now,
            'customer_id' => $request->customer_id,
            'department_id' => $request->department_id,
            'package_id' => $request->package_id,
            'priority' => $priority,
            'subject' => $request->subject,
            'content' => $request->content,
            'file' => $file,
        ]);

        $message = ''.Auth::guard('customer')->user()->name.' membuat laporan / tiket baru dengan nomor '. $customer->code .'';
        $type = 'ticket';
        $link = route('ticket.show', ['code' => $customer->code]);

        $users = User::where('department_id', $request->department_id)->orWhere('role', '=', 'admin')->get();

        Notification::send($users, new TicketNotification($message, $type, $link));

        return redirect()->back()->with(['success' => 'Tiket berhasil dibuat dengan nomor tiket '. $customer->code .'']);
    }

    public function show(Request $request, $code)
    {
        $ticket = Ticket::where('code', $code)->get()->first();

        if (empty($ticket)) {
            return redirect()->back()->with(['danger' => 'Tiket tidak ada!']);
        }

        // if ($request->has('key')) {
        //     $notification = $request->user()->notifications()->find($request->key);
        //     if ($notification && is_null($notification->read_at)) {
        //         $notification->markAsRead();
        //     }
        // }

        $user = Auth::guard('web')->check()
            ? Auth::guard('web')->user()
            : (Auth::guard('customer')->check() ? Auth::guard('customer')->user() : null);

        if ($request->has('key')) {
            $notification = $user->notifications()->find($request->key);
            if ($notification && is_null($notification->read_at)) {
                $notification->markAsRead();
            }
        }

        if ($ticket->priority == 1) {
            $badge = 'bg-primary';
            $text = 'Rendah';
        } elseif ($ticket->priority == 2) {
            $badge = 'bg-warning';
            $text = 'Sedang';
        } elseif ($ticket->priority == 3) {
            $badge = 'bg-danger';
            $text = 'Tinggi';
        } else {
            $badge = 'bg-secondary';
            $text = 'Belum Ditentukan';
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

    public function reply(Request $request, $code)
    {
        $user = Auth::guard('web')->check()
            ? Auth::guard('web')->user()
            : (Auth::guard('customer')->check() ? Auth::guard('customer')->user() : null);

        if ($request->has('key')) {
            $notification = $user->notifications()->find($request->key);
            if ($notification && is_null($notification->read_at)) {
                $notification->markAsRead();
            }
        }

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
            $name = Auth::guard('web')->user()->nama;
            $ticket = Ticket::find($request->ticket_id);
            $users = Customer::find($ticket->customer_id);
        } elseif (Auth::guard('customer')->check()) {
            $column = 'customer_id';
            $id = Auth::guard('customer')->user()->id;
            $name = Auth::guard('customer')->user()->name;
            $ticket = Ticket::find($request->ticket_id);
            $responses = TicketResponse::where('ticket_id', $request->ticket_id)->get();
            $hasUserResponses = $responses->whereNotNull('user_id')->count() > 0;
            // $users = empty($responses) ? User::where('department_id', $ticket->department_id)->orWhere('role', '=', 'admin')->get() : User::whereIn('id', $responses)->get();
            // $users = empty($responses) ? User::where('department_id', $ticket->department_id)->orWhere('role', '=', 'admin')->get() : User::whereIn('id', $responses)->get();
            if (!$hasUserResponses) {
                $id_user = '';
                $users = User::where('department_id', $ticket->department_id)->orWhere('role', '=', 'admin')->get();
            } else {
                $id_user = $responses->pluck('user_id')->filter()->unique();
                $users = User::whereIn('id', $id_user)->get();
            }
        } else {
            throw new \Exception('No authenticated user found');
        }

        // dd($users);

        $file = empty($request->file('file')) ? null : $request->file('file')->store('file');

        $response = TicketResponse::create([
            'ticket_id' => $request->ticket_id,
            ''.$column.'' => $id,
            'message' => $request->message,
            'file' => $file
        ]);

        $message = "$name membalas keluhan / tiket $ticket->code.";
        $type = 'comment';
        $link = route('ticket.show', ['code' => $ticket->code]);

        Notification::send($users, new TicketNotification($message, $type, $link));

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

    public function priority(Request $request, $id)
    {
        // dd($request->all());
        $ticket = Ticket::find($id);

        if (empty($ticket)) {
            return redirect()->back()->with(['danger' => 'Tiket tidak ada!']);
        }

        $priority = $request->get('priority');

        // $ticket->update(['priority' => $request->priority]);
        $ticket->priority = $priority;
        $ticket->save();

        return redirect()->back()->with(['success' => 'Laporan berhasil diperbarui.']);
    }
}
