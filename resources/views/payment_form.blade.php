@extends('layouts.app')
@section('title', 'Payment')

<main>

    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    @if(count($errors)>0)
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex-center position-ref full-height">
        <div class="content">
            <form id="payment-form" action="#" method="post"></form>
            <section>
                <label for="amount">
                    <span class="input-label">Amount</span>
                    <div class="input-wrapper amount-wrapper">
                        <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value=10>

                    </div>
                </label>
            </section>
        </div>
    </div>


    <!-- loro -->
    <form method="post" id="payment-form" action="{{ url('/checkout') }}">
        @csrf
        <section>
            <label for="amount">
                <span class="input-label">Amount</span>
                <div class="input-wrapper amount-wrapper">
                    <input id="amount" name="amount" type="tel" min="1" placeholder="Amount"
                        value="10">
                </div>
            </label>

            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
        </section>

        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button class="button" type="submit"><span>Test Transaction</span></button>
    <form>
    <!-- fineloro -->

</main>


<!-- SCRIPTING -->
<script src="https://js.braintreegateway.com/web/dropin/1.36.1/js/dropin.min.js"></script> 
<script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            paypal: {
                flow: 'vault'
            }
        }, function(createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                    }

                    // Add the nonce to the form and submit
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
</script>
<script>
        const cardInput = document.getElementById("card-number");
        const cardNumberInput = document.getElementById("credit-card-number");
        const expiInput = document.getElementById("expir");
        const expirationInput = document.getElementById("expiration");

        cardNumberInput.addEventListener("input", () => {
            cardInput.value = cardNumberInput.value.replace(/\s+/g, '').replace(/(\d{4})/g, '$1 ').trim();

        });

        expirationInput.addEventListener("input", () => {
            expiInput.value = expirationInput.value.replace(/(\d{2})/, '$1/').trim();
        });
</script>