@extends('admin.layouts.app')

@section('panel')
<div class="row mb-none-30">
    <div class="col-lg-12 col-md-12 mb-30">
        <div class="card">
            <div class="card-body">
                <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$article->id }}">
                    <div class="row">
                        <div class="col-xl-8 col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>@lang('Category')</label>
                                       <select name="course_category_id" class="form-control" required>
                                         <option value="">@lang('Select One')</option>
                                        @foreach ($course_categories as $coursecategory)
                                         <option value="{{ $coursecategory->id }}" {{ old('course_category_id', $category_id) == $coursecategory->id ? 'selected' : '' }}>
                                       {{ __($coursecategory->name) }}
                                       </option>
                                        @endforeach
                                        </select>
                                        </select>
                                        <label>@lang('Category')</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>@lang('Name')</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', @$article->name) }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Order')</label>
                                 <input type="number" class="form-control" name="ordre" value="{{ old('ordre', $order) }}" autocomplete="off">
                                    </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>@lang('Description') </label>
                                        <i class="las la-info-circle text--primary" title=""
                                            data-bs-original-title="@lang('This text is what users read when making a purchase, in order to understand the product')"
                                            aria-label="@lang('This text is what users read when making a purchase, in order to understand the product')">
                                        </i>
                                        <textarea name="description" class="form-control nicEdit"
                                            rows="12">{{ old('description', @$article->description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
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
</style>
@endpush
