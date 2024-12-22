<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toy;

class CartController extends Controller
{
    // Display the cart
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = $this->calculateTotal($cart);

        return view('cart.index', compact('cart', 'total'));
    }

    // Add an item to the cart
    public function add(Request $request, $id)
    {
        $toy = Toy::findOrFail($id);

        // Get the cart from the session
        $cart = session()->get('cart', []);

        // If the toy is already in the cart, update the quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity;
        } else {
            // Add the toy to the cart
            $cart[$id] = [
                'name' => $toy->ToyName,
                'price' => $toy->ToyPrice,
                'quantity' => $request->quantity,
            ];
        }

        // Save the cart back to the session
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item added to the cart!');
    }

    // Update the quantity of an item in the cart
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;

            // Save the updated cart back to the session
            session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
        }

        return redirect()->route('cart.index')->with('error', 'Item not found in the cart!');
    }

    // Remove an item from the cart
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);

            // Save the updated cart back to the session
            session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('success', 'Item removed from the cart!');
        }

        return redirect()->route('cart.index')->with('error', 'Item not found in the cart!');
    }

    // Clear the entire cart
    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }

    // Calculate the total price of the cart
    private function calculateTotal($cart)
    {
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
}
