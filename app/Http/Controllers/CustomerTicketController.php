<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class CustomerTicketController extends Controller
{
    public function index()
    {
        return view('layouts.pages.customers.index');
    }

    public function create()
    {
        $departments = Department::all();

        return view('layouts.pages.customers.create', compact(['departments']));
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
