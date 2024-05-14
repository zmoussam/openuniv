@extends($activeTemplate . 'layouts.frontend')

@section('content')
<section class="catalog-section section-bg py-{{ @$products->count() ? 120 : 60 }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-10 col-xl-11">
                <div class="catalog-item-wrapper">
                    @forelse($products as $product)
                        @include($activeTemplate.'partials/products')
                    @empty
                    <div class="empty-data text-center">
                        <div class="thumb">
                            <img src="{{ asset($activeTemplateTrue . 'images/not-found.png') }}">
                        </div>
                        <h4 class="title">@lang('No result found for "'.$category->name.'"')</h4>
                    </div>
                    @endforelse
                    {{ paginateLinks($products) }}
                </div>
            </div>
        </div>
    </div>
</section>


@if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif

<x-purchase-modal />
@endsection



