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
                            <th>@lang('Name | Category')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($articles as $article)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ strLimit($article->name, 50) }}</span>
                                        <span class="small d-block">{{ __(@$article->course_category->name) }}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline--primary dropdown-toggle id="actionButton" data-bs-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>@lang('Action')
                                            </button>
                                            <div class="dropdown-menu p-0">
                                                <a href="{{ route('admin.article.form', $article->id) }}" class="dropdown-item">
                                                    <i class="la la-pencil"></i> @lang('Edit')
                                                </a>
                                                <a href="javascript:void(0)" 
                                                        class="dropdown-item confirmationBtn"
                                                        data-action="{{ route('admin.article.delete', $article->id) }}"
                                                        data-question="@lang('Are you sure to delete this item?')"
                                                    >
                                                        <i class="la la-trash"></i> @lang('Delete')
                                                    </a>
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
            @if ($articles->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($articles) }}
                </div>
            @endif
        </div>
    </div>
</div>

<x-confirmation-modal />
@endsection

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

@push('breadcrumb-plugins')
    <x-search-form />
    <a href="{{ route('admin.article.form') }}" class="btn btn-sm btn-outline--primary">
        <i class="las la-plus"></i>@lang('Add New Article')
    </a>
@endpush

 