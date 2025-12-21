<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    public function CustomerPage()
    {
        $parties = Party::where('type', 'customer')->get();
        return view('admin.customer.index', compact('parties'));
    }
    public function SupplierPage()
    {
        $parties = Party::where('type', 'supplier')->get();
        return view('admin.supplier.index', compact('parties'));
    }

    public function CreateParty(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'type' => 'required|in:supplier,customer',
            'created_by' => 'nullable|exists:users,id',
        ]);

        // dd($request->all());
        Party::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'type' => $request->input('type'),
            'created_by' => $request->input('created_by')
        ]);

        return redirect()->back()->with('success', 'Party created successfully.');
    }

    public function DeleteParty($id)
    {
        $brand = Party::findOrFail($id);
        $brand->delete();
        return redirect()->back()->with('success', 'Party deleted successfully.');
    }

    public function UpdateParty(Request $request, $id)
    {
        $party = Party::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'type' => 'required|in:supplier,customer',
            'created_by' => 'nullable|exists:users,id',
        ]);

        $party->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'type' => $request->input('type'),
            'created_by' => $request->input('created_by')
        ]);

        return redirect()->back()->with('success', 'Party updated successfully.');
    }
}
