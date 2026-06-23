@section('page_title', optional($page)->headline ?? 'Frequently Asked Questions')
@extends('layouts.theme')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/faq.css') }}">
<link rel="stylesheet" href="{{ asset('modules/contentmanagement/css/faq-index.css') }}">
@endpush

@section('content')
@php
  $headline = optional($page)->headline ?? 'Frequently Asked Questions';
  $heroImage = !empty(optional($page)->display_image) ? asset($page->display_image) : asset('img/background/header-bg.jpg');
  $totalFaqs = $faqSections->sum(function ($section) {
      return $section->faqs->count();
  });
@endphp

<section class="set-bg page-banner" data-setbg="{{ $heroImage }}">
  <div class="container">
    <div class="row">
      <div class="col-md-9 offset-md-1 text-left text-white text-uppercase">
        <h1 class="mt-5 mb-lg-5 text-white">{{ $headline }}</h1>
      </div>
    </div>
  </div>
</section>

<section class="cm-faq" data-cm-faq>
  <div class="container">
    <div class="cm-faq__intro" data-aos="fade-up">
      <span class="cm-faq__eyebrow">Help Center</span>
      <h2 class="cm-faq__title">Find answers by category</h2>
      <p class="cm-faq__meta">{{ $faqSections->count() }} categories · {{ $totalFaqs }} questions</p>
    </div>

    @if($faqSections->isNotEmpty())
      <div class="cm-faq__category-nav" data-aos="fade-up" data-aos-delay="100">
        @foreach($faqSections as $section)
          @php $sectionAnchor = 'faq-category-' . ($section->slug ?: $section->id); @endphp
          <a href="#{{ $sectionAnchor }}" class="cm-faq__category-link {{ $loop->first ? 'is-active' : '' }}" data-faq-category-link>
            <span>{{ $section->label }}</span>
            <span class="cm-faq__category-count">{{ $section->faqs->count() }}</span>
          </a>
        @endforeach
      </div>

      <div class="faq-groups">
        @foreach($faqSections as $section)
          @php
            $sectionAnchor = 'faq-category-' . ($section->slug ?: $section->id);
          @endphp
          <div class="cm-faq__group" id="{{ $sectionAnchor }}" data-faq-category-group data-aos="fade-up" data-aos-delay="{{ 80 + ($loop->index * 20) }}">
            <div class="cm-faq__group-head">
              <h3 class="cm-faq__group-title">{{ $section->label }}</h3>
              @if(!empty($section->overview))
                <p class="cm-faq__group-desc">{{ $section->overview }}</p>
              @endif
            </div>
            <div class="faq-container">
              @foreach($section->faqs as $faq)
                <div class="faq-item {{ $loop->first ? 'faq-active' : '' }}">
                  <h3><span>{{ $loop->iteration }}</span> {{ $faq->question }}</h3>
                  <div class="faq-content">
                    <p>{{ $faq->answer }}</p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="cm-faq__empty">
        No FAQ entries are available right now.
      </div>
    @endif
  </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('modules/contentmanagement/js/faq-index.js') }}" defer></script>
@endpush
