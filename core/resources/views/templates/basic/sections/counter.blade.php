@php
    $counters = getContent('counter.element', orderById: true);
@endphp
<div class="counter bg-img py-60" data-background-image="{{ asset($activeTemplateTrue . 'images/thumbs/counter-bg.jpg') }}">
    <div class="container">
        <div class="row">
            @foreach ($counters as $counter)
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-item text-center">
                        <h1 class="counter-item__number mb-0">
                            <span>{{ @$counter->data_values->digit }}</span>
                        </h1>
                        <span class="counter-item__text">{{ __(@$counter->data_values->title) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
