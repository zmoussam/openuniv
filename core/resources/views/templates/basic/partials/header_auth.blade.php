<header class="header" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo" href="{{ route('home') }}">
                <img src="{{ getImage(getFilePath('logoIcon') . '/dark_logo.png') }}" alt="@lang('image')">
            </a>
            <button class="navbar-toggler header-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span id="hiddenNav"><i class="las la-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-menu ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('user.home') }}">@lang('Dashboard')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.deposit.history') }}">@lang('Payments')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.orders') }}">@lang('Orders')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}">@lang('Products')</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                    <a href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="nav-item" src="{{ getImage(getFilePath('logoIcon') . '/avatar3.png') }}" alt="Image"> 
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="right: 0;margin-top:20px;position: fixe ;" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('user.profile.setting') }}"><i class="fas fa-user"></i> @lang('Profile')</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.change.password') }}"><i class="fas fa-key"></i> @lang('Change Password')</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt"></i> @lang('Logout')</a></li>
                            <li><a class="dropdown-item" href="{{ route('ticket.open') }}"><i class="las la-question-circle"></i> @lang('Support')</a></li>
                    </ul>
                    </li>    
                </ul>
            </div>
        </nav>
    </div>
</header>


@push('style')
<style>
    .nav-menu .nav-item .nav:nth-last-child(2){
        padding-right: 30px;
    }
    .navbar-nav .nav-item:nth-last-child(2) {
        padding-right: 30px;
    }
    @media screen and (max-width: 991px) {
        .nav-menu .nav-item:nth-last-child(2){
            padding-right: 0px;
        }
    }
.dropdown-menu{
    position: absolute;
    inset: 0px 0px auto auto;
    margin: 0px;
    transform: translate(0px, 39px);
    border-radius: 5px;
}
.navbar-nav img {
    width: 40px; 
    height: 40px; 
    border-radius: 50%; 
    margin-right: 10px; 
}

.navbar-nav span {
    font-weight: bold; 
}

.dropdown-menu .dropdown-item  {
    border-bottom: 1px solid #e5e5e5;
    padding: 5px 15px;
}
.dropdown-menu .dropdown-item i {
    margin-right: 10px; 

}
img {
    overflow-clip-margin: content-box;
    over
    overflow: clip;
}

</style>
@endpush