@extends($activeTemplate.'layouts.'.$layout)

@section('content')
<div class="row justify-content-center"> 
    <div class="@auth col-lg-8 @else col-lg-6 py-120 @endauth" style="width: 100%;"> 
        <div class="row">
            <div class="col-md-6">
                <!-- First Card -->
                <div class="card custom--card style-two">
                    <div class="card-header card-header-bg d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <div class="button-title-badge d-flex flex-wrap align-items-center gap-2">
                            <div class="button-badge d-flex flex-wrap align-items-center justify-content-between">
                                @php echo $myTicket->statusBadge; @endphp
                                <div class="d-block d-sm-none">
                                    @if ($myTicket->status != 3 && $myTicket->user)
                                        <button class="btn btn--danger close-button btn--sm confirmationBtn" type="button"
                                            data-question="@lang('Are you sure to close this ticket?')" data-action="{{ route('ticket.close', $myTicket->id) }}"><i
                                                class="las la-times"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <h5 class="card-title mt-0 mb-0">
                                [@lang('Ticket')#{{ $myTicket->ticket }}] {{ $myTicket->subject }}
                            </h5>
                        </div>
                        <div class="d-sm-block d-none">
                            @if ($myTicket->status != 3 && $myTicket->user)
                                <button class="btn btn--danger close-button btn--sm confirmationBtn" type="button"
                                    data-question="@lang('Are you sure to close this ticket?')" data-action="{{ route('ticket.close', $myTicket->id) }}"><i
                                        class="las la-times"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('ticket.reply', $myTicket->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-between">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form--control" rows="4" placeholder="@lang('Reply')">{{ old('message')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn--base btn--sm addFile mt-4">
                                    <i class="fa fa-plus"></i> @lang('Add New')
                                </button>
                            </div>
                            <div class="form-group">
                                <label class="form--label">@lang('Attachments')</label> <small class="text--danger">@lang('Max 5 files can be uploaded'). @lang('Maximum upload size is') {{ ini_get('upload_max_filesize') }}</small>
                                <input type="file" name="attachments[]" class="form-control form--control"/>
                                <div id="fileUploadsContainer"></div>
                                <p class="my-2 ticket-attachments-message text-muted">
                                    @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')
                                </p>
                            </div>
                            <button type="submit" class="btn btn--base w-100 mt-4">@lang('Submit')</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Second Card -->
                <div class="card mt-4">
                    <div class="card-body">
                        @foreach($messages as $message)
                            @if($message->admin_id == 0)
                                <div class="row border border-radius-3 my-3 py-3 mx-2">
                                    <div class="col-md-3 border-end text-end">
                                        <h5 class="my-3">{{ $message->ticket->name }}</h5>
                                    </div>
                                    <div class="col-md-9">
                                        <p class="text-muted fw-bold my-3">
                                            @lang('Posted on') {{ $message->created_at->format('l, dS F Y @ H:i') }}</p>
                                        <p>{{$message->message}}</p>
                                        @if($message->attachments->count() > 0)
                                            <div class="mt-2">
                                                @foreach($message->attachments as $k=> $image)
                                                    <a href="{{route('ticket.download',encrypt($image->id))}}" class="me-3"><i class="fa fa-file"></i>  @lang('Attachment') {{++$k}} </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            @else
                                <div class="row border border-warning border-radius-3 my-3 py-3 mx-2" style="background-color: #ffd96729">
                                    <div class="col-md-3 border-end text-end">
                                        <h5 class="my-3">{{ $message->admin->name }}</h5>
                                        <p class="lead text-muted">@lang('Staff')</p>
                                    </div>
                                    <div class="col-md-9">
                                        <p class="text-muted fw-bold my-3">
                                            @lang('Posted on') {{ $message->created_at->format('l, dS F Y @ H:i') }}</p>
                                        <p>{{$message->message}}</p>
                                        @if($message->attachments->count() > 0)
                                            <div class="mt-2">
                                                @foreach($message->attachments as $k=> $image)
                                                    <a href="{{route('ticket.download',encrypt($image->id))}}" class="me-3"><i class="fa fa-file"></i>  @lang('Attachment') {{++$k}} </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<x-confirmation-modal basic={{ true }} /> 
@endsection

@push('script')
    <script>
        (function ($) {
            "use strict";
            var fileAdded = 0;
            $('.addFile').on('click',function(){
                if (fileAdded >= 4) {
                    notify('error','You\'ve added maximum number of file');
                    return false;
                }
                fileAdded++;  
                $("#fileUploadsContainer").append(`
                    <div class="input-group my-3">
                        <input type="file" name="attachments[]" class="form-control form--control rounded" required />
                        <button type="submit" class="input-group-text btn-danger remove-btn ms-1 rounded"><i class="las la-times"></i></button>
                    </div>
                `)
            }); 
            $(document).on('click','.remove-btn',function(){
                fileAdded--;
                $(this).closest('.input-group').remove();
            });
        })(jQuery);

    </script>
@endpush
@push('style')
<style>

</style>
@endpush