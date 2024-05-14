@php
    $about = getContent('about.content', true);
    $aboutElement = getContent('about.element', orderById: true);
@endphp
<section class="about-us py-5">
    <div class="container">
        <div class="row gy-4 align-items-center flex-wrap-reverse">
            <div class="col-lg-6 col-md-10 ">
                <div class="about-us__thumb">
                    <img src="{{ getImage('assets/images/frontend/about/' . @$about->data_values->image, '465x400') }}" alt="@lang('image')">
                </div>
            </div>
            <div class="col-lg-6 pe-xl-5">
                <div class="about-content">
                    <div class="section-heading style-left">
                        <span class="section-heading__subtitle">{{ __(@$about->data_values->heading) }}</span>
                        <h2 class="section-heading__title">{{ __(@$about->data_values->subheading) }}</h2>
                        <p class="section-heading__desc">
                            @php
                                echo @$about->data_values->description;
                            @endphp
                        </p>
                    </div>
                    <ul class="text-list">
                        @foreach ($aboutElement as $item)
                            <li class="text-list__item flex-wrap">
                                <span class="icon"> <i class="fas fa-check-circle"></i> </span>
                                <span class="text fs-15">{{ __(@$item->data_values->title) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
