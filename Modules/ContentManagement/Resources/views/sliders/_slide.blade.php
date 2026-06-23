<section class="hero">
    <div class="hero_slider owl-carousel">
        @foreach ($slides as $slider)
        <div class="hero_item set-bg" data-setbg="{{ asset($slider->display_media) }}">
           <div class="container-fluid slide-content">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="hero_text">
                            <h2>{!! $slider->caption !!}</h2>
                            <h5>{!! $slider->highlight !!}</h5>
                            @if (!is_null($slider->button_one_link))
                            <a href="{{ url($slider->button_one_link) }}" class="primary-btn">{{ $slider->button_one }}</a>
                            @endif
                            @if (!is_null($slider->button_two_link))
                            <a href="{{ url($slider->button_two_link) }}" class="white-btn">{{ $slider->button_two }}</a>
                            @endif
                        </div>
                    </div>
                </div>
           </div>
        </div>
        @endforeach
    </div>
</section>