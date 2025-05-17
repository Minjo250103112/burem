<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('layouts.pages.users.customer', compact('customers'));
    }

    public function show($id)
    {
        $data = $id;
        return view('layouts.pages.users.show-customer', compact('data'));
    }

    public function create(Request $request)
    {
        return view('layouts.pages.users.create-customer');
    }
}
