@extends($activeTemplate . 'layouts.frontend')

@section('content')
    <section class="catalog-details-section section-bg py-60">
        <div class="container">
            <div class="card custom--card">
                <div class="card-body">
                    <h5 class="title">{{ __($product->name) }}</h5>
                    <hr>
                    <div class="row justify-content-between">
                        <div class="col-lg-4 col-md-5">
                            <div class="product-thumb p-4">
                                <img src="{{ getImage(getFilePath('product') . '/' . $product->image, getFileSize('product')) }}">
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-7">
                            <div class="product-top-info">
                                <div class="product-desc">
                                    @php echo $product->description; @endphp
                                </div>
                                <hr>
                                <div class="info-wrapper flex-align gap-3 pb-3">
                                    <p class="instock flex-align gap-2">@lang('In Stock') <span class="pcs d-block fs-14 fw-bold">{{ getAmount($product->in_stock) }} @lang('qty').</span></p>
                                    <p class="price flex-align gap-2">@lang('Per Quantity') <span class="amount d-block fs-14 fw-bold">{{ $general->cur_sym }}{{ showAmount($product->price) }}</span></p>
                                </div>
                                <div class="share-sell d-flex justify-content-between">
                                    <div class="selling-card">
                                        @if ($product->in_stock)
                                            <button class="btn btn--base purchaseBtn" data-text="{{ $product->name . ' | ' . strLimit(strip_tags($product->description), 270) }}" data-price="{{ showAmount($product->price) . ' ' . $general->cur_text }}" data-qty="{{ getAmount($product->in_stock) . ' qty' }}" data-id="{{ $product->id }}" data-amount="{{ getAmount($product->price) }}">
                                                <i class="las la-cart-plus"></i> @lang('Purchase Now')
                                            </button>
                                        @else
                                            <button class="btn btn--base mt-2 no-drop" disabled>
                                                <i class="las la-cart-plus"></i> @lang('Purchase Now')
                                            </button>
                                        @endif
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!blank($relatedProducts))
            <div class="related-products mt-5">
                <div class="catalog-item-wrapper">
                    <div class="catalog-item-wrapper__header d-flex align-items-center justify-content-between">
                        <h5 class="title mb-0">@lang('Related Products')</h5>
                    </div>
                    <hr>
                    @foreach ($relatedProducts as $product)
                        @include($activeTemplate . 'partials/products',['product'=>$product])
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>

    <x-purchase-modal />
@endsection
