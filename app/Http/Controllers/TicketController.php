<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Department;
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

    public function create($id)
    {
        $customer= Customer::find($id);
        $departments = Department::all();

        if (empty($customer)) {
            return redirect()->back()->with(['danger' => 'Pelanggan tidak ada!']);
        }

        return view('layouts.pages.ticket.create', compact(['customer', 'departments']));
    }

    protected function get_data($id = null)
    {
        if (empty($id) || $id == null) {
            $data = Ticket::all();
        } else {
            $data =Ticket::where('department_id', $id)->get();
        }

        return $data;
    }
}
