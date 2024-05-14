@extends($activeTemplate . 'layouts.app')
@section('app')
    @include($activeTemplate . 'partials.header_top')
    @include($activeTemplate . 'partials.header_bottom')
    

    @if (request()->routeIs('home'))
        @include($activeTemplate . 'sections.banner')
    @endif

    @if (!request()->routeIs('home'))
        @include($activeTemplate . 'partials.breadcrumb')
    @endif
 
    @yield('content')

    <x-subscribe-modal />
    @include($activeTemplate . 'partials.footer')
@endsection
 