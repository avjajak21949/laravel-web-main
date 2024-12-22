<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer; // Assuming User is represented as Customer
use App\Models\Seller;

class AdminUserController extends Controller
{
    // Display all users
    public function indexUsers()
    {
        $users = Customer::all();
        return view('admin.users.index', compact('users'));
    }

    // Display all sellers
    public function indexSellers()
    {
        $sellers = Seller::all();
        return view('admin.sellers.index', compact('sellers'));
    }

    // Show the form to create a new user
    public function createUser()
    {
        return view('admin.users.create');
    }

    // Show the form to create a new seller
    public function createSeller()
    {
        return view('admin.sellers.create');
    }

    // Store a new user
    public function storeUser(Request $request)
    {
        $request->validate([
            'CustomerName' => 'required|string|max:255',
            'CustomerEmail' => 'required|email|unique:customers,CustomerEmail',
            'CustomerPhoneNum' => 'required|string|max:20',
            'CustomerAddress' => 'required|string',
            'CustomerMembership' => 'nullable|string|max:50',
        ]);

        Customer::create($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Store a new seller
    public function storeSeller(Request $request)
    {
        $request->validate([
            'SellerName' => 'required|string|max:255',
            'SellerEmail' => 'required|email|unique:sellers,SellerEmail',
            'SellerPhoneNum' => 'required|string|max:20',
            'SellerPassword' => 'required|string|min:6',
        ]);

        Seller::create($request->all());

        return redirect()->route('admin.sellers.index')->with('success', 'Seller created successfully.');
    }

    // Show the form to edit a user
    public function editUser($id)
    {
        $user = Customer::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Show the form to edit a seller
    public function editSeller($id)
    {
        $seller = Seller::findOrFail($id);
        return view('admin.sellers.edit', compact('seller'));
    }

    // Update a user
    public function updateUser(Request $request, $id)
    {
        $user = Customer::findOrFail($id);

        $request->validate([
            'CustomerName' => 'required|string|max:255',
            'CustomerEmail' => 'required|email|unique:customers,CustomerEmail,' . $id . ',CustomerID',
            'CustomerPhoneNum' => 'required|string|max:20',
            'CustomerAddress' => 'required|string',
            'CustomerMembership' => 'nullable|string|max:50',
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Update a seller
    public function updateSeller(Request $request, $id)
    {
        $seller = Seller::findOrFail($id);

        $request->validate([
            'SellerName' => 'required|string|max:255',
            'SellerEmail' => 'required|email|unique:sellers,SellerEmail,' . $id . ',SellerID',
            'SellerPhoneNum' => 'required|string|max:20',
            'SellerPassword' => 'nullable|string|min:6',
        ]);

        $seller->update($request->all());

        return redirect()->route('admin.sellers.index')->with('success', 'Seller updated successfully.');
    }

    // Delete a user
    public function destroyUser($id)
    {
        $user = Customer::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    // Delete a seller
    public function destroySeller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();

        return redirect()->route('admin.sellers.index')->with('success', 'Seller deleted successfully.');
    }
}
