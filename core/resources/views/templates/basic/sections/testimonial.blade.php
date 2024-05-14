@php
    $testimonial = getContent('testimonial.content', true);
    $testimonials = getContent('testimonial.element', orderById: true);
@endphp
<section class="testimonials section-bg py-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-heading">
                    <span class="section-heading__subtitle">{{ __(@$testimonial->data_values->heading) }}</span>
                    <h2 class="section-heading__title">{{ __(@$testimonial->data_values->subheading) }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonails owl-carousel">
                    @foreach ($testimonials as $item)
                        <div class="testimonial-item">
                            <p class="testimonial-item__desc">
                                {{ __(@$item->data_values->quote) }}
                            </p>
                            <div class="testimonial-item__author">
                                <div class="testimonial-item__author-thumb">
                                    <img src="{{ getImage('assets/images/frontend/testimonial/' . @$item->data_values->image, '60x60') }}" alt="@lang('image')">
                                </div>
                                <h6 class="testimonial-item__author-name"> {{ __(@$item->data_values->name) }}</h6>
                                <span class="testimonial-item__author-designation"> {{ __(@$item->data_values->designation) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
