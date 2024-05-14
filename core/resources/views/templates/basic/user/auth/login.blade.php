@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $login = getContent('login.content', true);
    @endphp
    <section class="account">
        <div class="account-inner">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-9 col-sm-11">
                        <div class="account-form">
                            <div class="account-form__content mb-4">
                                <h3 class="account-form__title mb-2">{{ __(@$login->data_values->heading) }}</h3>
                                <p class="account-form__desc"> {{ __(@$login->data_values->subheading) }} </p>
                                @php
                                    $credentials = $general->socialite_credentials;
                                @endphp
                                @if ($credentials->google->status == Status::ENABLE || $credentials->facebook->status == Status::ENABLE || $credentials->linkedin->status == Status::ENABLE)
                                    <div class="col-12">
                                        <ul class="list list--row justify-content-center social-list">
                                            @if ($credentials->google->status == Status::ENABLE)
                                                <a href="{{ route('user.social.login', 'google') }}" class="btn with-google w-100">
                                                    <img src="{{ asset($activeTemplateTrue . 'images/socials/google.png') }}" alt="" class="icon"> @lang('Login with Google')
                                                </a>
                                            @endif
                                            @if ($credentials->facebook->status == Status::ENABLE)
                                                <a href="{{ route('user.social.login', 'facebook') }}" class="btn with-facebook w-100">
                                                    <img src="{{ asset($activeTemplateTrue . 'images/socials/facebook.png') }}" alt="" class="icon"> @lang('Login with Facebook')
                                                </a>
                                            @endif
                                            @if ($credentials->linkedin->status == Status::ENABLE)
                                                <a href="{{ route('user.social.login', 'linkedin') }}" class="btn with-linkedin w-100">
                                                    <img src="{{ asset($activeTemplateTrue . 'images/socials/linkedin.png') }}" alt="" class="icon"> @lang('Login with Linkedin')
                                                </a>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="account-form__or">@lang('OR')</div>
                                @endif
                            </div>
                            <form method="POST" action="{{ route('user.login') }}" class="verify-gcaptcha">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <label class="form--label">@lang('Username or Email')</label>
                                        <input type="text" class="form--control" name="username" value="{{ old('username') }}" required>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label for="your-password" class="form--label">@lang('Password')</label>
                                        <div class="position-relative">
                                            <input id="your-password" type="password" class="form--control" name="password" required>
                                        </div>
                                    </div>

                                    <x-captcha />

                                    <div class="col-sm-12 form-group">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    @lang('Remember Me')
                                                </label>
                                            </div>
                                            <a class="text--base" href="{{ route('user.password.request') }}">
                                                @lang('Forgot your password?')
                                            </a>
                                        </div>
                                    </div>


                                    <div class="col-sm-12 form-group">
                                        <button type="submit" class="btn btn--base w-100">@lang('Login')</button>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="have-account text-center">
                                            <p class="have-account__text">@lang('Haven\'t an account?')
                                                <a href="{{ route('user.register') }}" class="have-account__link text--base">@lang('Register')</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
