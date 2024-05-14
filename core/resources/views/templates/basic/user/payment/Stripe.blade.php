@extends($activeTemplate.'layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="custom--card card-deposit">
            <div class="card-header">
                <h5 class="card-title text-center">@lang('Stripe Payment')</h5>
            </div>
            <div class="card-body card-body-deposit">
                <div class="card-wrapper"></div>
                <br><br>
                <form role="form" id="payment-form" method="{{$data->method}}" action="{{$data->url}}">
                    @csrf
                    <input type="hidden" value="{{$data->track}}" name="track">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="form--label" for="name">@lang('Name on Card')</label>
                            <div class="input-group">
                                <input type="text" class="form-control form--control custom-input" name="name" placeholder="@lang('Name on Card')" autocomplete="off" autofocus/>
                                <span class="input-group-text bg--base text-white border-0"><i class="fa fa-font"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form--label" for="cardNumber">@lang('Card Number')</label>
                            <div class="input-group">
                                <input type="tel" class="form-control form--control custom-input" name="cardNumber" placeholder="@lang('Valid Card Number')" autocomplete="off" required autofocus/>
                                <span class="input-group-text bg--base text-white border-0"><i class="fa fa-credit-card"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form--label" for="cardExpiry">@lang('Expiration Date')</label>
                            <input type="tel" class="form--control input-sz custom-input" name="cardExpiry" placeholder="@lang('MM / YYYY')" autocomplete="off" required/>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form--label" for="cardCVC">@lang('CVC Code')</label>
                            <input type="tel" class="form--control input-sz custom-input" name="cardCVC" placeholder="@lang('CVC')" autocomplete="off" required/>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn--base btn-lg btn-block text-center w-100" type="submit">@lang('PAY NOW')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')
    <script src="{{ asset('assets/global/js/card.js') }}"></script>

    <script>
        (function ($) {
            "use strict";
            var card = new Card({
                form: '#payment-form',
                container: '.card-wrapper',
                formSelectors: {
                    numberInput: 'input[name="cardNumber"]',
                    expiryInput: 'input[name="cardExpiry"]',
                    cvcInput: 'input[name="cardCVC"]',
                    nameInput: 'input[name="name"]'
                }
            });
        })(jQuery);
    </script>
@endpush
