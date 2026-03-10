<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use Illuminate\Http\Request;

class LostItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = LostItem::all();

        return response()->json($items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location_lost' => 'required|string|max:255',
            'date_lost' => 'required|date',
            'reporter_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255'
        ]);

        $item = LostItem::create($validated);

        return response()->json([
            'message' => 'Lost item reported successfully',
            'data' => $item
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = LostItem::findOrFail($id);

        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = LostItem::findOrFail($id);

        $validated = $request->validate([
            'item_name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'location_lost' => 'sometimes|string|max:255',
            'date_lost' => 'sometimes|date',
            'reporter_name' => 'sometimes|string|max:255',
            'contact' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:lost,found'
        ]);

        $item->update($validated);

        return response()->json([
            'message' => 'Lost item updated successfully',
            'data' => $item
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = LostItem::findOrFail($id);

        $item->delete();

        return response()->json([
            'message' => 'Lost item deleted successfully'
        ]);
    }
}