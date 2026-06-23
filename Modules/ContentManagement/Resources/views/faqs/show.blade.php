@extends('layouts.admin')
@section('page_title', 'View FAQ')

@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<style>
    .faq-view {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
    }
    .faq-view h3 {
        font-weight: 700;
    }
    .faq-view .meta {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        color: #64748b;
        font-size: 0.9rem;
    }
    .faq-view .badge {
        border-radius: 999px;
        padding: 4px 12px;
    }
    .faq-view-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 12px;
    }
    .faq-view-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
</style>
@endpush

@section('content')
@php
    $categoryLabel = $faq->FaqCategory && $faq->FaqCategory->label ? $faq->FaqCategory->label : 'Uncategorized';
@endphp

<div class="faq-view">
    <div class="faq-view-header">
        <div>
            <h3>{{ $faq->question }}</h3>
            <div class="meta">
                <span class="badge badge-light">{{ $categoryLabel }}</span>
                @if ($faq->published)
                    <span class="badge badge-success">Published</span>
                @else
                    <span class="badge badge-warning">Draft</span>
                @endif
                <span>Updated {{ $faq->updated_at->diffForHumans() }}</span>
            </div>
        </div>
        <div class="faq-view-actions">
            <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
            <a href="{{ route('faqs.manage') }}" class="btn btn-light btn-sm">Back to FAQs</a>
        </div>
    </div>

    <hr>

    <div class="faq-answer">
        {!! $faq->answer !!}
    </div>

    <div class="mt-4">
        <form action="{{ route('faqs.destroy', $faq->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
            <input type="hidden" name="_method" value="DELETE" />
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete FAQ</button>
        </form>
    </div>
</div>
@endsection
