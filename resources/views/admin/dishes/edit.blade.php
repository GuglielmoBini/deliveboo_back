@extends('layouts.app')

@section('title', 'Aggiungi piatto')

@section('content')
    <div class="">
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
                <div class="input-group d-flex justify-content-between p-5">
                    <div class="w-25 pe-3">
                        <label class="mb-2" for="name">Nome piatto</label>
                        <input type="text" class="form-control" name="name" value="{{old('name', $dish->name)}}" id="name">
                    </div>
                    <div class="w-25 px-3">
                        <label class="mb-2" for="price">Prezzo</label>
                        <input type="number" class="form-control" step="0.01" min="0" max="999,99" value="{{old('price', $dish->price)}}" id="price">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="w-75">
                        <label class="mb-2" for="description">Descrizione</label>
                        <textarea name="description" value="{{old('description', $dish->description)}}" id="description"></textarea>
                    </div>
                    <div class="w-25">
                        <div>
                            <label class="mb-2" for="image">Immagine piatto</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
        
                        <div>
                            <img src="{{asset('storage/' . $project->image)}}" class="img-fluid rounded" alt="{{$dish->name}}" id="preview">
                        </div>
                    </div>
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