
@extends('layouts.master')

@section('includes')

<script src="https://js.stripe.com/v3/"></script>

@stop

@section('content')

{{ Breadcrumbs::render('checkout') }}


<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Billing Details</h3>
                    <form class="row contact_form" action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                        {{ csrf_field() }}
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
                           <!--  <span class="placeholder" data-placeholder="First name"></span> -->
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="lastname" name="name" placeholder="Last name">
                            <!-- <span class="placeholder" data-placeholder="Last name"></span> -->
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="number" name="phone" placeholder="Phone number">
                          <!--   <span class="placeholder" data-placeholder="Phone number"></span> -->
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address">
                            <!-- <span class="placeholder" data-placeholder="Email Address"></span> -->
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add2" name="address" placeholder="Address line 02">
                            <!-- <span class="placeholder" data-placeholder="Address line 02"></span> -->
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="city" name="city" placeholder="Town/City">
                            <!-- <span class="placeholder" data-placeholder="Town/City"></span> -->
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="zip" name="postalcode" placeholder="Postcode/ZIP">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <div class="form-group">
                                     <label for="card-element">
                                       Credit or debit card
                                     </label>
                                     <div id="card-element">
                                       <!-- A Stripe Element will be inserted here. -->
                                     </div>
     
                                     <!-- Used to display form errors. -->
                                     <div id="card-errors" role="alert"></div>
                                </div>
                            </div>
                        </div>
                        <button id="complet-order" type="submit" class="primary-btn my-3">Proceed to payment</button>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li><a href="#">Product <span>Total</span></a></li>
                            @foreach (Cart::content() as $product )
                            <li><a href="#">{{ $product->name }}<span class="middle">x {{ $product->qty }}</span> <span class="last">CHF {{ $product->price }}</span></a></li>
                            @endforeach
                        </ul>
                        <ul class="list list_2">
                            <li><a href="#">Subtotal <span>CHF {{ Cart::subtotal() }}</span></a></li>
                            @if(session()->has('coupon'))
                            <li><a href="#">Discount ({{ session()->get('coupon')['name'] }}) <span>- {{ session()->get('coupon')['discount'] }} CHF</span></a></li>
                            <form action="{{ route('coupon.destroy')}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn" type="submit">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                            <li><a href="#">Tax <span>CHF {{ Cart::tax() }}</span></a></li>
                            <li><a href="#">Total <span>CHF {{ session()->has('coupon')
                            ? Cart::total() - session()->get('coupon')['discount']
                            : Cart::total()
                             }}</span></a></li>
                        </ul>
                        <div class="coupon my-3">
                            <div class="code">
                                <p>have a code ?</p>
                                <form action="{{ route('coupon.store') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="d-flex align-items-center contact_form">
                                        <input type="text" name="coupon" id="coupon" class="form-control" placeholder="Coupon code">
                                        <button class="primary-btn my-3" type="submit">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop


@section('js')

<script>

// This is your test publishable API key.
var stripe = Stripe("pk_test_51NJR4EJDJaWDRCqlp7pJKrSgwulk3TY85q7hHuUK8h7DbMg6UmR9NbFPl8ivZ4YJZ6XK6sUauKfr2FJ7IsnXjitA00qfrwyIq0");

var elements= stripe.elements();

var style = {
  base: {
    color:'#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    icolor: '#fa755a'
  }
};

var card = elements.create('card', {style: style});

card.mount('#card-element');

card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  }else {
    displayError.textContent = '';
  }
});

var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event){
  event.preventDefault();

  var options = {
    firstname: document.getElementById('firstname').value,
    lastname: document.getElementById('lastname').value,
    email: document.getElementById('email').value,
  }

  console.log(options)

  stripe.createToken(card, options).then(function (result) {
    if (result.error) {
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      stripeTokenHandler(result.token);
    }
  });
});

function stripeTokenHandler (token) {
   var form = document.getElementById('payment-form');
   var hiddenInput = document.createElement('input');
   hiddenInput.setAttribute('type', 'hidden');
   hiddenInput.setAttribute('name', 'stripeToken');
   hiddenInput.setAttribute('value', token.id);
   form.appendChild(hiddenInput);
   
   form.submit();
}
</script>

@stop