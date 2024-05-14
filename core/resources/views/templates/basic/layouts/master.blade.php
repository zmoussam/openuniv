@extends($activeTemplate . 'layouts.app')

@section('app')
    @include($activeTemplate . 'partials.header_auth')

    @include($activeTemplate . 'partials.breadcrumb')

    <div class="py-{{ request()->routeIs('user.home') ? '120' : '60' }}">
        <div class="container">
            @yield('content')
        </div>
    </div>

    @include($activeTemplate . 'partials.footer')
@endsection

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue.'js/jquery.validate.js') }}"></script> 
@endpush

@push('script')
<script>
    (function($) {
        "use strict"; 

        $('form').on('submit', function () {
            if(!$(this).hasClass('exclude')){
                if ($(this).valid()) {
                    $(':submit', this).attr('disabled', 'disabled');
                }
            }
        });

    })(jQuery);
</script>
@endpush