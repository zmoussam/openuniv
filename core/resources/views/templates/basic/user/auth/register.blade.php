@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $policyPages = getContent('policy_pages.element', false, null, true);
        $register = getContent('register.content', true);
    @endphp
    <section class="account">
        <div class="account-inner">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-7 col-xl-6">
                        <div class="account-form">
                            <div class="account-form__content mb-4">
                                <h3 class="account-form__title mb-2">{{ __(@$register->data_values->heading) }}</h3>
                                <p class="account-form__desc"> {{ __(@$register->data_values->subheading) }} </p>
                                @php
                                    $credentials = $general->socialite_credentials;
                                @endphp
                                @if ($credentials->google->status == Status::ENABLE || $credentials->facebook->status == Status::ENABLE || $credentials->linkedin->status == Status::ENABLE)
                                    <div class="col-12">
                                        <ul class="list list--row justify-content-center social-list">
                                            @if ($credentials->google->status == Status::ENABLE)
                                                <a href="{{ route('user.social.login', 'google') }}" class="btn with-google w-100">
                                                    <img src="https://cdn-icons-png.flaticon.com/128/300/300221.png" alt="" class="icon"> @lang('Login with Google')
                                                </a>
                                            @endif
                                            @if ($credentials->facebook->status == Status::ENABLE)
                                                <a href="{{ route('user.social.login', 'facebook') }}" class="btn with-facebook w-100">
                                                    <img src="https://cdn-icons-png.flaticon.com/128/5968/5968764.png" alt="" class="icon"> @lang('Login with Facebook')
                                                </a>
                                            @endif
                                            @if ($credentials->linkedin->status == Status::ENABLE)
                                                <a href="{{ route('user.social.login', 'linkedin') }}" class="btn with-linkedin w-100">
                                                    <img src="https://cdn-icons-png.flaticon.com/128/2111/2111499.png" alt="" class="icon"> @lang('Login with Linkedin')
                                                </a>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="account-form__or">@lang('OR')</div>
                                @endif
                            </div>
                            <form action="{{ route('user.register') }}" method="POST" class="verify-gcaptcha">
                                @csrf

                                <div class="row">
                                    @if (session()->get('reference') != null)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="referenceBy" class="form--label">@lang('Reference by')</label>
                                                <input type="text" name="referBy" id="referenceBy" class="form--control" value="{{ session()->get('reference') }}" readonly>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form--label">@lang('Username')</label>
                                            <input type="text" class="form--control checkUser" name="username" value="{{ old('username') }}" required>
                                            <small class="text-danger usernameExist"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form--label">@lang('E-Mail Address')</label>
                                            <input type="email" class="form--control checkUser" name="email" value="{{ old('email') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form--label">@lang('Country')</label>
                                            <select name="country" class="form--control">
                                                @foreach ($countries as $key => $country)
                                                    <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}">{{ __($country->country) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form--label">@lang('Mobile')</label>
                                            <div class="input-group ">
                                                <span class="input-group-text mobile-code">

                                                </span>
                                                <input type="hidden" name="mobile_code">
                                                <input type="hidden" name="country_code">
                                                <input type="number" name="mobile" value="{{ old('mobile') }}" class="form-control form--control checkUser" required>
                                            </div>
                                            <small class="text-danger mobileExist"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form--label">@lang('Password')</label>
                                            <input type="password" class="form--control @if ($general->secure_password) secure-password @endif" name="password" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form--label">@lang('Confirm Password')</label>
                                            <input type="password" class="form--control" name="password_confirmation" required>
                                        </div>
                                    </div>

                                    <x-captcha />

                                </div>

                                @if ($general->agree)
                                    <div class="form-group">
                                        <input type="checkbox" id="agree" @checked(old('agree')) name="agree" required>
                                        <label for="agree">@lang('I agree with')</label> <span>
                                            @foreach ($policyPages as $policy)
                                                <a href="{{ route('policy.pages', [slug($policy->data_values->title), $policy->id]) }}" target="_blank" class="text--base">
                                                    {{ __($policy->data_values->title) }}
                                                </a>@if (!$loop->last), @endif
                                            @endforeach
                                        </span>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <button type="submit" id="recaptcha" class="btn btn--base w-100"> @lang('Register')</button>
                                </div>
                                <p class="mb-0 text-center">@lang('Already have an account?') 
                                    <a href="{{ route('user.login') }}" class="have-account__link text--base">@lang('Login')</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h6 class="modal-title method-name">@lang('You are with us')</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>@lang('You already have an account please Login')</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('user.login') }}" class="btn btn-sm btn--base w-100">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        .country-code .input-group-text {
            background: #fff !important;
        }

        .country-code select {
            border: none;
        }

        .country-code select:focus {
            border: none;
            outline: none;
        }
    </style>
@endpush
@if ($general->secure_password)
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif
@push('script')
    <script>
        "use strict";
        (function($) {
            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
