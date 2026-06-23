@section('page_title', optional($page)->headline ?? 'How it Works')
@extends('layouts.theme')

@push('styles')
<link rel="stylesheet" href="{{ asset('modules/contentmanagement/css/howitworks-index.css') }}">
@endpush

@section('content')
@php
  $heroImage = !empty(optional($page)->display_image) ? asset($page->display_image) : asset('img/background/header-bg.jpg');
  $totalSections = $sections->count();
  $totalSteps = $sections->sum(function ($section) {
    return $section->items->count();
  });
@endphp

<div class="cm-hiw" data-cm-hiw>
  <section class="cm-hiw-hero" style="background-image:url('{{ $heroImage }}')">
    <div class="cm-hiw-hero__backdrop"></div>
    <div class="container cm-hiw-hero__inner">
      <p class="cm-hiw-kicker">Guided Workflow</p>
      <h1 class="cm-hiw-title">{{ optional($page)->headline ?? 'How it Works' }}</h1>
      <div class="cm-hiw-lead">{!! optional($page)->body !!}</div>
      <div class="cm-hiw-hero__actions">
        <a href="#cm-hiw-journey" class="cm-hiw-btn cm-hiw-btn--primary">Start The Journey</a>
        <a href="{{ url('register') }}" class="cm-hiw-btn cm-hiw-btn--ghost">Create Account</a>
      </div>
      <div class="cm-hiw-metrics">
        <div class="cm-hiw-metric">
          <span class="cm-hiw-metric__value">{{ $totalSections }}</span>
          <span class="cm-hiw-metric__label">Workflow Paths</span>
        </div>
        <div class="cm-hiw-metric">
          <span class="cm-hiw-metric__value">{{ $totalSteps }}</span>
          <span class="cm-hiw-metric__label">Action Steps</span>
        </div>
        <div class="cm-hiw-metric">
          <span class="cm-hiw-metric__value">24/7</span>
          <span class="cm-hiw-metric__label">Live Access</span>
        </div>
      </div>
    </div>
  </section>

  <section class="cm-hiw-journey-wrap" id="cm-hiw-journey">
    <div class="container">
      @if($totalSections > 0)
        <header class="cm-hiw-headline">
          <p class="cm-hiw-headline__eyebrow">Choose a path</p>
          <h2 class="cm-hiw-headline__title">Follow the exact path that matches your goal</h2>
          <p class="cm-hiw-headline__meta" data-hiw-progress>Step 1 of {{ $totalSections }}</p>
        </header>

        <nav class="cm-hiw-nav" aria-label="How it works sections">
          <div class="cm-hiw-nav__rail">
            @foreach($sections as $section)
              @php $panelId = 'cm-hiw-panel-' . $section->key; @endphp
              <button
                type="button"
                class="cm-hiw-nav__item {{ $loop->first ? 'is-active' : '' }}"
                data-hiw-nav
                data-target="{{ $panelId }}"
                data-index="{{ $loop->iteration }}"
                aria-controls="{{ $panelId }}"
                aria-selected="{{ $loop->first ? 'true' : 'false' }}"
              >
                <span class="cm-hiw-nav__step">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="cm-hiw-nav__label">{{ $section->title }}</span>
              </button>
            @endforeach
          </div>
        </nav>

        <div class="cm-hiw-panels">
          @foreach($sections as $section)
            @php
              $panelId = 'cm-hiw-panel-' . $section->key;
              $sectionLink = null;
              foreach ($section->items as $candidate) {
                if (!empty($candidate->button_url)) {
                  $sectionLink = url($candidate->button_url);
                  break;
                }
              }
            @endphp
            <section
              id="{{ $panelId }}"
              class="cm-hiw-panel {{ $loop->first ? 'is-active' : '' }}"
              data-hiw-panel
              role="region"
              aria-label="{{ $section->title }}"
            >
              <div class="row g-4">
                <aside class="col-lg-4">
                  <div class="cm-hiw-overview">
                    <p class="cm-hiw-overview__badge">Track {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</p>
                    <h3>{{ $section->title }}</h3>
                    @if(!empty($section->description))
                      <p>{{ $section->description }}</p>
                    @else
                      <p>Follow these steps in order for the smoothest experience.</p>
                    @endif
                    <div class="cm-hiw-overview__meta">
                      <span>{{ $section->items->count() }} Steps</span>
                      <span>{{ max($section->items->count() * 2, 3) }} mins (avg)</span>
                    </div>
                    <div class="cm-hiw-overview__actions">
                      @if($sectionLink)
                        <a href="{{ $sectionLink }}" class="cm-hiw-btn cm-hiw-btn--primary">Start This Path</a>
                      @else
                        <a href="{{ url('register') }}" class="cm-hiw-btn cm-hiw-btn--primary">Get Started</a>
                      @endif
                    </div>
                  </div>
                </aside>

                <div class="col-lg-8">
                  <div class="cm-hiw-steps">
                    @forelse($section->items as $item)
                      @php
                        $mediaPath = (string) $item->display_image;
                        $mediaExt = strtolower(pathinfo($mediaPath, PATHINFO_EXTENSION));
                        $isVideo = in_array($mediaExt, ['mp4', 'webm', 'mov'], true);
                        $summary = \Illuminate\Support\Str::limit(trim(strip_tags((string) $item->overview)), 190);
                      @endphp
                      <article class="cm-hiw-step" data-hiw-step>
                        <div class="cm-hiw-step__index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="cm-hiw-step__body">
                          <h4>{{ $item->label }}</h4>
                          <p>{{ $summary }}</p>

                          @if(!empty($mediaPath))
                            <div class="cm-hiw-step__media">
                              @if($isVideo)
                                <video controls preload="metadata" playsinline>
                                  <source src="{{ asset($mediaPath) }}" type="{{ $mediaExt === 'mov' ? 'video/quicktime' : 'video/' . $mediaExt }}">
                                </video>
                              @else
                                <img src="{{ asset($mediaPath) }}" alt="{{ $item->label }}" loading="lazy">
                              @endif
                            </div>
                          @endif

                          @if(!empty($item->button_text) && !empty($item->button_url))
                            <a href="{{ url($item->button_url) }}" class="cm-hiw-step__link">
                              {{ $item->button_text }}
                              <i class="bi bi-arrow-up-right"></i>
                            </a>
                          @endif
                        </div>
                      </article>
                    @empty
                      <div class="cm-hiw-empty">
                        No steps have been published for this workflow yet.
                      </div>
                    @endforelse
                  </div>
                </div>
              </div>
            </section>
          @endforeach
        </div>
      @else
        <div class="cm-hiw-empty cm-hiw-empty--standalone">
          No workflow sections are available yet.
        </div>
      @endif
    </div>
  </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('modules/contentmanagement/js/howitworks-index.js') }}" defer></script>
@endpush
