@extends('admin.layouts.app')

@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--md  table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                        <tr>
                            <th>@lang('SL')</th>
                            <th>@lang('Details')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody> 
                            @forelse($accounts as $account) 
                                <tr>
                                    <td>{{ $accounts->firstItem() + $loop->index }}</td>
                                    <td>
                                        <span>{{ strLimit($account->details, 40) }}</span>
                                    </td>
                                    <td>
                                        @php echo $account->statusBadge; @endphp
                                    </td>
                                    <td> 
                                        <div class="button--group">
                                            <button class="btn btn-sm btn-outline--primary editBtn" type="button" data-data="{{ $account }}">
                                                <i class="la la-pencil"></i> @lang('Edit')
                                            </button>
                                            <button type="button"
                                                class="btn btn-sm btn-outline--danger confirmationBtn {{ $account->is_sold ? 'disabled' : null }}"
                                                data-action="{{ route('admin.product.delete.account', $account->id) }}"
                                                data-question="@lang('Are you sure to delete this item?')">
                                                <i class="la la-eye"></i> @lang('Delete')
                                            </button>
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
            @if ($accounts->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($accounts) }}
                </div>
            @endif
        </div>
    </div>
</div>

<x-confirmation-modal />

{{-- EDIT MODAL --}} 
<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">@lang('Update Account Details')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="{{ route('admin.product.update.account') }}">
                @csrf
                <input type="hidden" name="id" required>
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('Details')</label>
                        <textarea name="details" class="form-control" required rows="4"></textarea>
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
    @if(@$order)
        <x-back route="{{ route('admin.report.order.history') }}" />
    @else 
        <x-back route="{{ route('admin.product.all') }}" />
    @endif
@endpush

@push('script')
<script>
    (function($){
        "use strict";  
        $('.editBtn').on('click', function () {
            var modal = $('#editModal');
            var data = $(this).data('data');

            modal.find('input[name=id]').val(data.id);
            modal.find('textarea[name=details]').val(data.details);

            modal.modal('show');
        });
    })(jQuery);
</script>
@endpush