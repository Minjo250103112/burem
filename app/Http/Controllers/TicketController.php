<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        if (Auth::guard('web')->check() && Auth::guard('web')->user()->role == 'admin'){
            $tickets = $this->get_data(null);
        } else {
            $department_id = Auth::guard('web')->user()->department_id;
            $tickets = $this->get_data($department_id);
        }

        return view('layouts.pages.ticket.index', compact('tickets'));
    }

    public function show($id)
    {
        $data = $id;
        return view('layouts.pages.ticket.show', compact('data'));
    }

    public function create(Request $request)
    {
        return view('layouts.pages.ticket.create');
    }

    protected function get_data($id = null)
    {
        if (empty($id) || $id == null) {
            $data = Ticket::latest()->get();
        } else {
            $data =Ticket::where('department_id', $id)->latest()->get();
        }

        return $data;
    }
}
