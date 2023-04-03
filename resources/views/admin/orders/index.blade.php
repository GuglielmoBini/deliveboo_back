@extends('layouts.app')
@section('title', 'Orders')
@section('content')
<div class="container">
    {{-- header --}}
    <header class="d-flex align-items-center justify-content-between">
        <h1 class="my-5">Ordini</h1>
    </header>
    {{-- tabella --}}
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">delivery_address</th>
                <th scope="col">customer_name</th>
                <th scope="col">customer_surname</th>
                <th scope="col">customer_phone_number</th>
                <th scope="col">customer_email</th>
                <th scope="col">total_price</th>
                <th scope="col">is_paid</th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <th scope="row">{{ $order->id }}</th>
                <td>{{ $order->delivery_address }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_surname }}</td>
                <td>{{ $order->customer_phone_number }}</td>
                <td>{{ $order->customer_email }}</td>
                <td>{{ $order->total_price }}</td>
                <td>{{ $order->is_paid }}</td>
                <td>{{ $order->getDateDiff('created_at') }}</td>
                <td>{{ $order->getDate('updated_at', 'd-m-Y H:i:s') }}</td>
            </tr>
            @empty
            <tr>
                <th scope="row" colspan="10" class="text-center">Non ci sono ordini</th>
            </tr>
            @endforelse
    
        </tbody>
    </table>

    {{-- Paginazione --}}
    <div class="d-flex justify-content-end">
        @if ($orders->hasPages())
        {{ $orders->links() }}
        @endif
    </div>
    <div class="d-flex justify-content-center">
        <a href="{{ route('dashboard') }}" class="btn btn-danger">Torna Indietro</a>
    </div>
</div>
@endsection
