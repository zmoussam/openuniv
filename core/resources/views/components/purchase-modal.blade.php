<div id="purchaseModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        @auth
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">@lang('Purchase')</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.deposit.insert') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <input type="hidden" name="currency">
                    <div class="modal-body"> 
                        <div class="small">
                            <p class="text mb-3"></p>
                            <ul class="list-group list-group-flush preview-details">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>@lang('Charge')</span>
                                    <span><span class="charge fw-bold">0</span> {{__($general->cur_text)}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>@lang('Payable')</span> <span><span class="payable fw-bold"> 0</span> {{__($general->cur_text)}}</span>
                                </li>
                                <li class="list-group-item justify-content-between d-none rate-element">
                                </li>
                                <li class="list-group-item justify-content-between d-none in-site-cur">
                                    <span>@lang('In') <span class="method_currency"></span></span>
                                    <span class="final_amo fw-bold">0</span>
                                </li>
                                <li class="list-group-item justify-content-center crypto_currency d-none">
                                    <span>@lang('Conversion with') <span class="method_currency"></span> @lang('and final value will Show on next step')</span>
                                </li>
                            </ul>
                        </div>

                        <div class="row mt-4">
                            <div class="form-group col-12">
                                <label class="form--label">@lang('Select Gateway')</label>
                                <select class="form--control form-select" name="gateway" required>
                                    <option value="">@lang('Select One')</option>
                                    @foreach($gatewayCurrency as $data)
                                        <option value="{{$data->method_code}}" data-gateway="{{ $data }}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-0 m-0 border-top-0">
                        <button type="submit" class="btn btn--base w-100 m-0"><i class="fas fa-angle-double-right"></i> @lang('Proceed to payment')</button>
                    </div>
                </form>
            </div>
        @else
            <div class="modal-content">
                <div class="modal-header"> 
                    <h6 class="modal-title method-name">@lang('Login required')</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>@lang('In order to buy a product, you need to log in to your account')</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('user.login', ['redirect'=>request()->fullUrl()]) }}" class="btn btn-sm btn--base w-100">@lang('Login')</a>
                </div>
            </div> 
        @endauth
    </div>
</div> 

@auth
    @push('style')
        <style>
            .list-group-flush>.list-group-item:last-child{
                border-bottom-width: thin !important;
            }

            #purchaseModal .modal-content {
                border: 0 !important;
            }

            #purchaseModal .modal-body,
            #purchaseModal .modal-body .text {
                font-size: 0.875rem !important;
            }
            
            #purchaseModal .modal-footer .btn.w-100 {
                border-radius: 0 !important;
            }
        </style>
    @endpush
    @push('script')
        <script>
            (function ($) {
                "use strict";
                var baseAmount = 0;

                $('.purchaseBtn').on('click', function () {
                    var modal = $('#purchaseModal');

                    baseAmount = parseFloat($(this).data('amount'));
            
                    var text = $(this).data('text');
                    var price = $(this).data('price');
                    var id = $(this).data('id');

                    modal.find('.text').text(text);
                    modal.find('.amount').text(price);
                    modal.find('[name=id]').val(id);

                    calculatecharge()
                    modal.modal('show');
                });

                $('select[name=gateway]').change(function(){
                    calculatecharge()

                });
                
                function calculatecharge(){
                                        if(!$('select[name=gateway]').val()){
                        return false;
                    }

                    var resource = $('select[name=gateway] option:selected').data('gateway');
                    var fixed_charge = parseFloat(resource.fixed_charge);
                    var percent_charge = parseFloat(resource.percent_charge);
                    var rate = parseFloat(resource.rate)

                    if(resource.method.crypto == 1){
                        var toFixedDigit = 8;
                        $('.crypto_currency').removeClass('d-none');
                    }else{
                        var toFixedDigit = 2;
                        $('.crypto_currency').addClass('d-none');
                    }

                    $('.min').text(parseFloat(resource.min_amount).toFixed(2));
                    $('.max').text(parseFloat(resource.max_amount).toFixed(2));

                    var qty = parseFloat($('input[name=qty]').val());


                    var amount = (baseAmount);

                    if (!amount) {
                        amount = 0;
                    }

                    if(amount <= 0){
                        return false;
                    }

                    var charge = parseFloat(fixed_charge + (amount * percent_charge / 100)).toFixed(2);
                    $('.charge').text(charge);
                    var payable = parseFloat((parseFloat(amount) + parseFloat(charge))).toFixed(2);
                    $('.payable').text(payable);
                    var final_amo = (parseFloat((parseFloat(amount) + parseFloat(charge)))*rate).toFixed(toFixedDigit);
                    $('.final_amo').text(final_amo);
                    
                    if (resource.currency != '{{ $general->cur_text }}') {
                        var rateElement = `<span class="fw-bold">@lang('Conversion Rate')</span> <span><span  class="fw-bold">1 {{__($general->cur_text)}} = <span class="rate">${rate}</span>  <span class="method_currency">${resource.currency}</span></span></span>`;
                        $('.rate-element').html(rateElement)
                        $('.rate-element').removeClass('d-none');
                        $('.in-site-cur').removeClass('d-none');
                        $('.rate-element').addClass('d-flex');
                        $('.in-site-cur').addClass('d-flex');
                    }else{
                        $('.rate-element').html('')
                        $('.rate-element').addClass('d-none');
                        $('.in-site-cur').addClass('d-none');
                        $('.rate-element').removeClass('d-flex');
                        $('.in-site-cur').removeClass('d-flex');
                    }
                    $('.method_currency').text(resource.currency);
                    $('input[name=currency]').val(resource.currency);
                    $('input[name=qty]').on('input');
                }

                $('input[name=qty]').on('input',function(){
                    $('select[name=gateway]').change();
                });
            })(jQuery);
        </script>
    @endpush
@else 
    @push('script')
        <script>
            (function ($) {
                "use strict";
                $('.purchaseBtn').on('click', function () {
                    var modal = $('#purchaseModal');
                    modal.modal('show');
                });
            })(jQuery);
        </script>
    @endpush
@endauth