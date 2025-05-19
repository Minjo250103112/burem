<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerPackage;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::guard('web')->check() && Auth::guard('web')->user()->role == 'admin'){
            $customers = Customer::count();
            $tickets = Ticket::count();
            $ticket_today = Ticket::where('created_at', today())->count();
            $users = User::where('role', '=', 'user')->count();

            return view('layouts.pages.dashboard.dashboard_admin', compact(['customers', 'tickets', 'ticket_today', 'users']));
        }elseif (Auth::guard('web')->check() && Auth::guard('web')->user()->role == 'user') {
            $ticket_month = Ticket::whereMonth('created_at', now()->month)->get()->count();
            $ticket_today = Ticket::where('created_at', today())->get();
            $tickets = collect($ticket_today)->count();
            $active_tickets = collect($ticket_today)->where('status', 1)->count();
            $closed_tickets = collect($ticket_today)->where('status', '!=', 1)->count();

            return view('layouts.pages.dashboard.dashboard_user', ['ticket_month','tickets', 'active_tickets', 'closed_tickets']);
        }else {
            $id = Auth::guard('customer')->user()->id;
            $customer_packages = CustomerPackage::where('customer_id', $id)->where('status', 1)->count();
            $tickets = Ticket::where('customer_id', $id)->get();
            $active_tickets = collect($tickets)->where('status', 1)->count();
            $closed_tickets = collect($tickets)->where('status', '!=', 1)->count();

            return view('layouts.pages.dashboard.dashboard', compact(['customer_packages', 'active_tickets', 'closed_tickets']));
        }
    }
}
