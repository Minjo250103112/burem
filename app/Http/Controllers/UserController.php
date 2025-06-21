<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('layouts.pages.users.user', compact('users'));
    }

    public function create()
    {
        $departments = Department::all();

        return view('layouts.pages.users.create-user', compact('departments'));
    }

    public function store(Request $request)
    {
        $user = User::create([
            'nama' => $request->nama,
            'role' => $request->role,
            'department_id' => $request->department_id,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('user.index')->with(['success' => 'User berhasil dibuat.']);;
    }

    public function edit($id)
    {
        $user = User::find($id);
        $departments = Department::all();


        if (empty($user)) {
            return redirect()->back()->with(['danger' => 'User tidak ada!']);
        }

        return view('layouts.pages.users.edit-user', compact(['user', 'departments']));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return redirect()->back()->with(['danger' => 'User tidak ada!']);
        }

        $user->update([
            'nama' => $request->nama,
            'role' => $request->role,
            'department_id' => $request->department_id,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->back()->with(['success' => 'User berhasil diubah.']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return response()->json(null);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus'
        ]);
    }

    public function reset($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return redirect()->back()->with(['danger' => 'User tidak ada!']);
        }

        $pass = Str::random(8);

        $user->password = bcrypt($pass);
        $user->save();

        return redirect()->back()->with(['success' => 'Password berhasil diubah '. $pass .'.']);
    }
}
