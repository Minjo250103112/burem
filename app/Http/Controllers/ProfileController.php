<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::guard('web')->check()) {

            return view('layouts.pages.profile.user');
        } elseif (Auth::guard('customer')->check()) {
            $customer = Customer::find(Auth::guard('customer')->user()->id);

            return view('layouts.pages.profile.customer', compact('customer'));
        } else {
            return response()->json('Unauthorized!');
        }
    }

    public function updateCustomer(Request $request)
    {
        $customer = Customer::find($request->id);

        $customer->update([
            'agency' => $request->agency,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with(['success' => 'Profil berhasil diubah.']);
    }

    public function updateUser(Request $request)
    {
        $customer = Customer::find($request->id);

        $customer->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->back()->with(['success' => 'Profil berhasil diubah.']);
    }

    public function updatePassword(Request $request)
    {
        if (Auth::guard('web')->check()) {
            $user = User::find(Auth::guard('web')->user()->id);

            if (!Hash::check($request->current, Auth::guard('web')->user()->password)) {
                return redirect()->back()->with('error', 'Password lama tidak sesuai!')->withInput(['current']);
            }

            $user->fill([
                'password' => Hash::make($request->new)
            ])->save();

            return redirect()->back()->with(['success' => 'Password berhasil diubah.']);
        } elseif (Auth::guard('customer')->check()) {
            $customer = Customer::find(Auth::guard('customer')->user()->id);

            if (!Hash::check($request->current, Auth::guard('customer')->user()->password)) {
                return redirect()->back()->with('error', 'Password lama tidak sesuai!')->withInput(['current']);
            }

            $customer->fill([
                'password' => Hash::make($request->new)
            ])->save();

            return redirect()->back()->with(['success' => 'Password berhasil diubah.']);
        } else {
            return response()->json('Unauthorized!');
        }
    }
}
