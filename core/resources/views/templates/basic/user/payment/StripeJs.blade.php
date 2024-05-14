@extends($activeTemplate.'layouts.master')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card custom--card">
            <div class="card-header">
                <h5 class="card-title text-center">@lang('Stripe Storefront')</h5>
            </div>
            <div class="card-body p-5">
                <form action="{{$data->url}}" method="{{$data->method}}">
                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item d-flex flex-wrap justify-content-between px-0">
                            @lang('You have to pay')
                            <strong>{{showAmount($deposit->final_amo)}} {{__($deposit->method_currency)}}</strong>
                        </li>
                    </ul>
                        <script src="{{$data->src}}"
                        class="stripe-button"
                        @foreach($data->val as $key=> $value)
                        data-{{$key}}="{{$value}}"
                        @endforeach
                    >
                    </script>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script-lib')
    <script src="https://js.stripe.com/v3/"></script>
@endpush
@push('script')
    <script>
        (function ($) {
            "use strict";
            $('button[type="submit"]').removeClass().addClass("btn btn--base w-100 mt-3").text("Pay Now");
        })(jQuery);
    </script>
@endpush
