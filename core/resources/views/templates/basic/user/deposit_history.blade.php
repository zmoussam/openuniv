@extends($activeTemplate.'layouts.master')

@section('content')
<div class="row justify-content-end mb-4">
    <div class="col-xl-4 col-md-6">
        <form action="">
            <div class="input-group">
                <input type="text" name="search" class="form-control form--control" value="{{ request()->search }}" placeholder="@lang('Search by Trx')">
                <button class="input-group-text bg--base border-0 text--white">
                    <i class="las la-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table--responsive--lg custom--table">
                <thead>
                    <tr>
                        <th>@lang('Gateway | Trx')</th>
                        <th>@lang('Initiated')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Conversion')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($deposits as $deposit)
                        <tr>
                            <td>
                                <div class="td-wrapper">
                                    <span class="title d-block">{{ __($deposit->gateway?->name) }}</span>
                                    <span class="info"> {{ $deposit->trx }} </span>
                                </div>
                            </td>

                            <td>
                                <div class="td-wrapper">
                                    <span class="d-block">{{ showDateTime($deposit->created_at) }}</span>
                                    <span class="">{{ diffForHumans($deposit->created_at) }}</span>
                                </div>
                                
                            </td>
                            <td>
                                <div class="td-wrapper">
                                    <span class="">
                                        {{ __($general->cur_sym) }}{{ showAmount($deposit->amount) }} + <span class="text--base" title="@lang('charge')">{{ showAmount($deposit->charge) }} </span>
                                    </span>
                                    <strong class="d-block" title="@lang('Amount with charge')">
                                        {{ showAmount($deposit->amount + $deposit->charge) }}
                                        {{ __($general->cur_text) }}
                                    </strong>
                                </div>
                            </td>
                            <td>
                                <div class="td-wrapper">
                                    <span>
                                        1 {{ __($general->cur_text) }} = {{ showAmount($deposit->rate) }}
                                        {{ __($deposit->method_currency) }}
                                    </span>
                                    <strong class="d-block">{{ showAmount($deposit->final_amo) }} {{ __($deposit->method_currency) }}</strong>
                                </div>
                            </td>
                            <td>
                                @php echo $deposit->statusBadge @endphp
                            </td>
                            @php
                                $details = $deposit->detail != null ? json_encode($deposit->detail) : null;
                            @endphp
                            <td>
                                <div class="action-buttons">
                                    @if ($deposit->order->status == Status::ORDER_PAID)
                                        <a href="{{ route('user.orders', ['search' => $deposit->trx]) }}"
                                            title="@lang('Order Details')"
                                            class="action-btn btn btn--dark btn--sm">
                                            <i class="fas fa-laptop-medical"></i>
                                        </a>
                                    @else
                                        <button class="action-btn btn btn--dark btn--sm" disabled title="@lang('Order Details')">
                                            <i class="fas fa-laptop-medical"></i>
                                        </button>
                                    @endif
                                    <a href="javascript:void(0)"
                                        title="@lang('Details')"
                                        class="action-btn btn btn--base btn--sm @if ($deposit->method_code >= 1000) detailBtn @else disabled @endif"
                                        @if ($deposit->method_code >= 1000) data-info="{{ $details }}" @endif
                                        @if ($deposit->status == Status::PAYMENT_REJECT) data-admin_feedback="{{ $deposit->admin_feedback }}" @endif>
                                        <i class="fa fa-desktop"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ paginateLinks($deposits) }}
</div>

{{-- APPROVE MODAL --}}
<div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">@lang('Details')</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush userData">
                </ul>
                <div class="feedback"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn--sm" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        (function ($) {
            "use strict";

            $('.detailBtn').on('click', function () {
                var modal = $('#detailModal');

                var userData = $(this).data('info');
                var html = '';
                if(userData){
                    userData.forEach(element => {
                        if(element.type != 'file'){
                            html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>${element.name}</span>
                                <span">${element.value}</span>
                            </li>`;
                        }
                    });
                }
                
                if($(this).data('admin_feedback') != undefined){
                    var adminFeedback = `
                        <div class="my-3 ms-2">
                            <strong>@lang('Admin Feedback')</strong>
                            <p>${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                }else{
                    var adminFeedback = '';
                }

                if(!html && !adminFeedback){
                    html = `<span class='d-block text-center mt-2 mb-2'>{{ __($emptyMessage) }}</span>`;
                }

                modal.find('.userData').html(html);
                modal.find('.feedback').html(adminFeedback);
                modal.modal('show');
            });
        })(jQuery);

    </script>
@endpush

