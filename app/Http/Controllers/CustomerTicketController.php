<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerTicketController extends Controller
{
    public function index()
    {
        return view('layouts.pages.customers.index');
    }

    public function create()
    {
        return view('layouts.pages.customers.create');
    }

    public function store(Request $request)
    {
        // return view('layouts.pages.customers.create');
    }

    public function show($id)
    {
        return view('layouts.pages.customers.show');
    }
}
