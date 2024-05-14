@extends($activeTemplate . 'layouts.frontend')

@section('content')
    <section class="blog-details py-120 overflow-hidden">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-8 pe-xl-5 pe-lg-4">
                    <div class="blog-details">
                        <div class="blog-details__thumb">
                            <img src="{{ getImage('assets/images/frontend/blog/' . @$blog->data_values->image, '820x550') }}" alt="@lang('image')">
                        </div>
                        <div class="blog-details__meta">
                            <span class="blog-details__meta-item"><i class="las la-calendar-alt"></i> {{ $blog->created_at->format('d M, Y') }}</span>
                        </div>
                        <div class="blog-details__content">
                            <h3 class="blog-details__title">{{ __($blog->data_values->title) }}</h3>
                            <p class="blog-details__desc">
                                @php
                                    echo $blog->data_values->description;
                                @endphp
                            </p>
                        </div>
                        <div class="blog-details__share mt-4 d-flex align-items-center flex-wrap">
                            <h6 class="social-share__title mb-0 me-sm-3 me-1 d-inline-block">@lang('Share'):</h6>
                            <ul class="social-list">
                                <li class="social-list__item"><a class="social-list__link flex-center" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li class="social-list__item"><a class="social-list__link flex-center" target="_blank" href="https://twitter.com/intent/tweet?text=my share text&amp;url={{ urlencode(url()->current()) }}"> <i class="fab fa-twitter"></i></a>
                                </li>
                                <li class="social-list__item"><a class="social-list__link flex-center" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}&amp;title=my share text&amp;summary=dit is de linkedin summary"> <i class="fab fa-linkedin-in"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="fb-comments" data-href="{{ route('blog.details', [slug($blog->data_values->title), $blog->id]) }}" data-numposts="5"></div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-sidebar">
                        <div class="blog-sidebar__item">
                            <h5 class="blog-sidebar__title">@lang('Latest Blog')</h5>
                            @foreach ($latestBlogs as $latestBlog)
                                <div class="latest-blog">
                                    <div class="latest-blog__thumb">
                                        <a href="{{ route('blog.details', [slug($latestBlog->data_values->title), $latestBlog->id]) }}"> <img src="{{ getImage('assets/images/frontend/blog/thumb_' . @$latestBlog->data_values->image, '410x275') }}" alt="@lang('image')"></a>
                                    </div>
                                    <div class="latest-blog__content">
                                        <h6 class="latest-blog__title">
                                            <a href="{{ route('blog.details', [slug($latestBlog->data_values->title), $latestBlog->id]) }}">{{ __($latestBlog->data_values->title) }}</a>
                                        </h6>
                                        <span class="latest-blog__date">{{ $latestBlog->created_at->format('d M, Y') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('fbComment')
    @php echo loadExtension('fb-comment') @endphp
@endpush
