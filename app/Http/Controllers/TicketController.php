<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('layouts.pages.ticket.index');
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
}
