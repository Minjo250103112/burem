<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return view('layouts.pages.departement.index', compact('departments'));
    }
}
