<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:50',
            'customer_surname' => 'required|string|max:50',
            'customer_address' => 'required|string|min:5|max:50',
            'customer_email' => 'required|string',
            'customer_phone_number' => 'nullable|numeric|digits:10',
        ], [
            'customer_name.required' => 'Il nome è obbligatorio',
            'customer_surname.required' => 'Il cognome è obbligatorio',
            'customer_name.max' => 'Il nome può contenere un massimo di 50 caratteri',
            'customer_surname.max' => 'Il cognome può contenere un massimo di 50 caratteri',
            'customer_address.min' => 'L\'indirizzo di consegna deve contenere almeno 5 caratteri',
            'customer_address.required' => 'L\'indirizzo di consegna è obbligatorio',
            'customer_address.max' => 'L\'indirizzo di consegna può contenere un massimo di 50 caratteri',
            'customer_email.required' => 'L\'indirizzo email è obbligatorio',
            'customer_phone_number.numeric' => 'Il numero di telefono inserito è invalido',
            'customer_phone_number.digits' => 'Il numero di telefono inserito è invalido',

        ]);

        $data = $request->all();

        $order = new Order();

        $order->fill($data);

        $order->isPaid = false;

        $order->save();

        return to_route('payments');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
