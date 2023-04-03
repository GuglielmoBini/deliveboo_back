<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurant = new Restaurant();
        $types = Type::All();
        return view('admin.restaurants.create', compact('restaurant', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'name' => 'required|string|min:5|max:50',
            'address' => 'required|string|min:5|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'types' => 'nullable|exists:types,id'
        ], [
            'name.required' => 'È necessario inserire un nome per l\'attività',
            'name.min' => 'Il nome dell\'attività deve contenere almeno 5 caratteri',
            'name.max' => 'Il nome dell\'attività può contenere un massimo di 50 caratteri',
            'image.image' => 'Il file da caricare deve essere di tipo immagine',
            'image.mimes' => 'I tipi di file sono: jpg, jpeg, png',
            'types' => 'Non hai selezionato un tipo di ristorante valido'
        ]);

        $data = $request->all();
        // In case we want a slug:
        //$data['slug'] = Str::slug($data['title'], '-');
        
        $restaurant = new Restaurant();
        
        $restaurant->fill($data);
        
        // Storing image and creating its path
        if ($request->hasFile('image')) $restaurant->image = Storage::put('upload', $data['image']);
        
        $restaurant->save();

        // make a relation between restaurant and type
        if(Arr::exists($data, 'restaurants')) $restaurant->types()->attach($data['types']);

        return to_route('admin.dashboard');
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
    public function edit(Restaurant $restaurant)
    {
        $types = Type::All();
        $restaurant_types = $restaurant->types->pluck('id')->toArray();
        return view('admin.restaurants.edit', compact('restaurant', 'types', 'restaurant_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'users_id' => 'nullable|exists:users,id',
            'name' => 'required|string|min:5|max:50',
            'address' => 'required|string|min:5|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'types' => 'nullable|exists:types,id'
        ], [
            'name.required' => 'È necessario inserire un nome per l\'attività',
            'name.min' => 'Il nome dell\'attività deve contenere almeno 5 caratteri',
            'name.max' => 'Il nome dell\'attività può contenere un massimo di 50 caratteri',
            'image.image' => 'Il file da caricare deve essere di tipo immagine',
            'image.mimes' => 'I tipi di file sono: jpg, jpeg, png',
            'types' => 'Non hai selezionato un tipo di ristorante valido'
        ]);

        $data = $request->all();
        // In case we want a slug:
        //$data['slug'] = Str::slug($data['title'], '-');
        
        $restaurant = new Restaurant();
        
        $restaurant->fill($data);
        
        if ($request->hasFile('image')){
            if($restaurant->image) Storage::delete($restaurant->image);
            $restaurant->image = Storage::put('upload', $data['image']);
        } 
        
        $restaurant->save();

        // Assign the type
        if(Arr::exists($data, 'types')) $restaurant->types()->sync($data['types']);
        else if(count($restaurant->types)) $restaurant->types()->detach();

        return to_route('admin.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
