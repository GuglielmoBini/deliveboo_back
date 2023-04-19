@if($restaurant->exists)
<!-- form edit -->
<form action="{{route('admin.restaurants.update', $restaurant->id)}}" method="POST" enctype="multipart/form-data">
@method('PUT')

@else
<!-- form upload -->
<form action="{{route('admin.restaurants.store')}}" method="POST" enctype="multipart/form-data">
@endif 

    @csrf
    <div class="row my-5">
        <!-- Input for Restaurant's name -->
        <div class="col-6">
            <h4><label class="form-label" for="restaurant-name">Ristorante</label></h4>
            <input class="form-control @error('name') is-invalid @enderror" type="text" id="restaurant-name" value="{{ old('name', $restaurant->name) }}" name="name" placeholder="Inserisci il nome del tuo ristorante..."  minlength="5" maxlength="50" required>
            @error('name')
            <div class="text-danger p-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input for Restaurant's address -->
        <div class="col-6">
            <h4><label class="form-label" for="restaurant-address">Indirizzo</label></h4>
            <input class="form-control @error('address') is-invalid @enderror" type="text" id="restaurant-address" value="{{ old('address', $restaurant->address) }}" name="address" placeholder="Inserisci l'indirizzo del tuo locale..."  minlength="5" maxlength="50" required>
            @error('address')
            <div class="text-danger p-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input to upload image -->
        <div class="col-12 mt-4 d-flex">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-8">
                <h4><label class="form-label" for="restaurant-image">Immagine</label></h4>
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="restaurant-image" value="{{ old('image', $restaurant->image) }}" name="image" placeholder="Inserisci un'immagine...">

                <!-- textarea for Restaurant's description -->
                <div class="col-12 mt-4">
                    <h4><label class="form-label" for="restaurant-description">Descrizione</label></h4>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="restaurant-description" name="description" placeholder="Inserisci una brece descrizione del tuo locale..." cols="50" rows="10">{{ old('description', $restaurant->description) }}</textarea>
                    @error('description')
                    <div class="text-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- checkboxes for type of restaurant -->
                <div class="mt-3">
                    @foreach($types as $type)
                    <input type="checkbox" value="{{$type->id}}" id="type-{{$type->name}}" name="types[]"
                    @if(in_array($type->id, old('types', $restaurant_types ?? []))) checked @endif>
                    <label class="me-2" for="type-{{$type->name}}">
                        {{$type->name}}
                    </label>
                    @endforeach
                    @error('types')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>  

            {{-- image preview --}}
            <div class="d-sm-none d-md-block d-none d-sm-block p-4 mt-1">
                <img src="{{asset('storage/' . $restaurant->image)}}" class="img-fluid rounded" alt="{{$restaurant->name}}"id="preview">
            </div>
            @error('image')
            <div class="text-danger p-1">{{ $message }}</div>
            @enderror

        </div>
    </div>

    <button type="submit" class="btn btn-custom-secondary mb-4"><i class="fa-solid fa-upload me-2"></i>{{ $restaurant->exists ? 'Aggiorna' : 'Carica'}}</button>
    @if($restaurant->exists)
    <a href="{{route('dashboard')}}" class="btn btn-custom-secondary mb-4" id="go-back"><i class="fa-solid fa-reply me-2"></i>Indietro</a>
    @endif

</form>

<!-- @if(Route::is('admin.restaurants.edit'))
<form action="{{route('admin.restaurants.destroy', $restaurant->id)}}" method="POST" id="btn-delete">
    @csrf
    @method('DELETE')
    <button class="btn btn-outline-danger" onclick="return confirm('Sicuro che vuoi cancellare il ristorante?')"><i class="fa-solid fa-trash-can"></i></button>
</form>
@endif -->

@section('scripts')
<script>
const fileInput = document.getElementById('restaurant-image');
const preview = document.getElementById('preview');
const placeholder = 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png'
const backButton = document.getElementById('go-back');

if (!backButton) {
    preview.src = placeholder
}
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