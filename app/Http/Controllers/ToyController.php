<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toy;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ToyController extends Controller
{
    /**
     * Display a listing of the toys.
     */
    public function index()
    {
        $toys = Toy::with('category')->get();
        return response()->json($toys);
    }

    /**
     * Show the form for creating a new toy.
     */
    public function create()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories]);
    }

    /**
     * Store a newly created toy in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ToyName' => 'required|string|max:255',
            'ToyPrice' => 'required|numeric|min:0',
            'ToyQuantity' => 'required|integer|min:0',
            'CategoryID' => 'required|exists:categories,CategoryID',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $toy = Toy::create($request->all());
        return response()->json(['message' => 'Toy created successfully!', 'toy' => $toy], 201);
    }

    /**
     * Display the specified toy.
     */
    public function show($id)
    {
        $toy = Toy::with('category')->find($id);

        if (!$toy) {
            return response()->json(['message' => 'Toy not found.'], 404);
        }

        return response()->json($toy);
    }

    /**
     * Show the form for editing the specified toy.
     */
    public function edit($id)
    {
        $toy = Toy::find($id);
        $categories = Category::all();

        if (!$toy) {
            return response()->json(['message' => 'Toy not found.'], 404);
        }

        return response()->json(['toy' => $toy, 'categories' => $categories]);
    }

    /**
     * Update the specified toy in storage.
     */
    public function update(Request $request, $id)
    {
        $toy = Toy::find($id);

        if (!$toy) {
            return response()->json(['message' => 'Toy not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'ToyName' => 'sometimes|required|string|max:255',
            'ToyPrice' => 'sometimes|required|numeric|min:0',
            'ToyQuantity' => 'sometimes|required|integer|min:0',
            'CategoryID' => 'sometimes|required|exists:categories,CategoryID',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $toy->update($request->all());
        return response()->json(['message' => 'Toy updated successfully!', 'toy' => $toy]);
    }

    /**
     * Remove the specified toy from storage.
     */
    public function destroy($id)
    {
        $toy = Toy::find($id);

        if (!$toy) {
            return response()->json(['message' => 'Toy not found.'], 404);
        }

        $toy->delete();
        return response()->json(['message' => 'Toy deleted successfully!']);
    }
}
