@extends('layouts.app')
@section('title', 'Payment')
@section('content') 
<div class="container">
    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif
    
    {{-- @if(count($errors)>0)
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    
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
    <form method="post" id="payment-form" action="{{ url('/checkout') }}" class="row justify-content-between mt-5"> 
        @csrf

        <div class="col-4 mt-3">
          <label for="address" class="form-label">Indirizzo</label>
          <input  type="text" name="delivery_address" id="address" class="form-control">
        </div>

        <div class="col-4 mt-3">
          <label for="name" class="form-label">Nome</label>
          <input class="form-control"  type="text" name="customer_name" id="name">
        </div>

        <div class="col-4 mt-3">
          <label for="surname" class="form-label">Cognome</label>
          <input class="form-control"  type="text" name="customer_surname" id="surname">
        </div> 

        <div class="col-3 mt-4">
          <label for="amount" class="form-label">amount</label>
          <input class="form-control"  type="number" name="amount" id="amount">
        </div> 

        <div class="col-3 mt-4">
          <label for="phone-number" class="form-label">Numero di telefono</label>
          <input class="form-control"  type="text" name="customer_phone_number" id="phone-number">
        </div>

        <div class="col-3 mt-4">
          <label for="email" class="form-label">Email</label>
          <input class="form-control"  type="text" name="customer_email" id="email">
        </div>
        


        <div class="col-4 mt-3" >
          <label for="card-number"  class="form-label">Card Number</label>
          {{-- <input type="text" name="card-number" id="card-number" class="form-control "> --}}
          <div id="card-number" class="form-control"></div>
        </div> 


        <div class="col-4 mt-3">
          <label for="cvv"  class="form-label">CVV</label>
          {{-- <input type="text" name="ccv" id="cvv" class="form-control "> --}}
          <div id="cvv" class="form-control"></div>
        </div>

        <div class="col-4 mt-3">
          <label for="expiration-date" class="form-label">Expiration Date</label> 
          {{-- <input type="text" name="expiration-date" id="expiration-date" class="form-control">   --}}
          <div id="expiration-date" class="form-control"></div>
        </div>

      <!--=================================== -->
        
        
        {{-- <div id="card-number" class="col-4">
        </div>

        <div class="col-4">
          <div id="cvv" >
        </div> 
        </div>

        
        <div id="expiration-date" class="col-4">
        </div> --}}

        <input type="hidden" name="payment_method_nonce" id="nonce"  />
        <button type="submit" class="btn btn-custom-secondary">Paga</button>

    <form>
</div>   
@endsection
    <!-- fineloro -->


<!-- SCRIPTING -->
@section('scripts')    
<script src="https://js.braintreegateway.com/web/3.92.1/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.92.1/js/hosted-fields.min.js"></script>
    <script>
      var form = document.querySelector('#payment-form');
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
              //console.log('Got a nonce: ' + payload.nonce);
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          }, false);
        });
      });
    </script>
@endsection