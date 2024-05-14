@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-12">
            @php
                $language = App\Models\Language::all();
            @endphp

            <form action="{{ route('admin.product.add.attr') }}" method="POST" class="card">
                @csrf
                <input type="hidden" name="attr_id" value="{{ $productAttributes->id }}">
                <div class="card-body row align-items-center justify-content-center">
                    <div class="col-md-8">
                        <label>@lang('name') </label>
                        <input class="form-control" name="name" value="{{ old('name',$productAttributes->name) }}" type="text" required>
                    </div>
                    <div class="col-md-4">
                        <label>@lang('status')</label>
                        <div class="d-flex justify-content-around">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="1" required
                                    @if (old('status',$productAttributes->status) == '1') checked @endif>
                                <label class="form-check-label"><i
                                        class="las la-check-circle fs-4 text-success"></i></label>
                            </div>
                            <div class="form-check ms-2">
                                <input class="form-check-input" type="radio" name="status" value="0" required
                                    @if (old('status',$productAttributes->status) == '0') checked @endif>
                                <label class="form-check-label"><i class="las la-times fs-4 text-danger"></i></label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label>@lang('description') </label>
                        <textarea class="form-control" name="description" rows="2">{{ old('description',$productAttributes->description) }}</textarea>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="card card-body border border-2 border-secondary m-1">
                            <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                                @foreach ($language as $lang)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link @if (session('lang') == $lang->code) active @endif"
                                            id="{{ $lang->code }}-tab" data-bs-toggle="tab"
                                            data-bs-target="#{{ $lang->code }}-tab-pane" type="button" role="tab"
                                            aria-controls="{{ $lang->code }}-tab-pane"
                                            aria-selected="true">{{ __($lang->name) }}</button>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                @php
                                    $attr_lang = (isset($productAttributes->lang) && ($productAttributes->lang!=null)) ? json_decode($productAttributes->lang,true): json_encode([]); ;
                                @endphp
                                @foreach ($language as $lang)
                                    <div class="tab-pane fade @if (session('lang') == $lang->code) show active @endif"
                                        id="{{ $lang->code }}-tab-pane" role="tabpanel"
                                        aria-labelledby="{{ $lang->code }}-tab" tabindex="0">

                                        <div class="col-md-12">
                                            <label>@lang('name') </label>
                                            <input class="form-control" name="attr[{{ $lang->code }}][name]"
                                                value="{{ old('attr[$lang->code][name]',$attr_lang[$lang->code]['name']??'') }}" type="text">
                                        </div>
                                        <div class="col-12">
                                            <label>@lang('description') </label>
                                            <textarea class="form-control" name="attr[{{ $lang->code }}][description]" rows="2">{{ old('attr[$lang->code][description]',$attr_lang[$lang->code]['description']??'') }}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-md btn-info text-white fw-bold text-center mt-3" id="addAttributeBtn"
                            type="submit">
                            save 
                            <i class="las la-plus-circle"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('style')
    <style>
        .table-responsive {
            background: transparent;
            min-height: 300px;
        }

        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }
    </style>
@endpush

@push('script')
@endpush
