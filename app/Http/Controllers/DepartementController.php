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

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:departments',
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $department = Department::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data divisi berhasil disimpan'
        ]);
    }

    public function show($id)
    {
        $department = Department::find($id);
        if (empty($department)) {
            return response()->json(null);
        }
        return response()->json($department);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:departments,code,'.$id,
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $department = Department::find($id);
        if (empty($department)) {
            return response()->json(null);
        }

        $department->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data divisi berhasil diperbarui'
        ]);
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        if (empty($department)) {
            return response()->json(null);
        }

        $department->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data divisi berhasil dihapus'
        ]);
    }
}
