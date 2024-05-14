@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-lg-12">
        <div class="show-filter mb-3 text-end">
            <button type="button" class="btn btn-outline--primary showFilterBtn btn-sm"><i class="las la-filter"></i> @lang('Filter')</button>
        </div>
        <div class="card responsive-filter-card mb-4">
            <div class="card-body">
                <form action="">
                    <div class="d-flex flex-wrap gap-4">
                        <div class="flex-grow-1">
                            <label>@lang('TRX/Username')</label>
                            <input type="text" name="search" value="{{ request()->search }}" class="form-control">
                        </div>
                        <div class="flex-grow-1">
                            <label>@lang('Status')</label>
                            <select name="status" class="form-control">
                                <option value="">@lang('All')</option>
                                <option value="{{ Status::ORDER_PAID }}" @selected(request()->status == Status::ORDER_PAID)>@lang('Paid')</option>
                                <option value="{{ Status::ORDER_UNPAID }}" @selected(request()->status != null && request()->status == Status::ORDER_UNPAID)>
                                    @lang('Unpaid')
                                </option>
                            </select>
                        </div>
                        <div class="flex-grow-1">
                            <label>@lang('Date')</label>
                            <input name="date" type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en" class="datepicker-here form-control" data-position='bottom right' placeholder="@lang('Start date - End date')" autocomplete="off" value="{{ request()->date }}">
                        </div>
                        <div class="flex-grow-1 align-self-end">
                            <button class="btn btn--primary w-100 h-45"><i class="fas fa-filter"></i> @lang('Filter')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>@lang('User')</th>
                                <th>@lang('Payment Trx')</th>
                                <th>@lang('Ordered At')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Quantity')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Details')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                @php 
                                    $qty = @$order->orderItems->count();
                                    $perUnitPrice = @$order->orderItems->first()->price;
                                @endphp
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $order->user->fullname }}</span>
                                        <br>
                                        <span class="small"> <a href="{{ appendQuery('search',$order->user->username) }}"><span>@</span>{{ $order->user->username }}</a> </span>
                                    </td>

                                    <td>
                                        <div>
                                            <div class="fw-bold">{{ $order->deposit->trx }}</div>
                                            <a href="{{ route('admin.deposit.details', $order->deposit->id) }}">
                                                @lang('View Details')
                                            </a>
                                        </div>
                                    </td>

                                    <td>
                                        {{ showDateTime($order->created_at) }}<br>{{ diffForHumans($order->created_at) }}
                                    </td>

                                    <td class="budget">
                                        <span class="d-block">{{ $qty }} @lang('Qty') x {{ showAmount($perUnitPrice) }} {{ __($general->cur_text) }}</span>
                                        <span class="fw-bold">
                                            {{showAmount($order->total_amount)}} {{ __($general->cur_text) }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $qty }}
                                    </td>

                                    <td>
                                        @php echo $order->statusBadge; @endphp
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.report.order.details', $order->id) }}" class="btn btn-sm btn-outline--primary">
                                            <i class="las la-desktop"></i> @lang('Details')
                                        </a>
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
        @if($orders->hasPages())
        <div class="card-footer py-4">
            {{ paginateLinks($orders) }}
        </div>
        @endif
    </div><!-- card end -->
</div>
</div>

@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/datepicker.min.css')}}">
@endpush


@push('script-lib')
  <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush
@push('script')
  <script>
    (function($){
        "use strict";
        if(!$('.datepicker-here').val()){
            $('.datepicker-here').datepicker();
        }
    })(jQuery)
  </script>
@endpush
