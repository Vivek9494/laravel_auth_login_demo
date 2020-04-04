@extends('layouts.app')
@section('title','Add Card')

@section('stylesheet')
    <link href="{{ url('css/custom.css') }}" rel="stylesheet">
@endsection

@section('logout')
    <a href="{{route('logout')}}" id="logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection

@section('content')
<div id="login">
    <h3 class="text-center text-white pt-5">Stripe</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="signup-box" class="col-md-12">
                    <form role="form" action="{{ route('stripe.update',$id) }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label id="card_name_label" for="card_name" class="text-info">Name</label><br>
                            <input type="text" name="card_name" id="card_name" class="form-control required" value="">
                            <p class="error">@error('card_name') {{$message}} @enderror</p>
                        </div>
                        <div class="form-group">
                            <label id="card_number_label" for="card_number" class="text-info">Card Number</label><br>
                            <input type="text" name="card_number" id="card_number" class="form-control required" value="" maxlength="16">
                            <p class="error">@error('card_number') {{$message}} @enderror</p>
                        </div>

                        <div class="form-group">
                            <label id="cvv_label" for="cvv" class="text-info">CVC</label><br>
                            <input type="text" name="cvv" id="cvv" class="form-control required col-md-4" value="" maxlength="4">
                            <p class="error">@error('cvv') {{$message}} @enderror</p>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label id="exp_month_label" for="exp_month" class="text-info">Exp Month</label><br>
                                <input type="text" name="exp_month" id="exp_month" class="form-control required" value="" maxlength="2" placeholder="MM">
                                <p class="error">@error('exp_month') {{$message}} @enderror</p>
                            </div>
                            <div class="col-md-4">
                                <label id="exp_year_label" for="exp_year" class="text-info">Exp Year</label><br>
                                <input type="text" name="exp_year" id="exp_year" class="form-control required" value="" maxlength="4" placeholder="YYYY">
                                <p class="error">@error('exp_year') {{$message}} @enderror</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Create Stripe Account</button>
                        </div>
                        
                    </form>
                </div>        
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    
    <script type="text/javascript">
        $(function() {
            var $form         = $(".require-validation");
            $('form.require-validation').on('submit', function(e) {
                $('.required').each(function () {
                    var element_value = $(this).val();
                    var element = $(this).attr('id');
                    var label = $('#'+element+'_label').text();
                    if(element_value == ''){
                        $(this).next().text('Please Enter '+label);
                    }

                    if(element == 'name'){
                        var regex = /^[a-zA-Z\s]+$/;
                        if(!regex.test(element_value)){
                            $(this).next().text('Please Enter Valid '+label);
                        }
                    }
                });
            
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('#card_number').val(),
                        cvc: $('#cvc').val(),
                        exp_month: $('#exp_month').val(),
                        exp_year: $('#exp_year').val()
                    }, stripeResponseHandler);
                }
            });
        
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        
        });
    </script>
@endsection