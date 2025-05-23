<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();

        return view('layouts.pages.package.index', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:packages',
            'name' => 'required',
            'price' => 'required',
            'description' => 'nullable',
        ]);

        $package = Package::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data layanan berhasil disimpan'
        ]);
    }

    public function show($id)
    {
        $package = Package::find($id);
        if (empty($package)) {
            return response()->json(null);
        }
        return response()->json($package);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:packages,code,'.$id,
            'name' => 'required',
            'price' => 'required',
            'description' => 'nullable',
        ]);

        $package = Package::find($id);
        if (empty($package)) {
            return response()->json(null);
        }

        $package->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data layanan berhasil diperbarui'
        ]);
    }

    public function destroy($id)
    {
        $package = Package::find($id);
        if (empty($package)) {
            return response()->json(null);
        }

        $package->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data layanan berhasil dihapus'
        ]);
    }
}
