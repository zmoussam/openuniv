@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="py-120">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @php
                        echo @$cookie->data_values->description;
                    @endphp
                </div>
            </div>
        </div>
    </div>
@endsection
