@extends($activeTemplate . 'layouts.app')

@php
    $banned = @getContent('banned.content', true)->data_values;
@endphp

@section('app')
    <div class="banned-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8 col-12 text-center">
                    <div class="ban-section">
                        <h4 class="text-center text-danger mb-4">
                            {{ __(@$banned->heading) }}
                        </h4>
                        <img src="{{ getImage('assets/images/frontend/banned/' . @$banned->image) }}" alt="@lang('Banned Image')">
                        <div class="mt-4">
                            <p class="fw-bold mb-2">@lang('Reason')</p>
                            <p>{{ __($user->ban_reason) }}</p>
                        </div>
                        <a href="{{ route('home') }}" class="btn btn--base mt-4 btn--sm">
                            <i class="las la-undo"></i>
                            @lang('Go Back')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .banned-section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
@endpush
