<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\DishOrder;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
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
        $data = $request->all();
        $validator = Validator::make($data, [
            'customer_name' => 'required|string|max:50',
            'customer_surname' => 'required|string|max:50',
            'delivery_address' => 'required|string|min:5|max:50',
            'customer_email' => 'required|email',
            'customer_phone_number' => 'nullable|numeric|digits:10',
            'total_price' => 'required|numeric'
        ], [
            'customer_name.required' => 'Il nome è obbligatorio',
            'customer_surname.required' => 'Il cognome è obbligatorio',
            'customer_name.max' => 'Il nome può contenere un massimo di 50 caratteri',
            'customer_surname.max' => 'Il cognome può contenere un massimo di 50 caratteri',
            'delivery_address.min' => 'L\'indirizzo di consegna deve contenere almeno 5 caratteri',
            'delivery_address.required' => 'L\'indirizzo di consegna è obbligatorio',
            'delivery_address.max' => 'L\'indirizzo di consegna può contenere un massimo di 50 caratteri',
            'customer_email.required' => 'L\'indirizzo email è obbligatorio',
            'customer_phone_number.numeric' => 'Il numero di telefono inserito è invalido',
            'customer_phone_number.digits' => 'Il numero di telefono inserito è invalido',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }


        $order = new Order();

        //$order->fill($data);
        $order->delivery_address = $data['delivery_address'];
        $order->customer_name = $data['customer_name'];
        $order->customer_surname = $data['customer_surname'];
        $order->customer_phone_number = $data['customer_phone_number'];
        $order->customer_email = $data['customer_email'];
        $order->total_price = $data['total_price'];
        $order->is_paid = true;

        $order->save();

        // 1- importare modello dish_order
        // 2- creare istanza dish_order
        // 3- riempire i campi e save()

        for ($i = 0; $i < count($data['dishes_id']); $i++) {
            $dish_order = new DishOrder();
            $dish_order->dish_id = $data['dishes_id'][$i];
            $dish_order->amount = $data['amounts'][$i];
            $dish_order->order_id = $order->id;

            $dish_order->save();
        }
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
