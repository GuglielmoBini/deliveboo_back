<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::all();

        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Dish $dish)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|text',
            'price' => 'required|number',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
        ], [
            'name.required' => 'Il nome del piatto è obbligatorio.',
            'price.required' => "Il prezzo del piatto è obbligatorio.",
            'image.image' => 'L\'immagine deve essere un file di tipo immagine',
            'image.mimes' => 'L\'immagine deve essere un file png, jpg o jpeg',
        ]);

        $data = $request->all();
        $dish = new Dish();

        if (array_key_exists('image', $data)) {
            $img_url = Storage::put('dishes', $data['image']);
            $data['image'] = $img_url;
        };

        $dish->name = $data['name'];
        if ($dish->description) $dish->description = $data['description'];
        if ($dish->image) $dish->image = $data['image'];
        $dish->price = $data['price'];

        $dish->save();

        return to_route('admin.dishes.index')->with('created-allert', "Il piatto $dish->name è stato aggiunto");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        return view('admin.dish.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dish $dish)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|text',
            'price' => 'required|number',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
        ], [
            'name.required' => 'Il nome del piatto è obbligatorio.',
            'price.required' => "Il prezzo del piatto è obbligatorio.",
            'image.image' => 'L\'immagine deve essere un file di tipo immagine',
            'image.mimes' => 'L\'immagine deve essere un file png, jpg o jpeg',
        ]);

        $old_d_name = $dish->name;

        $data = $request->all();

        if (array_key_exists('image', $data)) {
            if ($dish->image) Storage::delete($dish->image);
            $img_url = Storage::put('dishes', $data['image']);
            $data['image'] = $img_url;

            $dish->image = $data['image'];
        };

        $dish->name = $data['name'];
        if ($dish->description) $dish->description = $data['description'];
        $dish->price = $data['price'];

        $dish->save();

        return to_route('admin.dishes.index')->with('updated-allert', "Il piatto $old_d_name è stato modificato");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        if ($dish->image) Storage::delete($dish->image);

        $dish->delete();
        return to_route('admin.dishes.index')
            // ->with('deleted-allert', "Il piatto $dish->name è stato eliminato")
        ;
    }
}
