@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ @$product->id }}">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="image-upload">
                                            <div class="thumb">
                                                <div class="avatar-preview">
                                                    <div class="profilePicPreview mt-3 {{ @$product->image ? 'has-image' : null }}"
                                                        style="background-image: url({{ getImage(getFilePath('product') . '/' . @$product->image, getFileSize('product')) }})">
                                                        <button type="button" class="remove-image"><i
                                                                class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                                <div class="avatar-edit">
                                                    <input type="file" class="profilePicUpload p-0" name="image"
                                                        id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                    <label for="profilePicUpload1"
                                                        class="bg--success remove-star">@lang('Upload Image')</label>
                                                    <small class="mt-2  ">@lang('Supported files'): <b>@lang('jpeg'),
                                                            @lang('jpg'), @lang('png').</b> @lang('Image will be resized into')
                                                        {{ getFileSize('product') }} </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>@lang('Price')</label>
                                            <div class="input-group">
                                                <span class="input-group-text">{{ $general->cur_sym }}</span>
                                                <input type="number" step="any" name="price" class="form-control"
                                                    min="0" value="{{ getAmount(old('price', @$product->price)) }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>@lang('Expiry period')</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="expiry_period"
                                                    id="month" value="month"
                                                    @if (old('expiry_period', @$product->expiry_period) == 'month') checked @endif>
                                                <label class="form-check-label" for="month">month</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="expiry_period"
                                                    id="year" value="year"
                                                    @if (old('expiry_period', @$product->expiry_period) == 'year') checked @endif>
                                                <label class="form-check-label" for="year">year</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="expiry_period"
                                                    id="lifetime" value="lifetime"
                                                    @if (old('expiry_period', @$product->expiry_period) == 'lifetime') checked @endif>
                                                <label class="form-check-label" for="lifetime">Lifetime</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>@lang('Category')</label>
                                                <select name="category_id" class="form-control" required>
                                                    <option value="">@lang('Select One')</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id', @$product->category_id) == $category->id ? 'selected' : '' }}>
                                                            {{ __($category->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 border border-2 border-info p-2 m-2">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>@lang('Name')</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ old('name', @$product->name) }}" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group divWidth100">
                                                    <label>@lang('Description') </label>
                                                    <i class="las la-info-circle text--primary" title=""
                                                        data-bs-original-title="@lang('This text is what users read when making a purchase, in order to understand the product')"
                                                        aria-label="@lang('This text is what users read when making a purchase, in order to understand the product')"></i>
                                                    <textarea name="description" class="form-control nicEdit">{{ old('description', @$product->description) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <button type="button" class="btn btn-md btn-info mt-2 "
                                                    data-bs-toggle="collapse" data-bs-target="#collapse_prod"
                                                    aria-expanded="false" aria-controls="collapse_prod">
                                                    <i class="las la-language fs-5"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-12 mt-2 collapse" id="collapse_prod">
                                                @php
                                                    $language = App\Models\Language::all();
                                                @endphp
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    @foreach ($language as $lang)
                                                        <li class="nav-item" role="presentation">
                                                            <button
                                                                class="nav-link @if (session('lang') == $lang->code) active @endif"
                                                                id="{{ $lang->code }}-tab" data-bs-toggle="tab"
                                                                data-bs-target="#{{ $lang->code }}-tab-pane"
                                                                type="button" role="tab"
                                                                aria-controls="{{ $lang->code }}-tab-pane"
                                                                aria-selected="true">{{ __($lang->name) }}</button>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    @php
                                                        $name_lang = array_content_to_string(json_decode($product->name_lang ?? '{}', true));
                                                        $description_lang = array_content_to_string(json_decode($product->description_lang ?? '{}', true));
                                                    @endphp
                                                    @foreach ($language as $lang)
                                                        <div class="tab-pane fade @if (session('lang') == $lang->code) show active @endif"
                                                            id="{{ $lang->code }}-tab-pane" role="tabpanel"
                                                            aria-labelledby="{{ $lang->code }}-tab" tabindex="0">

                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label>@lang('Name')</label>
                                                                    <input type="text"
                                                                        name="name_lang[{{ $lang->code }}]"
                                                                        class="form-control"
                                                                        value="{{ old('name_lang[$lang->code]', $name_lang[$lang->code] ?? '') }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div class="form-group divWidth100">
                                                                    <label>@lang('Description') </label>
                                                                    <textarea name="description_lang[{{ $lang->code }}]" class="form-control nicEdit">{{ old('description_lang[$lang->code]', $description_lang[$lang->code] ?? '') }}</textarea>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12">
                                            <h6 class="mb-2"> les attributes : </h6>
                                            <div id="attributeContainer">
                                                @php $index = 0; @endphp
                                                @isset($product->attr)
                                                    @foreach (json_decode($product->attr ?? '{}', true) as $attributes)
                                                        <div class="row align-items-center justify-content-center attributesStyle"
                                                            id="attr_{{ $index }}">
                                                            <div class="col-md-6">
                                                                <select class="form-select" aria-label="Default select"
                                                                    name="attr[{{ $index }}][id]">
                                                                    <option selected>Open this select menu</option>
                                                                    @foreach ($product_attr as $attr):
                                                                            <option value="{{ $attr->id }}" @if(  $attr->id == $attributes['id'] ) selected @endif > {{ $attr->name }} </option>
                                                                    @endforeach;
                                                                    
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>status</label>
                                                                <div class="d-flex justify-content-around">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="attr[{{ $index }}][status]"
                                                                            value="1" required @if(  $attributes['status'] == 1 ) checked @endif >
                                                                        <label class="form-check-label"><i
                                                                                class="las la-check-circle fs-4 text-success"></i></label>
                                                                    </div>
                                                                    <div class="form-check ms-2">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="attr[{{ $index }}][status]"
                                                                            value="0" required  @if(  $attributes['status'] == 0 ) checked @endif >
                                                                        <label class="form-check-label"><i
                                                                                class="las la-times fs-4 text-danger"></i></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger remove-attribute-btn">
                                                                    <i class="las la-trash fs-5"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        @php $index++; @endphp
                                                    @endforeach
                                                @endisset
                                            </div>
                                            <button class="btn btn-md btn-info text-white fw-bold text-center mt-3"
                                                id="addAttributeBtn" type="button">
                                                Add Attribute
                                                <i class="las la-plus-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .avatar-preview {
            position: relative;
        }

        .avatar-preview .profilePicPreview:after {
            height: 100%;
            width: 100%;
            display: flex;
            background: #AFAFAF !important;
            font-size: 70px;
            content: "{{ getFileSize('product') }}";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            justify-content: center;
            align-items: center;
            color: #656565;
        }

        .avatar-preview .has-image:after {
            display: none;
        }

        .remove-star:after {
            display: none;
        }

        .divWidth100>div,
        .divWidth100>div>div {
            width: 100% !important;
        }

        .attributesStyle {
            border: 3px solid #995566;
            border-radius: 10px;
            margin: 8px 3px;
            padding: 10px;
        }
    </style>
@endpush


@push('script')
    <script>
        $(document).ready(function() {
            var index = {{ $index }};
            $('#addAttributeBtn').click(function() {
                $('#attributeContainer').append(`
                <div class="row align-items-center justify-content-center attributesStyle" id="attr_${index}">
                    <div class="col-md-6">
                        <select class="form-select" aria-label="Default select" name="attr[${index}][id]">
                            <option selected>Open this select menu</option>
                            @php
                                foreach ($product_attr as $attr):
                                    echo '<option value="' . $attr->id . '">' . $attr->name . '</option>';
                                endforeach;
                            @endphp
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>status</label>
                        <div class="d-flex justify-content-around">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="attr[${index}][status]" value="1" required>
                                <label class="form-check-label"><i class="las la-check-circle fs-4 text-success"></i></label>
                            </div>
                            <div class="form-check ms-2">
                                <input class="form-check-input" type="radio" name="attr[${index}][status]" value="0" required>
                                <label class="form-check-label"><i class="las la-times fs-4 text-danger"></i></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-sm btn-danger remove-attribute-btn">
                            <i class="las la-trash fs-5"></i>
                        </button>
                    </div>
                </div>
                `);
                index++;
            });

            $(document).on('click', '.remove-attribute-btn', function() {
                $(this).closest('.row').remove();
            });

        });
    </script>
@endpush
