@extends('layouts.app')

@section('title', 'Menù')

@section('content')
<div class="container">

    <div class="card-section d-flex flex-wrap justify-content-between">
        @foreach ($dishes as $dish)
        <div class="card" style="width: 18rem;">
			@isset($dish->image)
            <figure class="rounded-top">
                <img src="{{$dish->image}}" class="card-img-top img-custom" alt="{{$dish->name}}">
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
						<label class="form-check-label" for="flexSwitchCheckDefault">Mostra nel menù</label>
                        {{-- todo fare il form per il toggle--}}
                        <input class="form-check-input" type="checkbox" role="switch" id="isVisible">
					</div>
				</div>

                <div class="mt-2 d-flex justify-content-end">
                    <a href="#" class="btn btn-sm btn-custom-secondary">Modifica</a>
                    <button href="" class="ms-2 btn btn-sm btn-custom-secondary">Elimina</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-end mt-3 mb-5">
        <a href="#" class="btn btn-custom-secondary">Aggiungi Piatto</a>
    </div>
</div>

@endsection