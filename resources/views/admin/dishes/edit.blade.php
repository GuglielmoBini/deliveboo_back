@extends('layouts.app')

@section('title', 'Aggiungi piatto')

@section('content')
    <div class="container">
        <form action="{{route('admin.dishes.store')}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
                @if ($errors->any())
                <div class="alert alert-danger mt-5 mb-0">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row mt-5 mb-3">
                    <div class="col-6 ">
                        <label class="mb-2 form-label" for="name">Nome piatto</label>
                        <input type="text" class="form-control" name="name" value="{{old('name', $dish->name)}}" id="name">
                    </div>
                    <div class="col-6 ">
                        <label class="mb-2 form-label" for="price">Prezzo</label>
                        <input type="number" class="form-control" step="0.01" min="0" max="999,99" value="{{old('price', $dish->price)}}"id="price">
                    </div>
                    <div class="col-12 my-4">
                            <label class="mb-2 form-label" for="description">Descrizione</label>
                            <textarea class="form-control" rows="12" name="description" value="{{old('description', $dish->description)}}" id="description"></textarea>
                    </div>
                    {{-- <div class="w-50">
                        <div>
                            <label class="mb-2" for="image">Immagine piatto</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                            
                        <div>
                            <img src="{{asset('storage/' . $dish->image)}}" class="img-fluid rounded" alt="{{$dish->name}}"id="preview">
                        </div>
                    </div> --}}
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{route('admin.dishes.index')}}" class="btn btn-custom-secondary">Torna indietro</a>
                    <button type="submit" class="btn btn-custom-secondary">Salva</button>
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