@php
    $feature = getContent('feature.content', true);
    $featureElement = getContent('feature.element', orderById: true);
@endphp
<section class="features py-120">
    <div class="container">
        <div class="section-heading">
            <span class="section-heading__subtitle">{{ __(@$feature->data_values->heading) }} </span>
            <h2 class="section-heading__title">{{ __(@$feature->data_values->subheading) }}</h2>
            <p class="section-heading__desc">{{ __(@$feature->data_values->description) }}</p>
        </div>
        <div class="row gy-4 justify-content-center feature-item-wrapper">
            @foreach ($featureElement as $item)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="feature-item">
                        <span class="feature-item__number">{{ $loop->iteration }}</span>
                        <span class="feature-item__icon flex-center">@php echo @$item->data_values->icon @endphp </span>
                        <h5 class="feature-item__title">{{ __(@$item->data_values->title) }}</h5>
                        <p class="feature-item__desc">{{ __(@$item->data_values->description) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
