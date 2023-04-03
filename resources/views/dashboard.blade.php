@extends('layouts.app')

@section('title', 'dashbord')

@section('content')
<div class="container">
    <h1 class="text-start my-5">Ciao {{ Auth::user()->name }}</h1>
    <h6 class="text-custom-secondary">ecco il tuo ristorante:</h6>
    <div class="card mb-3" style="max-width: 100%;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{$res->image}}" class="img-fluid rounded-start img-custom" alt="...">
          </div>
          <div class="col-md-8">
            <div class="d-flex flex-column justify-content-between">

                <div class="card-body">
                  <h1 class="card-title custom-text-title">{{$res->name}}</h1>
                  <p class="card-text">{{$res->description}}</p>
                  <p class="card-text"><small class="text-custom-secondary my-4">di {{ Auth::user()->name }} {{ Auth::user()->surname }}</small></p>
                </div>

                <div class="d-flex justify-content-start m-3 h100">
                  <a class="btn btn-small btn-custom-secondary d-flex align-items-center m-0 pb-2" href="{{route('admin.dishes.index')}}">Menù</a>
                  <a class="btn btn-small btn-custom-secondary d-flex align-items-center ms-2 pb-2" href="">Modifica</a>
                </div>

            </div>
          </div>
        </div>
      </div>
</div>
@endsection
