@extends($activeTemplate.'layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card custom--card">
            <div class="card-header">
                <h5 class="card-title text-center">@lang('Razorpay')</h5>
            </div>
            <div class="card-body p-5">
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item d-flex flex-wrap justify-content-between px-0">
                        @lang('You have to pay')
                        <strong>{{showAmount($deposit->final_amo)}} {{__($deposit->method_currency)}}</strong>
                    </li>
                </ul>
                    <form action="{{$data->url}}" method="{{$data->method}}">
                    <input type="hidden" custom="{{$data->custom}}" name="hidden">
                    <script src="{{$data->checkout_js}}"
                            @foreach($data->val as $key=>$value)
                            data-{{$key}}="{{$value}}"
                        @endforeach >
                    </script>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')
    <script>
        (function ($) {
            "use strict";
            $('input[type="submit"]').addClass("mt-4 btn btn--base w-100");
        })(jQuery);
    </script>
@endpush
