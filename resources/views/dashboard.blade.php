@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <h1 class="text-start my-5">Ciao {{ Auth::user()->name }}</h1>
    <h6 class="text-custom-secondary">ecco il tuo ristorante:</h6>
    <div class="card mb-3" style="max-width: 100%;">
        <div class="row g-0">
          <div class="col-md-5">
            @isset($res->image)
            <img src="{{ asset('storage/' . $res->image) }}" class="img-fluid rounded-start" alt="$res->name">
            @else
            <img src="{{ asset('storage/upload/placeholder-image.jpg') }}" class="img-fluid rounded-top" alt="immagine non caricata">
            @endisset
          </div>
          <div class="col-md-7">
            <div class="d-flex flex-column justify-content-between h-100">

                <div class="card-body">
                  <h1 class="card-title custom-text-title">{{$res->name}}</h1>
                  <p class="card-text">{{$res->description}}</p>
                  <p class="card-text"><small class="text-custom-secondary my-4">di {{ Auth::user()->name }} {{ Auth::user()->surname }}</small></p>

                  <!-- type of restaurant -->
                  <h5 class="text-custom-primary">Tipo attività</h5>
                  <div class="d-flex">
                    @forelse($res->types as $type)
                    <div class="card type-card me-1">
                      <img class="img-fluid" src="{{ asset('storage/' . $type->image) }}" alt="{{ $type->name }}">
                      <h5 class="text-center mt-1">{{ $type->name }}</h5>
                    </div>
                    @empty
                    -
                    @endforelse
                  </div>

                </div>

                <div class="d-flex justify-content-start m-3">
                  <a class="btn btn-small btn-custom-secondary d-flex align-items-center m-0" href="{{route('admin.dishes.index')}}">Menù</a>
                  <a class="btn btn-small btn-custom-secondary d-flex align-items-center ms-2" href="{{ route('admin.restaurants.edit', $res->id) }}">Modifica</a>
                </div>

            </div>
          </div>
        </div>
      </div>
</div>
@endsection
