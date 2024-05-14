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
                            <th>@lang('Name')</th>
                            <th>@lang('Products')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ __($category->name) }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.product.all', ['category_id'=>$category->id]) }}" class="bg--primary px-2 rounded text--white" target="_blank">
                                            {{ @$category->products->count() }}
                                        </a>
                                    </td>
                                    <td> 
                                       @php echo $category->statusBadge; @endphp
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline--primary dropdown-toggle id="actionButton" data-bs-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>@lang('Action')
                                            </button>
                                            <div class="dropdown-menu p-0">
                                                <a href="javascript:void(0)" class="dropdown-item editBtn" data-data="{{ $category }}">
                                                    <i class="la la-pencil"></i> @lang('Edit')
                                                </a>
                                                @if($category->status == Status::ENABLE)
                                                    <a href="javascript:void(0)" 
                                                        class="dropdown-item confirmationBtn"
                                                        data-action="{{ route('admin.category.status', $category->id) }}"
                                                        data-question="@lang('Are you sure to disable this item?')">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        class="dropdown-item confirmationBtn"
                                                        data-action="{{ route('admin.category.status', $category->id) }}"
                                                        data-question="@lang('Are you sure to enable this item?')">
                                                        <i class="la la-eye"></i> @lang('Enable')
                                                    </a>
                                                @endif 
                                                <a href="{{ route('admin.product.all', ['category_id'=>$category->id]) }}" class="dropdown-item">
                                                    <i class="la la-clipboard-list"></i> @lang('Products')
                                                </a>
                                                @if(!@$category->products->count())
                                                    <a href="javascript:void(0)" 
                                                        class="dropdown-item confirmationBtn"
                                                        data-action="{{ route('admin.category.delete', $category->id) }}"
                                                        data-question="@lang('Are you sure to delete this item?')"
                                                    >
                                                        <i class="la la-trash"></i> @lang('Delete')
                                                    </a>
                                                @endif
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
            @if ($categories->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($categories) }}
                </div>
            @endif
        </div>
    </div>
</div>

<x-confirmation-modal />

{{-- NEW MODAL --}}
<div id="createModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">@lang('New Category')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div> 
            <form class="form-horizontal" method="post" action="{{ route('admin.category.add') }}">
                @csrf 
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('Name')</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT MODAL --}} 
<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">@lang('Update Category')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="{{ route('admin.category.update') }}">
                @csrf
                <input type="hidden" name="id" required>
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('Name')</label>
                        <input type="text" class="form-control edit_name" name="name" required autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
 
@push('breadcrumb-plugins')
    <x-search-form />
    <button class="btn btn-sm btn-outline--primary addBtn">
        <i class="las la-plus"></i>@lang('Add New')
    </button>
@endpush

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
    <script>
        (function($){
            "use strict";  

            $('.addBtn').on('click', function () {
                var modal = $('#createModal');
                modal.modal('show');
            });

            $('.editBtn').on('click', function () {
                var modal = $('#editModal');
                var data = $(this).data('data');

                modal.find('input[name=id]').val(data.id);
                modal.find('input[name=name]').val(data.name);

                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
 