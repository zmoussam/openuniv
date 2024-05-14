<header class="header" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo d-lg-none d-block" href="{{ route('home') }}">
                <img src="{{ getImage(getFilePath('logoIcon') . '/dark_logo.png') }}" alt="@lang('image')">
            </a>
            {{--
            <button type="submit" class="search-box-popup-btn d-none">
                <i class="las la-search"></i>
            </button> --}}

            <div class="search-box style-two w-100 d-lg-none d-block">
                <form action="" class="search-form">
                    <input type="text" class="form--control pill exclude" name="search" placeholder="Search..." id="mobile-search" @if (request()->routeIs('products') || request()->routeIs('category.products')) value="{{ request()->search }}" @endif>
                    <button type="submit" class="search-box__button">
                        <span class="icon"><i class="las la-search"></i></span>
                    </button>
                </form>
            </div>

            {{-- @if ($categories->count())
                <div class="category-nav">
                    <button class="category-nav__button">
                        <span class="icon me-1"><img src="{{ asset($activeTemplateTrue . 'images/icons/grid.png') }}" alt="@lang('image')"></span><span class="search-text">@lang(' Category')</span>
                        <span class="arrow"><i class="las la-angle-down"></i></span>
                    </button>
                    <ul class="dropdown--menu">
                        @foreach ($categories as $category)
                            <li class="dropdown--menu__item">
                                <a href="{{ route('category.products', ['slug' => slug($category->name), 'id' => $category->id]) }}" class="dropdown--menu__link">
                                    {{ strLimit($category->name, 18) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            <button class="navbar-toggler header-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span id="hiddenNav"><i class="las la-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-menu ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">@lang('Home')</a>
                    </li>

                    @php
                        $pages = App\Models\Page::where('tempname', $activeTemplate)
                            ->where('is_default', Status::NO)
                            ->get();
                    @endphp

                    @foreach ($pages as $k => $data)
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a>
                        </li>
                    @endforeach

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}">@lang('Product')</a>
                    </li>
                    
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('knowledge') }}">@lang('Help Center')</a>
                    </li>
                   

                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog') }}">@lang('Blog')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">@lang('Contact')</a>
                    </li>
                    <li class="nav-item d-lg-none d-flex justify-content-between align-items-end">
                        <div class="accounts-buttons d-flex align-items-center">
                            @auth
                                <a href="{{ route('user.logout') }}" class="accounts-buttons__link">
                                    <span class="icon fs-14 me-1"><i class="fas fa-sign-out-alt"></i></span>@lang('Logout')
                                </a>
                            @else
                                <a href="{{ route('user.login') }}" class="accounts-buttons__link">
                                    <span class="icon fs-14 me-1"><i class="fas fa-sign-in-alt"></i></span> @lang('Login')
                                </a>
                            @endauth

                            @auth
                                <a href="{{ route('user.home') }}" class="btn btn--base btn--sm">
                                    <span class="icon fs-14 me-1"><i class="fas fa-home"></i></span> @lang('Dashboard')
                                </a>
                            @else
                                <a href="{{ route('user.register') }}" class="btn btn--base btn--sm">
                                    <span class="icon fs-14 me-1"><i class="fas fa-user-plus"></i></span> @lang('Register')
                                </a>
                            @endauth
                        </div>
                        @if ($general->multi_language)
                            @php
                                $language = App\Models\Language::all();
                            @endphp
                            <div class="language-box">
                                <select class="langSel form-control form-select">
                                    <option value="">@lang('Select One')</option>
                                    @foreach ($language as $item)
                                        <option value="{{ $item->code }}" @if (session('lang') == $item->code) selected @endif>{{ __($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>

@push('style')
    <style>
        @media screen and (max-width:992px) {
            .navbar {
                gap: 20px;
            }

            .navbar-brand {
                flex: 1 1 calc(77% - 40px);
            }

            .search-box {
                order: 4;
                width: auto !important;
                max-width: unset !important;
                flex: 1 1 50%;
            }

            .category-nav {
                width: 26%;
                order: 3;
                min-width: max-content;
                text-align: left;
            }
        }

        .navbar .search-box {
            max-width: 100%;
            position: relative;
            top: 100%;
            visibility: visible;
            opacity: 1;
            transition: all ease 250ms;
            z-index: 9;
            margin-top: 0;
        }

        @media screen and (max-width: 470px) {
            .navbar {
                gap: 15px;
                column-gap: 10px;
            }
        }

        @media screen and (max-width: 424px) {
            .dropdown--menu {
                width: 180px;
                left: 0;
                right: 0;
            }
        }

        @media screen and (max-width: 374px) {
            .navbar-brand {
                flex: 1 1 calc(77% - 0px);
            }

            .search-text {
                display: none;
            }

            .category-nav {
                width: 10%;
            }

            .category-nav__button .icon {
                margin-right: 0 !important;
            }

            .category-nav .arrow {
                display: none;
            }
        }
    </style>
@endpush
