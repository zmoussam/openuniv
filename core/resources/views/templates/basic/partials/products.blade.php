<div class="col-md-4 {{ Str::slug($product->expiry_period, '_') }}">
    <div class="card">
        <div class="text-center">
            @if ($product->image)
                <img style="max-width: 200px;height: 200px;"
                    src="{{ getImage(getFilePath('product') . '/' . $product->image, getFileSize('product')) }}"
                    alt="@lang('image')">
            @endif
        </div>
        @php
            $name_prod = json_decode($product->name_lang ?? '{}', true);
            if (isset($name_prod[session('lang')]) && ($name_prod[session('lang')] != '')) {
                $product->name = $name_prod[session('lang')];
            }

            $description_prod = array_content_to_string(json_decode($product->description_lang ?? '{}', true));
            if (isset($description_prod[session('lang')]) && ($description_prod[session('lang')] != '')) {
                $product->description = $description_prod[session('lang')];
            }
        @endphp
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="prcing">
                {{ showAmount($product->price) }}{{ $general->cur_sym }} / {{ $product->expiry_period }}
            </p>
            <p class="card-text">{!! $product->description !!}</p>
            <div class="accordion accordion-flush" id="accordionFlush_{{ $product->id }}">
                @php $index = 0; @endphp
                @foreach (json_decode($product->attr ?? '{}') as $attr)
                    @php
                        $attribute = App\Models\ProductAttributes::where('id', $attr->id)
                            ->where('status', 1)
                            ->first();
                        if (!$attribute) {
                            continue;
                        }
                        $lang_attr = json_decode($attribute->lang ?? '{}', true);
                        if (isset($lang_attr[session('lang')])) {
                            if ($lang_attr[session('lang')]['name'] && $lang_attr[session('lang')]['description']) {
                                $attribute->name = $lang_attr[session('lang')]['name'];
                                $attribute->description = $lang_attr[session('lang')]['description'];
                            }
                        }
                    @endphp
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading_{{ $product->id . '_' . $index }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collaps_{{ $product->id . '_' . $index }}" aria-expanded="false"
                                aria-controls="flush-collaps_{{ $product->id . '_' . $index }}">
                                @if ($attr->status == 1)
                                    <i class="me-2 las la-check-circle fs-5 text-white bg-success rounded-pill"></i>
                                @else
                                    <i class="me-2 las la-times fs-5 text-white bg-danger rounded-pill"></i>
                                @endif
                                {{ $attribute->name }}
                            </button>
                        </h2>
                        <div id="flush-collaps_{{ $product->id . '_' . $index }}" class="accordion-collapse collapse"
                            aria-labelledby="flush-heading_{{ $product->id . '_' . $index }}"
                            data-bs-parent="#accordionFlush_{{ $product->id }}">
                            <div class="accordion-body">
                                {{ $attribute->description }}
                            </div>
                        </div>
                    </div>
                    @php $index++; @endphp
                @endforeach

            </div>

            <div class="text-center mt-3">
                @if (true)
                    <button class="btn btn--base btn--sm purchaseBtn" data-text="{{ $product->name }}"
                        data-price="{{ showAmount($product->price) . ' ' . $general->cur_text }}"
                        data-qty="{{ getAmount($product->in_stock) . ' qty' }}" data-id="{{ $product->id }}"
                        data-amount="{{ getAmount($product->price) }}">
                        <i class="las la-shopping-cart"></i> @lang('Purchase')
                    </button>
                @else
                    <button class="btn btn--base btn--sm no-drop" disabled>
                        <i class="las la-shopping-cart"></i> @lang('Purchase')
                    </button>
                @endif
            </div>
        </div>

    </div>
</div>
