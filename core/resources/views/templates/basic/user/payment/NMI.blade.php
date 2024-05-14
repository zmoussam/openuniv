@extends($activeTemplate.'layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card custom--card">
            <div class="card-header">
                <h5 class="card-title text-center">@lang('NMI')</h5>
            </div>
            <div class="card-body">
                <form role="form" id="payment-form" method="{{$data->method}}" action="{{$data->url}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="form--label">@lang('Card Number')</label>
                            <div class="input-group">
                                <input type="tel" class="form-control form--control" name="billing-cc-number" autocomplete="off" value="{{ old('billing-cc-number') }}" required autofocus/>
                                <span class="input-group-text bg--base text-white border-0"><i class="fa fa-credit-card"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form--label">@lang('Expiration Date')</label>
                            <input type="tel" class="form--control" name="billing-cc-exp" value="{{ old('billing-cc-exp') }}" placeholder="e.g. MM/YY" autocomplete="off" required/>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form--label">@lang('CVC Code')</label>
                            <input type="tel" class="form--control" name="billing-cc-cvv" value="{{ old('billing-cc-cvv') }}" autocomplete="off" required/>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn--base btn-lg btn-block text-center w-100" type="submit"> @lang('Submit')</button>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
