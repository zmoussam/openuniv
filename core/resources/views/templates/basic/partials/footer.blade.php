@php
    $footerContent = getContent('footer.content', true);
    $policyPages = getContent('policy_pages.element', orderById: true);
    $socials = getContent('social_icon.element', orderById: true);
    $contact = getContent('contact_us.content', true);
@endphp
<footer class="footer-area">
    <div class="pb-60 pt-120"> 
        <div class="container">
            <div class="row justify-content-center gy-5">
                <div class="col-xl-4 col-sm-6 col-xsm-6">
                    <div class="footer-item">
                        <div class="footer-item__logo">
                            <a href="{{ route('home') }}"> <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="@lang('image')"></a>
                        </div>
                        <p class="footer-item__desc">{{ __(@$footerContent->data_values->description) }}</p>
                        <ul class="social-list">
                            @foreach ($socials as $social)
                                <li class="social-list__item">
                                    <a href="{{ @$social->data_values->url }}" class="social-list__link flex-center" target="_blank">
                                        @php echo $social->data_values->social_icon @endphp
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-xsm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Useful Links')</h5>
                        <ul class="footer-menu">
                            <li class="footer-menu__item"><a href="{{ route('products') }}" class="footer-menu__link">@lang('Product')</a></li>
                            <li class="footer-menu__item"><a href="{{ route('user.login') }}" class="footer-menu__link">@lang('Login')</a></li>
                            <li class="footer-menu__item"><a href="{{ route('user.register') }}" class="footer-menu__link">@lang('Register') </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-xsm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Resources')</h5>
                        <ul class="footer-menu">
                            <li class="footer-menu__item"><a href="{{ route('blog') }}" class="footer-menu__link">@lang('Blog') </a></li>
                            <li class="footer-menu__item"><a href="{{ route('contact') }}" class="footer-menu__link">@lang('Contact Us') </a></li>
                            <li class="footer-menu__item"><a href="{{ route('cookie.policy') }}" class="footer-menu__link">@lang('Cookie Policy') </a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-xsm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Contact Us')</h5>
                        <ul class="footer-contact-menu">
                            <li class="footer-contact-menu__item">
                                <div class="footer-contact-menu__item-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="footer-contact-menu__item-content">
                                    <p>{{ __(@$contact->data_values->contact_details) }}</p>
                                </div>
                            </li>
                            <li class="footer-contact-menu__item">
                                <div class="footer-contact-menu__item-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="footer-contact-menu__item-content">
                                    <p>{{ __(@$contact->data_values->email_address) }}</p>
                                </div>
                            </li>
                            <li class="footer-contact-menu__item">
                                <div class="footer-contact-menu__item-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="footer-contact-menu__item-content">
                                    <p>{{ __(@$contact->data_values->contact_number) }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-footer py-3">
        <div class="container">
            <div class="row gy-3">
                <div class="col-sm-6">
                    <div class="bottom-footer__text"> &copy; @lang('Copyright') @php echo date('Y') @endphp . @lang('All rights reserved').</div>
                </div>
                <div class="col-sm-6">
                    <div class="bottom-footer__menu d-flex align-items-end justify-content-end">
                        @foreach ($policyPages as $policy)
                            <a href="{{ route('policy.pages', [slug(@$policy->data_values->title), @$policy->id]) }}" class="bottom-footer__link">
                                {{ __(@$policy->data_values->title) }} 
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
