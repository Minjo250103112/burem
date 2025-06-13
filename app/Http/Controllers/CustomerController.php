<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerPackage;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('layouts.pages.users.customer', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        $packages = Package::all();
        $package_customers = CustomerPackage::where('customer_id', $id)->get();

        if (empty($customer)) {
            return redirect()->back()->with(['danger' => 'Pelanggan tidak ada!']);
        }

        return view('layouts.pages.users.show-customer', compact(['customer', 'packages', 'package_customers']));
    }

    public function create()
    {
        return view('layouts.pages.users.create-customer');
    }

    public function store(Request $request)
    {
        $customer = Customer::create([
            'agency' => $request->agency,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => bcrypt(12345),
        ]);

        return redirect()->route('customer.index')->with(['success' => 'Pelanggan berhasil dibuat.']);
    }

    public function edit($id)
    {
        $customer = Customer::find($id);

        if (empty($customer)) {
            return redirect()->back()->with(['danger' => 'Pelanggan tidak ada!']);
        }

        return view('layouts.pages.users.edit-customer', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        if (empty($customer)) {
            return redirect()->back()->with(['danger' => 'Pelanggan tidak ada!']);
        }

        $customer->update([
            'agency' => $request->agency,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with(['success' => 'Pelanggan berhasil diubah.']);
    }

    public function customerPackage(Request $request)
    {
        $package_customer = CustomerPackage::create([
            'domain' => $request->domain,
            'customer_id' => $request->customer_id,
            'package_id' => $request->package_id,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data paket berhasil disimpan.'
        ]);
    }

    public function custPackageShow($id)
    {
        $Customer_package = CustomerPackage::find($id);
        if (empty($Customer_package)) {
            return response()->json(null);
        }
        return response()->json($Customer_package);
    }

    public function custPackageUpdate(Request $request, $id)
    {
        $Customer_package = CustomerPackage::find($id);
        if (empty($Customer_package)) {
            return response()->json(null);
        }
        $Customer_package->update([
            'domain' => $request->domain,
            'customer_id' => $request->customer_id,
            'package_id' => $request->package_id,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data paket berhasil disimpan.'
        ]);
    }

    public function destroy($id)
    {
        $Customer_package = CustomerPackage::find($id);
        if (empty($Customer_package)) {
            return response()->json(null);
        }

        $Customer_package->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data layanan berhasil dihapus'
        ]);
    }

    public function reset($id)
    {
        $customer = Customer::find($id);

        if (empty($customer)) {
            return redirect()->back()->with(['danger' => 'Pelanggan tidak ada!']);
        }

        $pass = Str::random(8);

        $customer->password = bcrypt($pass);
        $customer->save();

        return redirect()->back()->with(['success' => 'Password berhasil diubah '. $pass .'.']);
    }
}
