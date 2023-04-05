@extends('layouts.app')
@section('title', 'Menù')
@section('content')
<div class="container">
    <div class="d-flex justify-content-end mt-4 mb-3">
        <a href="{{ route('admin.dishes.create') }}" class="btn btn-custom-secondary">Aggiungi Piatto</a>
    </div>    
    <div class="card-section d-flex flex-wrap justify-content-start gap-3 pt-0 ps-3">
        @foreach ($dishes as $dish)
        <div class="card" style="width: 18rem;">
			@isset($dish->image)
            <figure class="rounded-top">
                <img src="{{ asset('storage/' . $dish->image) }}" class="card-img-top img-custom" alt="{{$dish->name}}">
            </figure>
            @endisset

            <div class="card-body d-flex flex-column justify-content-between">
                <h3 class="text-uppercase custom-text-title">{{$dish->name}}</h3>
				@if($dish->description)
                <p class="card-text">{{$dish->description}}</p>
				@endif
				<div class="d-flex justify-content-between">
					<span class="text-custom-secondary">€{{$dish->price}}</span>
					<div class="form-check form-switch">
                        {{-- toggle --}}
                        <form action="{{ route('admin.dishes.toggle', $dish->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <span>Pubblica</span>
                            <button type="submit" class="btn btn-outline p-0" id="toggle">
                                <i class="fa-solid fa-2x fa-toggle-{{ $dish->is_visible ? 'on' : 'off' }} {{ $dish->is_visible ? 'text-success' : 'text-danger' }}"></i>
                            </button>
                        </form>
					</div>
				</div>
                <div class="mt-2 d-flex justify-content-between align-items-center">
                    <div>{{ $dish->is_visible ? 'Visibile' : 'Bozza' }}</div>
                    <div class="d-flex">
                        <a href="{{ route('admin.dishes.edit', $dish->id) }}" class="btn btn-sm btn-custom-secondary">Modifica</a>
                        <form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ms-2 btn btn-sm btn-custom-secondary">Elimina</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection