@extends('layouts.admin')
@section('page_title', 'Add FAQ')

@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<style>
    .faq-form-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
    }
    .faq-sidebar {
        background: #f8fafc;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #e2e8f0;
    }
    .faq-sidebar h5 {
        font-weight: 700;
    }
    .faq-hint {
        color: #64748b;
        margin-bottom: 12px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
            <i class="fa fa-home"></i> Dashboard
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('faqs/manage')}}" class="s-text16">
            FAQs
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
            create
        </span>
    </div>

    <div class="row">
        <div class="col-lg-4 order-lg-2 mb-4">
            <div class="faq-sidebar">
                <h5>FAQ writing tips</h5>
                <p class="faq-hint">Keep questions clear and specific. Answers should be short, friendly, and actionable.</p>
                <ul class="text-muted">
                    <li>Use a single question per entry.</li>
                    <li>Start answers with the most important info.</li>
                    <li>Group similar topics into a category.</li>
                </ul>
            </div>
        </div>

        <div class="col-lg-8 order-lg-1">
            <div class="faq-form-card">
                <h4 class="mb-3">Add New FAQ</h4>
                <form method="POST" action="{{ route('faqs.store') }}" id="CreateFaq" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="faq_category_id">Category</label>
                        <select name="faq_category_id" id="faq_category_id" class="form-control select2" required>
                            <option value="">Select a category</option>
                            @foreach ($faqcategories as $category)
                                <option value="{{ $category->id }}" {{ old('faq_category_id') == $category->id ? 'selected' : '' }}>{{ $category->label }}</option>
                            @endforeach
                        </select>
                        @error('faq_category_id')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                        @if ($faqcategories->isEmpty())
                            <small class="text-muted d-block mt-2">No FAQ categories available yet.</small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" name="question" value="{{ old('question') }}" class="form-control" id="question" required />
                        @error('question')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <textarea name="answer" class="form-control" id="answer" rows="7" placeholder="Write a helpful answer...">{{ old('answer') }}</textarea>
                        @error('answer')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="published" name="published" {{ old('published', true) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="published">Publish immediately</label>
                        </div>
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-success" type="submit">Save FAQ</button>
                    <a class="btn btn-light" href="{{ route('faqs.manage') }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    if (window.CKEDITOR) {
        CKEDITOR.replace('answer');
    }
</script>
@endpush
