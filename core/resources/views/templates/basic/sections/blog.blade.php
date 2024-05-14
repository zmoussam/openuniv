@php
    $blogContent = getContent('blog.content', true);
    $blogs = getContent('blog.element', null, 3, false);
@endphp
<section class="blog py-120">
    <div class="container"> 
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-heading">
                    <span class="section-heading__subtitle">{{ __(@$blogContent->data_values->heading) }}</span>
                    <h2 class="section-heading__title">{{ __(@$blogContent->data_values->subheading) }}</h2>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach ($blogs as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-item">
                        <div class="blog-item__thumb">
                            <img src="{{ getImage('assets/images/frontend/blog/thumb_' . @$blog->data_values->image, '410x275') }}" alt="@lang('image')">
                        </div>
                        <div class="blog-item__content">
                            <span class="blog-item__meta"><i class="las la-calendar-week"></i>{{ $blog->created_at->format('d M, Y') }}</span>
                            <h4 class="blog-item__title">
                                <a class="blog-item__title-link" href="{{ route('blog.details', [slug($blog->data_values->title), $blog->id]) }}">{{ __(@$blog->data_values->title) }}</a>
                            </h4>
                            <p class="blog-item__desc">
                                @php
                                    echo strLimit(strip_tags($blog->data_values->description), 40);
                                @endphp
                            </p>
                            <a href="{{ route('blog.details', [slug($blog->data_values->title), $blog->id]) }}" class="blog-item__link">@lang('Read More') <i class="las la-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
