@php
    $howWork = getContent('how_work.content', true);
    $howWorkElement = getContent('how_work.element', orderById: true);
@endphp
<section class="how-we-work section-bg py-120">
    <div class="container">
        <div class="section-heading">
            <span class="section-heading__subtitle">{{ __(@$howWork->data_values->heading) }} </span>
            <h2 class="section-heading__title">{{ __(@$howWork->data_values->subheading) }} </h2>
            <p class="section-heading__desc">{{ __(@$howWork->data_values->description) }}</p>
        </div>
        <div class="row gy-4 justify-content-center how-work-item-wrapper">
            @foreach ($howWorkElement as $item)
                <div class="col-lg-4 col-sm-6">
                    <div class="how-work-item">
                        <span class="how-work-item__icon flex-center">
                            @php
                                echo @$item->data_values->icon;
                            @endphp
                        </span>
                        <h5 class="how-work-item__title">{{ __(@$item->data_values->title) }}</h5>
                        <p class="how-work-item__desc">
                            {{ __(@$item->data_values->description) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
