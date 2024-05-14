@php
    $subscribe = getContent('subscribe.content', true);
@endphp

<div class="subscribe">
    <button type="submit" class="subscribe-btn btn btn--base btn-sm" data-bs-toggle="modal"
        data-bs-target="#subscribeModalCenter">
        <span class="text">@lang('Subscribe')</span> <span class="icon"><i class="far fa-bell"></i></span>
    </button>
</div>

<div class="modal subscribe-modal fade" id="subscribeModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="subscribeModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header img justify-content-end d-flex"
                style="background-image: url({{ getImage('assets/images/frontend/subscribe/' . @$subscribe->data_values->image, '1000x525') }});">
                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn--close">
                    <i class="las la-times text-white 24px"></i>
                </button>
            </div>
            <div class="modal-body pt-md-0 pb-5 px-4 px-md-5 text-center">
                <h2>{{ __(@$subscribe->data_values->heading) }}</h2>
                <div class="icon d-flex align-items-center justify-content-center">
                    <img src="{{ asset($activeTemplateTrue . 'images/email.png') }}" alt="" class="img-fluid">
                </div>
                <h4 class="mb-3">{{ __(@$subscribe->data_values->subheading) }}</h4>
                <form action="#" class="subscribe-form">
                    @csrf
                    <div class="form-group d-flex">
                        <input type="text" class="form--control rounded-left" name="email"
                            placeholder="@lang('Enter email address')" required>
                        <button type="submit" class="btn btn--base">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('style')
    <style>
        .subscribe {
            position: fixed;
            bottom: 30px;
            left: 30px;
            z-index: 9;
        }

        .subscribe-btn{
            padding: 15px 25px;
        }

        @media (max-width: 1630px) {
            .subscribe-btn {
                padding: 0;
                width: 48px;
                height: 48px;
                text-align: center;
                line-height: 48px;
            }

            .subscribe-btn .text {
                display: none;
            }

            .subscribe-btn .icon {
                font-size: 18px;
                animation: ring 2s infinite ease;
            }
        }

        @keyframes ring {
            0% {
                transform: rotate(35deg);
            }

            12.5% {
                transform: rotate(-30deg);
            }

            25% {
                transform: rotate(25deg);
            }

            37.5% {
                transform: rotate(-20deg);
            }

            50% {
                transform: rotate(15deg);
            }

            62.5% {
                transform: rotate(-10deg);
            }

            75% {
                transform: rotate(5deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        .modal-header .btn--close {
            padding: 10px;
        }

        .subscribe-modal .modal-open {
            overflow: hidden;
        }

        .subscribe-modal .modal-open .modal {
            overflow-x: hidden;
            overflow-y: auto;
        }

        .subscribe-modal .modal {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050;
            display: none;
            width: 100%;
            height: 100%;
            overflow: hidden;
            outline: 0;
        }

        .subscribe-modal .modal-dialog {
            position: relative;
            width: auto;
            margin: 0.5rem;
            pointer-events: none;
        }

        .subscribe-modal .modal.fade .modal-dialog {
            -webkit-transition: -webkit-transform 0.3s ease-out;
            transition: -webkit-transform 0.3s ease-out;
            -o-transition: transform 0.3s ease-out;
            transition: transform 0.3s ease-out;
            transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
            -webkit-transform: translate(0, -50px);
            -ms-transform: translate(0, -50px);
            transform: translate(0, -50px);
        }

        @media (prefers-reduced-motion: reduce) {
            .subscribe-modal .modal.fade .modal-dialog {
                -webkit-transition: none;
                -o-transition: none;
                transition: none;
            }
        }

        .subscribe-modal .modal.show .modal-dialog {
            -webkit-transform: none;
            -ms-transform: none;
            transform: none;
        }

        .subscribe-modal .modal-dialog-scrollable {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            max-height: calc(100% - 1rem);
        }

        .subscribe-modal .modal-dialog-scrollable .modal-content {
            max-height: calc(100vh - 1rem);
            overflow: hidden;
        }

        .subscribe-modal .modal-dialog-scrollable .modal-header,
        .subscribe-modal .modal-dialog-scrollable .modal-footer {
            -ms-flex-negative: 0;
            flex-shrink: 0;
        }

        .subscribe-modal .modal-dialog-scrollable .modal-body {
            overflow-y: auto;
        }

        .subscribe-modal .modal-dialog-centered {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            min-height: calc(100% - 1rem);
        }

        .subscribe-modal .modal-dialog-centered::before {
            display: block;
            height: calc(100vh - 1rem);
            content: "";
        }

        .subscribe-modal .modal-dialog-centered.modal-dialog-scrollable {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            height: 100%;
        }

        .subscribe-modal .modal-dialog-centered.modal-dialog-scrollable .modal-content {
            max-height: none;
        }

        .subscribe-modal .modal-dialog-centered.modal-dialog-scrollable::before {
            content: none;
        }

        .subscribe-modal .modal-content {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 0.3rem;
            outline: 0;
        }

        .subscribe-modal .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            width: 100vw;
            height: 100vh;
            background-color: #000;
        }

        .subscribe-modal .modal-backdrop.fade {
            opacity: 0;
        }

        .subscribe-modal .modal-backdrop.show {
            opacity: 0.5;
        }

        .subscribe-modal .modal-header {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding: 1rem 1rem;
            border-bottom: 1px solid #dee2e6;
            border-top-left-radius: 0.3rem;
            border-top-right-radius: 0.3rem;
        }

        .subscribe-modal .modal-header .close {
            padding: 1rem 1rem;
            margin: -1rem -1rem -1rem auto;
        }

        .subscribe-modal .modal-title {
            margin-bottom: 0;
            line-height: 1.5;
        }

        .subscribe-modal .modal-body {
            position: relative;
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1rem;
        }

        .subscribe-modal .modal-footer {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: end;
            -ms-flex-pack: end;
            justify-content: flex-end;
            padding: 1rem;
            border-top: 1px solid #dee2e6;
            border-bottom-right-radius: 0.3rem;
            border-bottom-left-radius: 0.3rem;
        }

        .subscribe-modal .modal-footer> :not(:first-child) {
            margin-left: .25rem;
        }

        .subscribe-modal .modal-footer> :not(:last-child) {
            margin-right: .25rem;
        }

        .subscribe-modal .modal-scrollbar-measure {
            position: absolute;
            top: -9999px;
            width: 50px;
            height: 50px;
            overflow: scroll;
        }

        @media (min-width: 576px) {
            .subscribe-modal .modal-dialog {
                max-width: 500px;
                margin: 1.75rem auto;
            }

            .subscribe-modal .modal-dialog-scrollable {
                max-height: calc(100% - 3.5rem);
            }

            .subscribe-modal .modal-dialog-scrollable .modal-content {
                max-height: calc(100vh - 3.5rem);
            }

            .subscribe-modal .modal-dialog-centered {
                min-height: calc(100% - 3.5rem);
            }

            .subscribe-modal .modal-dialog-centered::before {
                height: calc(100vh - 3.5rem);
            }

            .subscribe-modal .modal-sm {
                max-width: 300px;
            }
        }

        @media (min-width: 992px) {

            .subscribe-modal .modal-lg,
            .subscribe-modal .modal-xl {
                max-width: 800px;
            }
        }

        @media (min-width: 1200px) {
            .subscribe-modal .modal-xl {
                max-width: 1140px;
            }
        }

        .subscribe-modal .modal-dialog {
            max-width: 500px;
        }

        .subscribe-modal .modal-content {
            border: none;
            position: relative;
            padding: 0 !important;
            -webkit-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
            -moz-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
            box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
        }

        .subscribe-modal .modal-content .modal-header {
            position: relative;
            padding: 0;
            border: none;
            height: 230px;
            position: relative;
            z-index: 0;
        }

        .subscribe-modal .modal-content .modal-header:after {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            content: '';
            background: #dd00ff;
            background: -moz-linear-gradient(45deg, #dd00ff 0%, #3e65ff 100%);
            background: -webkit-gradient(left bottom, right top, color-stop(0%, #dd00ff), color-stop(100%, #3e65ff));
            background: -webkit-linear-gradient(45deg, #dd00ff 0%, #3e65ff 100%);
            background: -o-linear-gradient(45deg, #dd00ff 0%, #3e65ff 100%);
            background: -ms-linear-gradient(45deg, #dd00ff 0%, #3e65ff 100%);
            background: linear-gradient(45deg, #dd00ff 0%, #3e65ff 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#dd00ff', endColorstr='#3e65ff', GradientType=1);
            z-index: -1;
            opacity: .3;
        }

        .subscribe-modal .modal-content button.close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0;
            margin: 0;
            width: 40px;
            height: 40px;
            z-index: 1;
            color: #fff;
        }

        .subscribe-modal .modal-content .modal-body {
            border: none;
            overflow: hidden;
            margin-top: -180px;
            z-index: 2;
        }

        .subscribe-modal .modal-content .modal-body .icon {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            font-size: 30px;
            margin: 0 auto;
            margin-bottom: 10px;
            background: rgba(255, 255, 255, 0.2);
        }

        .subscribe-modal .modal-content .modal-body .icon img {
            max-width: 70%;
        }

        .subscribe-modal .modal-content .modal-body h2 {
            font-weight: 700;
            color: #fff;
        }

        .subscribe-modal .modal-content .modal-body h4 {
            font-size: 18px;
        }

        .subscribe-modal .modal-content .modal-body h3 {
            font-weight: 800;
            font-size: 22px;
        }

        .subscribe-modal .modal-content .modal-body h3 span {
            font-weight: 300;
        }

        .subscribe-modal .modal-content .subscribe-form .form-group {
            position: relative;
            margin-bottom: 0;
            border-radius: 0;
        }

        .subscribe-modal .modal-content .subscribe-form .form-group input {
            font-size: 1rem;
            border-radius: 5px 0 0 5px;
        }

        .subscribe-modal .modal-content .subscribe-form .form-group input::-webkit-input-placeholder {
            /* Chrome/Opera/Safari */
            color: rgba(0, 0, 0, 0.3) !important;
        }

        .subscribe-modal .modal-content .subscribe-form .form-group input::-moz-placeholder {
            /* Firefox 19+ */
            color: rgba(0, 0, 0, 0.3) !important;
        }

        .subscribe-modal .modal-content .subscribe-form .form-group input:-ms-input-placeholder {
            /* IE 10+ */
            color: rgba(0, 0, 0, 0.3) !important;
        }

        .subscribe-modal .modal-content .subscribe-form .form-group input:-moz-placeholder {
            /* Firefox 18- */
            color: rgba(0, 0, 0, 0.3) !important;
        }

        .subscribe-modal .modal-content .subscribe-form .form-group input:focus {
            outline: none !important;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .subscribe-modal .modal-content .subscribe-form .form-group .submit:hover,
        .subscribe-modal .modal-content .subscribe-form .form-group .submit:focus {
            text-decoration: none !important;
            outline: none !important;
        }

        .subscribe-modal .modal-content .subscribe-form .icon {
            position: absolute;
            top: 50%;
            right: 20px;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
        }

        img {
            page-break-inside: avoid;
        }

        .img,
        .blog-img,
        .user-img {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }

        .modal-content .modal-body .icon img {
            max-width: 70%;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .subscribe-modal .modal-content .subscribe-form .form-group .btn {
            display: block;
            width: 130px;
            height: 52px;
            font-size: 16px;
            padding: 10px;
            border: 0 !important;
            border-radius: 0 5px 5px 0;
        }

        .subscribe-modal .modal-content .subscribe-form .form-group .btn:hover,
        .subscribe-modal .modal-content .subscribe-form .form-group .btn:focus {
            border: 0 !important;
        }

        .subscribe-modal .modal-content .subscribe-form .form-group .btn:active {
            top: 0;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            "use strict";

            var modal = $('#subscribeModalCenter');

            $('.subscribeBtn').on('click', function() {
                modal.modal('show');
            });

            var formEl = $(".subscribe-form");
            formEl.on('submit', function(e) {
                e.preventDefault();
                var data = formEl.serialize();

                $.ajax({
                    url: "{{ route('subscribe') }}",
                    method: 'post',
                    data: data,

                    success: function(response) {
                        if (response.success) {
                            modal.modal('hide')
                            formEl.find('input[name=email]').val('')
                            return notify('success', response.message);
                        }
                        $.each(response.error, function(key, value) {
                            notify('error', value);
                        });
                    }
                });
            });
        });
    </script>
@endpush
