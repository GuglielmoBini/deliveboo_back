<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Restaurant;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allDishes = Dish::all();
        $restaurants = Restaurant::All();
        $dishes = [];

        foreach ($restaurants as $restaurant) {
            if ($restaurant->user_id == Auth::user()->id) {
                $res = $restaurant->id;
            }
        }
        foreach ($allDishes as $dish) {
            if ($dish->restaurant_id == $res) {
                $dishes[] = $dish;
            }
        }

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
        $restaurants = Restaurant::All();
        foreach ($restaurants as $restaurant) {
            if ($restaurant->user_id == Auth::user()->id) {
                $res = $restaurant->id;
            }
        }

        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
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
        $dish->restaurant_id = $res;
        if ($data['description']) $dish->description = $data['description'];
        if (Arr::exists($data, 'image')) $dish->image = $data['image'];
        $dish->price = $data['price'];

        $dish->is_visible = Arr::exists($data, 'is_visible');

        $dish->save();

        return to_route('admin.dishes.index')->with('type', 'success')->with('msg', "Il piatto è stato creato correttamente.");
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
        if (Auth::user()->id === $dish->restaurant_id) {
            return view('admin.dishes.edit', compact('dish'));
        } else {
            return to_route('admin.dishes.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dish $dish)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
        ], [
            'name.required' => 'Il nome del piatto è obbligatorio.',
            'price.required' => "Il prezzo del piatto è obbligatorio.",
            'image.image' => 'L\'immagine deve essere un file di tipo immagine',
            'image.mimes' => 'L\'immagine deve essere un file png, jpg o jpeg',
        ]);

        $data = $request->all();

        if (array_key_exists('image', $data)) {
            if ($dish->image) Storage::delete($dish->image);
            $img_url = Storage::put('dishes', $data['image']);
            $data['image'] = $img_url;

            $dish->image = $data['image'];
        };

        $dish->name = $data['name'];
        if ($data['description']) $dish->description = $data['description'];
        $dish->price = $data['price'];

        $dish->is_visible = Arr::exists($data, 'is_visible');
        // $data['is_visible'] = Arr::exists($data, 'is_visible');

        $dish->save();
        // $dish->update($data);

        return to_route('admin.dishes.index')->with('type', 'warning')->with('msg', "Il piatto $dish->name è stato modificato");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        if ($dish->image) Storage::delete($dish->image);

        $dish->delete();
        return to_route('admin.dishes.index')->with('type', 'danger')->with('msg', "Il piatto $dish->name è stato eliminato");
    }

    public function toggle(Dish $dish)
    {
        $dish->is_visible = !$dish->is_visible;
        $action = $dish->is_visible ? 'pubblicato con successo' : 'salvato come bozza';
        $dish->save();

        return to_route('admin.dishes.index')->with('type', 'info')->with('msg', "Il piatto $dish->name è stato $action");
    }
}
