@extends($activeTemplate . 'layouts.frontend')

@push('style')
    <style>
        .type_plan {
            font-size: 17px;
            font-weight: 900;
            margin-right: 10px;
        }

        .prcing {
            font-size: 26px;
            color: #0dba69;
            font-weight: 800;
        }
        .year{
            display: none;
        }
    </style>
@endpush

@section('content')
    <section class="catalog-section section-bg py-60">
        <div class="container">
            <div class="row g-2 justify-content-center">
                <div class="col-12 align-item-center mb-3" id="filtre_period">
                    <div class="d-flex justify-content-center align-items-center">
                        <p class="type_plan">
                            @lang('Monthly')
                        </p>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchperiod"
                                onchange="changePlan(this)">
                        </div>
                        <p class="type_plan">
                            @lang('Yearly')
                        </p>
                    </div>
                </div>
                @forelse($categories as $category)
                    @php
                        $products = $category->products()->where('status',1)->orderBy('price')->get();

                        $typeMonth = $typeYear = 0;
                    @endphp
                    @foreach ($products as $product)
                        @include($activeTemplate . 'partials/products')

                        @php
                            if ($product->expiry_period == 'month') {
                                $typeMonth ++ ;
                            }elseif($product->expiry_period == 'year'){
                                $typeYear ++ ;
                            }
                        @endphp
                    @endforeach
                @empty
                    <div class="col-12 empty-data text-center">
                        <div class="thumb">
                            <img src="{{ asset($activeTemplateTrue . 'images/not-found.png') }}">
                        </div>
                        <h4 class="title">@lang('No result found for "' . request()->search . '"')</h4>
                    </div>
                @endforelse
                {{ paginateLinks($categories) }}
            </div>
        </div>
    </section>

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif

    <x-purchase-modal />
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            var typeMonth = parseInt('{{$typeMonth??0}}') ;
            var  typeYear = parseInt('{{ $typeYear??0}}')
            if (!(typeMonth > 0 && typeYear > 0)) {
                $('#filtre_period').hide() ;
            }
        })
        function changePlan(e) {
            var months = document.getElementsByClassName('month');
            var years = document.getElementsByClassName('year');

            if (e.checked) {
                for (var i = 0; i < months.length; i++) {
                    months[i].style.display = 'none';
                }
                for (var j = 0; j < years.length; j++) {
                    years[j].style.display = 'block';
                }
            } else {
                for (var k = 0; k < months.length; k++) {
                    months[k].style.display = 'block';
                }
                for (var l = 0; l < years.length; l++) {
                    years[l].style.display = 'none';
                }
            }
        }
    </script>
@endpush
