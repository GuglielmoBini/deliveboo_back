<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger mt-5 mb-0">
        <ul class="m-0">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>