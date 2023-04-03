@extends('layouts.app')

@section('title', 'Menù')

@section('content')
    <div class="card-section d-flex flex-wrap justify-content-center">
        @foreach ($dishes as $dish)
        <div class="card" style="width: 18rem;">
			@isset($dish->image)
            <img src="{{$dish->image}}" class="card-img-top" alt="{{$dish->name}}">
            @endisset

            <div class="card-body">
                <h3>{{$dish->name}}</h3>
				@if($dish->description)
                <p class="card-text">{{$dish->description}}</p>
				@endif
				<div class="d-flex justify-content-between">
					<span>{{$dish->price}}</span>
					<div class="form-check form-switch">
						<label class="form-check-label" for="flexSwitchCheckDefault">Mostra nel menù</label>
                        {{-- todo fare il form per il toggle--}}
                        <input class="form-check-input" type="checkbox" role="switch" id="isVisible">
					</div>
				</div>
            </div>
        </div>
        @endforeach
    </div>
@endsection