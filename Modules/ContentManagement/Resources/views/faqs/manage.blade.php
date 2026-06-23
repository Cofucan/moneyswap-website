@extends('layouts.admin')
@section('page_title', 'FAQs')

@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<style>
    .faq-tool {
        background: #f8fafc;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
    }
    .faq-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 20px;
    }
    .faq-header-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .faq-header h3 {
        margin: 0 0 6px;
        font-weight: 700;
    }
    .faq-header p {
        margin: 0;
        color: #64748b;
    }
    .faq-metrics .metric-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 16px;
        border: 1px solid #e2e8f0;
        height: 100%;
    }
    .metric-card .label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #94a3b8;
        margin-bottom: 4px;
    }
    .metric-card .value {
        font-size: 1.6rem;
        font-weight: 700;
        color: #0f172a;
    }
    .faq-controls {
        background: #ffffff;
        border-radius: 14px;
        padding: 16px;
        border: 1px solid #e2e8f0;
        margin: 18px 0 20px;
    }
    .faq-controls .form-control,
    .faq-controls .custom-select {
        border-radius: 10px;
    }
    .faq-list {
        display: grid;
        gap: 14px;
    }
    .faq-item {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        padding: 14px 18px;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
    }
    .faq-item:hover {
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.08);
        transform: translateY(-1px);
    }
    .faq-item summary {
        list-style: none;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
    }
    .faq-item summary::-webkit-details-marker {
        display: none;
    }
    .faq-title {
        font-weight: 600;
        color: #0f172a;
    }
    .faq-meta {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        align-items: center;
        margin-top: 8px;
    }
    .faq-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 2px 10px;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
        background: #e2e8f0;
        color: #0f172a;
    }
    .faq-badge.success { background: #dcfce7; color: #166534; }
    .faq-badge.warning { background: #fee2e2; color: #991b1b; }
    .faq-answer {
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid #e2e8f0;
        color: #334155;
    }
    .faq-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 14px;
    }
    .faq-actions .btn {
        border-radius: 10px;
    }
    .faq-empty {
        text-align: center;
        padding: 40px 16px;
        color: #64748b;
        border: 1px dashed #cbd5f5;
        border-radius: 14px;
        background: #ffffff;
    }
    .faq-results {
        font-size: 0.85rem;
        color: #64748b;
        margin-top: 8px;
    }
</style>
@endpush

@section('content')
@php
    $totalFaqs = $faqs->count();
    $publishedFaqs = $faqs->where('published', true)->count();
    $draftFaqs = $totalFaqs - $publishedFaqs;
    $categoryCount = isset($faqcategories) ? $faqcategories->count() : 0;
@endphp

<div class="faq-tool">
    <div class="faq-header">
        <div>
            <h3>FAQs</h3>
            <p>Answer common questions quickly. Search, filter, and curate your knowledge base.</p>
        </div>
        <div class="faq-header-actions">
            <a href="{{ route('faqs.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> New FAQ</a>
        </div>
    </div>

    <div class="row faq-metrics">
        <div class="col-md-3 mb-3">
            <div class="metric-card">
                <div class="label">Total</div>
                <div class="value">{{ $totalFaqs }}</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="metric-card">
                <div class="label">Published</div>
                <div class="value">{{ $publishedFaqs }}</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="metric-card">
                <div class="label">Drafts</div>
                <div class="value">{{ $draftFaqs }}</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="metric-card">
                <div class="label">Categories</div>
                <div class="value">{{ $categoryCount }}</div>
            </div>
        </div>
    </div>

    <div class="faq-controls">
        <div class="row">
            <div class="col-md-5 mb-2">
                <input type="text" class="form-control" id="faq-search" placeholder="Search questions or answers...">
            </div>
            <div class="col-md-4 mb-2">
                <select class="custom-select" id="faq-category">
                    <option value="all">All categories</option>
                    @foreach ($faqcategories as $category)
                        <option value="{{ $category->id }}">{{ $category->label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-2">
                <select class="custom-select" id="faq-status">
                    <option value="all">All statuses</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
        </div>
        <div class="faq-results" id="faq-results">Showing {{ $totalFaqs }} FAQs</div>
    </div>

    <div class="faq-list" id="faq-list">
        @forelse ($faqs as $faq)
            @php
                $categoryLabel = $faq->FaqCategory && $faq->FaqCategory->label ? $faq->FaqCategory->label : 'Uncategorized';
            @endphp
            <article class="faq-item" data-question="{{ e($faq->question) }}" data-answer="{{ e(strip_tags($faq->answer)) }}" data-category="{{ $faq->faq_category_id ?? 'none' }}" data-status="{{ $faq->published ? 'published' : 'draft' }}">
                <details>
                    <summary>
                        <div>
                            <div class="faq-title">{{ $faq->question }}</div>
                            <div class="faq-meta">
                                <span class="faq-badge">{{ $categoryLabel }}</span>
                                @if ($faq->published)
                                    <span class="faq-badge success">Published</span>
                                @else
                                    <span class="faq-badge warning">Draft</span>
                                @endif
                                <span class="faq-badge">Updated {{ $faq->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <span class="text-muted"><i class="fa fa-chevron-down"></i></span>
                    </summary>
                    <div class="faq-answer">
                        {!! $faq->answer !!}
                        <div class="faq-actions">
                            <a class="btn btn-secondary btn-sm" href="{{ route('faqs.show', $faq->id) }}"><i class="fa fa-eye"></i> View</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('faqs.edit', $faq->id) }}"><i class="fa fa-pencil"></i> Edit</a>
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('faqs.toggle', $faq->id) }}">
                                <i class="fa {{ $faq->published ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                {{ $faq->published ? 'Unpublish' : 'Publish' }}
                            </a>
                            <form action="{{ route('faqs.destroy', $faq->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </details>
            </article>
        @empty
            <div class="faq-empty">
                <h5>No FAQs yet</h5>
                <p>Create your first FAQ to start helping users faster.</p>
                <a class="btn btn-primary" href="{{ route('faqs.create') }}">Create FAQ</a>
            </div>
        @endforelse
        <div class="faq-empty" id="faq-empty-results" style="display:none;">
            <h5>No results</h5>
            <p>Try adjusting your search or filters.</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        var searchInput = document.getElementById('faq-search');
        var categorySelect = document.getElementById('faq-category');
        var statusSelect = document.getElementById('faq-status');
        var resultsLabel = document.getElementById('faq-results');
        var emptyState = document.getElementById('faq-empty-results');
        var items = Array.prototype.slice.call(document.querySelectorAll('.faq-item'));

        function applyFilters() {
            var query = searchInput.value.trim().toLowerCase();
            var category = categorySelect.value;
            var status = statusSelect.value;
            var visibleCount = 0;

            items.forEach(function (item) {
                var text = (item.dataset.question + ' ' + item.dataset.answer).toLowerCase();
                var matchesQuery = !query || text.indexOf(query) !== -1;
                var matchesCategory = category === 'all' || item.dataset.category === category;
                var matchesStatus = status === 'all' || item.dataset.status === status;
                var isVisible = matchesQuery && matchesCategory && matchesStatus;

                item.style.display = isVisible ? '' : 'none';
                if (isVisible) {
                    visibleCount += 1;
                }
            });

            if (resultsLabel) {
                resultsLabel.textContent = 'Showing ' + visibleCount + ' FAQ' + (visibleCount === 1 ? '' : 's');
            }
            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? '' : 'none';
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', applyFilters);
        }
        if (categorySelect) {
            categorySelect.addEventListener('change', applyFilters);
        }
        if (statusSelect) {
            statusSelect.addEventListener('change', applyFilters);
        }
    })();
</script>
@endpush
