@extends('admin.layouts.app')

@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 bg--transparent shadow-none">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table--light style--two table bg-white">
                        <thead>
                        <tr>
                            <th>@lang('Name | Category')</th>
                            <th>@lang('Price')</th>
                            <th>@lang('In Stock')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ strLimit($product->name, 50) }}</span>
                                        <span class="small d-block">{{ __(@$product->category->name) }}</span>
                                    </td>
                                    <td> 
                                        <span class="fw-bold">{{ showAmount($product->price) }} {{ __($general->cur_text) }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.product.accounts', $product->id) }}" class="bg--primary px-2 rounded text--white" target="_blank">
                                            {{ showAmount(@$product->in_stock, 0) }}
                                        </a>
                                    </td>
                                    <td> 
                                       @php echo $product->statusBadge; @endphp
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline--primary dropdown-toggle" id="actionButton" data-bs-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>@lang('Action')
                                            </button>
                                            <div class="dropdown-menu p-0">
                                                <a href="{{ route('admin.product.form', $product->id) }}" class="dropdown-item">
                                                    <i class="la la-pencil"></i> @lang('Edit')
                                                </a>
                                                @if($product->status == Status::ENABLE)
                                                    <a href="javascript:void(0)" class="dropdown-item confirmationBtn"
                                                        data-action="{{ route('admin.product.status', $product->id) }}"
                                                        data-question="@lang('Are you sure to disable this item?')">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        class="dropdown-item confirmationBtn"
                                                        data-action="{{ route('admin.product.status', $product->id) }}"
                                                        data-question="@lang('Are you sure to enable this item?')">
                                                        <i class="la la-eye"></i> @lang('Enable')
                                                    </a>
                                                @endif
                                                <a href="{{ route('admin.product.accounts', $product->id) }}" class="dropdown-item">
                                                    <i class="la la-clipboard-list"></i> @lang('Accounts')
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
            @if ($products->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($products) }}
                </div>
            @endif
        </div>
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

@push('breadcrumb-plugins')
    <x-search-form />
    <a href="{{ route('admin.product.form') }}" class="btn btn-sm btn-outline--primary">
        <i class="las la-plus"></i>@lang('Add New')
    </a>
@endpush

 