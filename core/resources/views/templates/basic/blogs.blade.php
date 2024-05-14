@extends($activeTemplate . 'layouts.frontend')
@section('content')

    <section class="blog py-120">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                @forelse ($blogs as $blog)
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
                @empty 
                    <h4 class="text-center">{{ __($emptyMessage) }}</h4>
                @endforelse
            </div>
            {{ paginateLinks($blogs) }}
        </div>
    </section>

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
