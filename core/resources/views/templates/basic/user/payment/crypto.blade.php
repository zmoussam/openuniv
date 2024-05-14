@extends($activeTemplate.'layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="custom--card card-deposit">
            <div class="card-header card-header-bg">
                <h5 class="card-title text-center">@lang('Payment Preview')</h5>
            </div>
            <div class="card-body card-body-deposit text-center">
                <h6 class="my-2"> @lang('PLEASE SEND EXACTLY') <span class="text--success"> {{ $data->amount }}</span> {{__($data->currency)}}</h6>
                <h5 class="mb-2">@lang('TO') <span class="text--success"> {{ $data->sendto }}</span></h5>
                <img src="{{$data->img}}" alt="@lang('Image')">
                <h4 class="text-white bold my-4">@lang('SCAN TO SEND')</h4>
            </div>
        </div>
    </div>
</div>
@endsection
