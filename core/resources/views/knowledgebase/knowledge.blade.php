@extends($activeTemplate . 'layouts.frontend')

@section('content')
<div class="main-container d-flex">
<div class="sidebar" id="side_nav">
    <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
        <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2"></span> <span class="text-white">@lang('Documentation')</span></h1>
        <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fas fa-stream"></i></button>
    </div>

    <ul class="list-unstyled px-2">
    <form action="{{ route('search.articles') }}" method="GET" class="input-group">
    <div class="form-outline" data-mdb-input-init>
        <input type="search" id="form1" class="form-control" name="search" placeholder="Search" />
    </div>
    <button type="submit" class="btn btn-primary" data-mdb-ripple-init>
        <i class="fas fa-search"></i>
    </button>
</form>
        @foreach($categories as $category)
            <li class="sidebar-item">
                <a href="#" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#{{ $category->id }}" aria-expanded="fasse" aria-controls="{{ $category->id }}">
                    <span>{{ $category->name }}</span>
                    <i class="fas fa-angle-down"></i>
                </a>
                <ul id="{{ $category->id }}" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#side_nav">
                    @foreach($category->articles as $article)
                        <li>
                            <a href="{{ route('knowledge', ['id' => $article->id]) }}" class="text-decoration-none px-3 py-2 d-block">{{ $article->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>

<div class="content">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between d-md-none d-block">
                <button class="btn px-1 py-0 open-btn me-2"><i class="fas fa-stream"></i></button>
                <a class="navbar-brand fs-4" href="#"><span class="bg-dark rounded px-2 py-0 text-white"></span></a>
            </div>
            <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="fasse" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">

                </ul>
            </div>
        </div>
    </nav>
    <div class="dashboard-content px-3 pt-4">
            <p>{!! $art->description !!}</p>
        </div>
</div>

</div>
@endsection

@push('script')
<script>
$(".sidebar ul li").on('click', function () {
        $(".sidebar ul li.active").removeClass('active');
        $(this).addClass('active');
    });

    $('.open-btn').on('click', function () {
        $('.sidebar').addClass('active');
    });

    $('.close-btn').on('click', function () {
        $('.sidebar').removeClass('active');
    });

    // Add this code block to handle the has-dropdown class
    $('.sidebar-link.has-dropdown').on('click', function (e) {
        e.preventDefault();
        $(this).parent().toggleClass('active');
        $(this).next('.sidebar-dropdown').slideToggle();
    });
</script>
@endpush


@push('style')
<style>
    #side_nav{
background-color: hsl(var(--base));
 min-width: 250px;
 max-width: 250px;
 transition: all 0.3s;
}
.content{
   min-height: 100vh;
   width: 100%;
}
hr.h-color{
  background: #eee;
}

.sidebar li.active{
   background: #eee;
   border-radius: 8px;
}

.sidebar li.active a, .sidebar li.active a:hover {
 color: #000;
}
.sidebar li a{
 color: #fff;
}

@media(max-width: 767px){
 #side_nav{
   margin-left: -250px;
   position: absolute;
   min-height: 100vh;
   z-index: 1;

 }
 #side_nav.active{
   margin-left: 0;
  }
}

    /* Add this style for centering the dashboard content */
    .dashboard-content {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
    }
    .article-description {
    text-align: justify;
}

/search form/
.input-group {
    background-color: hsl(var(--base));
    border-radius: 8px; 
    padding: 10px;
}

.form-outline {
    flex: 1; 
    margin-right: 10px; 
}

.form-label {
    color: #fff;
}

.btn-primary {
    background-color: var(--base); 
    border-color: var(--base); 
    color: #fff; 
    border-radius: 8px; 
    padding: 5px; 
}


</style>
@endpush