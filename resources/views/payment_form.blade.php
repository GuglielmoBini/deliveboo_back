@extends('layouts.app')
@section('title', 'Payment')
@section('content') 
<div class="container">
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
    
    {{-- <div class="flex-center position-ref full-height">
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
    </div> --}}
    
    
    <!-- loro -->
    <form method="post" id="payment-form" action="{{ url('/checkout') }}">
        @csrf

        <label for="address">Indirizzo</label>
        <input type="text" name="delivery_address" id="address">

        <label for="name">Nome</label>
        <input type="text" name="customer_name" id="name">

        <label for="surname">Cognome</label>
        <input type="text" name="customer_surname" id="surname">

        <label for="phone-number">Numero di telefono</label>
        <input type="text" name="customer_phone_number" id="phone-number">

        <label for="email">Email</label>
        <input type="text" name="customer_email" id="email">

        <label for="card-number" id="card-number">Card Number</label>
        <div id="card-number"></div>

        <label for="cvv" id="cvv">CVV</label>
        <div id="cvv"></div>

        <label for="expiration-date" id="expiration-date">Expiration Date</label>
        <div id="expiration-date"></div>

        <input type="submit" value="Pay" disabled />
    <form>
</div>   
@endsection
    <!-- fineloro -->


<!-- SCRIPTING -->
@section('scripts')    
<script src="https://js.braintreegateway.com/web/3.92.1/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.92.1/js/hosted-fields.min.js"></script>
    <script>
      var form = document.querySelector('#my-sample-form');
      var submit = document.querySelector('input[type="submit"]');

      braintree.client.create({
        authorization: '{{$token}}'
      }, function (clientErr, clientInstance) {
        if (clientErr) {
          console.error(clientErr);
          return;
        }

        // This example shows Hosted Fields, but you can also use this
        // client instance to create additional components here, such as
        // PayPal or Data Collector.

        braintree.hostedFields.create({
          client: clientInstance,
          styles: {
            'input': {
              'font-size': '14px'
            },
            'input.invalid': {
              'color': 'red'
            },
            'input.valid': {
              'color': 'green'
            }
          },
          fields: {
            number: {
              container: '#card-number',
              placeholder: '4111 1111 1111 1111'
            },
            cvv: {
              container: '#cvv',
              placeholder: '123'
            },
            expirationDate: {
              container: '#expiration-date',
              placeholder: '10/2022'
            }
          }
        }, function (hostedFieldsErr, hostedFieldsInstance) {
          if (hostedFieldsErr) {
            console.error(hostedFieldsErr);
            return;
          }

        //   submit.removeAttribute('disabled');

          form.addEventListener('submit', function (event) {
            event.preventDefault();

            hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
              if (tokenizeErr) {
                console.error(tokenizeErr);
                return;
              }

              // If this was a real integration, this is where you would
              // send the nonce to your server.
              console.log('Got a nonce: ' + payload.nonce);
            });
          }, false);
        });
      });
    </script>
@endsection