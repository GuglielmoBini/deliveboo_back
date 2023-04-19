@extends('layouts.app')
@section('title', 'Payment')

@section('content') 
    <div class="d-flex justify-content-center align-items-center ps-bg">
        <div class="d-flex flex-column align-items-center justify-content-center">
            <div class="d-flex justify-content-center align-items-center graphic-container mb-5">
                <div class="check text-center">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div class="lds-ring">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <h2>Il tuo ordine è stato effettuato con successo!</h2>
            <h3>Ti stiamo reindirizzando alla home...</h3>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        setInterval(() => {
            window.location.replace("http://localhost:5174/");
        }, 4000);
    </script>
@endsection