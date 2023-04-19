@extends('layouts.app')
@section('title', 'Aggiungi piatto')
@section('content')
    <div class="container">
        <form action="{{route('admin.dishes.update', $dish->id)}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
                <div class="row mt-5 mb-3">
                    <div class="col-6 ">
                        <label class="mb-2 form-label" for="name">Nome piatto</label>
                        <input type="text" class="form-control" name="name" value="{{old('name', $dish->name)}}" id="name" required>
                    </div>
                    <div class="col-6 ">
                        <label class="mb-2 form-label" for="price">Prezzo</label>
                        <input type="number" class="form-control" step="0.01" min="0" max="999,99" value="{{old('price', $dish->price)}}" id="price" name="price" required>
                    </div>
                    <div class="col-8 my-4">
                            <label class="mb-2 form-label" for="description">Descrizione</label>
                            <textarea class="form-control" rows="15" name="description" id="description">{{old('description', $dish->description)}}</textarea>
                    </div>
                    <div class="col-4 my-4">
                        <div>
                            <label class="mb-2" for="image">Immagine piatto</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                            
                    @isset($dish->image)
                    <figure class="mt-3">
                        <img src="{{ asset('storage/' . $dish->image) }}" class="card-img-top img-custom img-fluid" alt="{{$dish->name}}">
                    </figure>
                    @else
                    <figure class="mt-3">
                        <img src="{{ asset('storage/' . 'upload/placeholder-image.jpg') }}" class="card-img-top img-custom img-fluid" alt="{{$dish->name}}">
                    </figure>
                    @endisset
                    </div>
                    <div class="col-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_visible" name="is_visible" @if(old('is_visible', $dish->is_visible)) checked @endif>
                            <label class="form-check-label" for="is_visible">Pubblicato</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start my-3">
                    <a href="{{route('admin.dishes.index')}}" class="btn btn-custom-secondary me-2"><i class="fa-solid fa-reply me-2"></i>Indietro</a>
                    <button type="submit" class="btn btn-custom-secondary"><i class="fa-solid fa-share-from-square me-2"></i>Salva</button>
                </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
const fileInput = document.getElementById('image');
const preview = document.getElementById('preview');
const placeholder = 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png'

fileInput.addEventListener('change', () => {
    if(fileInput.files && fileInput.files[0]){
        const reader = new FileReader();
        reader.readAsDataURL(fileInput.files[0]);
        reader.onload = e => {
            preview.src = e.target.result;
        };
    }else{
        preview.src = placeholder;
    }
});

</script>
@endsection