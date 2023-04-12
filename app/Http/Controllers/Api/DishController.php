<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::where('is_visible', true)->get();

        foreach ($dishes as $dish) {
            if ($dish->image) $dish->image = url('storage/' . $dish->image);
        }

        return response()->json($dishes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dish = Dish::where('is_visible', true)->find($id);
        if (!$dish) return response(null, 404);
        if ($dish->image) $dish->image = url('storage/' . $dish->image);

        return response()->json($dish);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
