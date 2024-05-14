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
            <table class="table table--responsive--md custom--table">
                <thead>
                    <tr>
                        <th>@lang('Transaction')</th>
                        <th>@lang('Ordered At')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Quantity')</th>
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
                                <div class="td-wrapper">
                                    <span class="title d-block">{{ $order->deposit->trx }}</span>
                                    <a href="{{ route('user.deposit.history', ['search'=>$order->deposit->trx]) }}" class="info text--base">
                                        @lang('View Details')
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="td-wrapper">
                                    {{ showDateTime($order->created_at) }}<br>{{ diffForHumans($order->created_at) }}
                                </div>
                            </td>
                            <td>
                                <div class="td-wrapper">
                                    <span class="d-block">{{ $qty }} @lang('Qty') x {{ showAmount($perUnitPrice) }} {{ __($general->cur_text) }}</span>
                                    <span class="fw-bold">
                                        {{showAmount($order->total_amount)}} {{ __($general->cur_text) }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span>{{ @$order->orderItems->count() }}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a class="action-btn btn btn--base btn--sm" href="{{ route('user.order.details', $order->id) }}">
                                        <i class="fa fa-desktop"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ paginateLinks($orders) }}
    </div>
</div>
@endsection