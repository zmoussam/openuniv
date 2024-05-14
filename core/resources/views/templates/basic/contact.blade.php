@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $contactContent = getContent('contact_us.content', true);
    @endphp

    <section class="contact-section py-120">
        <div class="container">
            <div class="row align-items-center flex-wrap-reverse">
                <div class="col-lg-5 col-xl-4">
                    <h4 class="heading text--base">{{ __(@$contactContent->data_values->heading) }}</h4>
                    <p class="subheading mb-5">
                        {{ __(@$contactContent->data_values->subheading) }}
                    </p>
                    <div class="contact-info-wrapper row">
                        <div class="col-lg-12 col-md-6">
                            <div class="contact-info">
                                <span class="contact-info__icon"><i class="las la-envelope"></i></span>
                                <div class="contact-info__content">
                                    <h5 class="contact-info__title">@lang('Mail Us')</h5>
                                    <a href="mailto:{{ @$contactContent->data_values->email_address }}"
                                        class="contact-info__link">{{ @$contactContent->data_values->email_address }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <div class="contact-info">
                                <span class="contact-info__icon"><i class="las la-phone-volume"></i></span>
                                <div class="contact-info__content">
                                    <h5 class="contact-info__title">@lang('Phone')</h5>
                                    <a href="tel:{{ @$contactContent->data_values->contact_number }}"
                                        class="contact-info__link">{{ @$contactContent->data_values->contact_number }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <div class="contact-info">
                                <span class="contact-info__icon"><i class="las la-map-marker"></i></span>
                                <div class="contact-info__content">
                                    <h5 class="contact-info__title">@lang('Location')</h5>
                                    <p class="contact-info__desc">
                                        {{ __(@$contactContent->data_values->contact_details) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 offset-xl-1">
                    <div class="contact-form">
                        <form method="post" action="" class="verify-gcaptcha">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form--label">@lang('Name')</label>
                                        <input type="text" name="name" class="form--control"
                                            value="{{ old('name', @$user->fullname) }}"
                                            @if ($user) readonly @endif required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form--label">@lang('Email')</label>
                                        <input type="email" name="email" class="form--control"
                                            value="{{ old('email', @$user->email) }}"
                                            @if ($user) readonly @endif required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form--label">@lang('Subject')</label>
                                        <input type="text" name="subject" class="form--control"
                                            value="{{ old('subject') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form--label">@lang('Message')</label>
                                        <textarea class="form--control" name="message" required>{{ old('message') }}</textarea>
                                    </div>
                                </div>
                                <x-captcha />
                                <div class="col-sm-12">
                                    <div class="form-group mb-0">
                                        <button class=" btn btn--base w-100" type="submit">@lang('Send Message')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-map-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 px-0">
                    <div class="contact-map">
                        <iframe
                            src="https://maps.google.com/maps?q={{ @$contactContent->data_values->latitude }},{{ @$contactContent->data_values->longitude }}&hl=es;z=14&amp;output=embed"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection 