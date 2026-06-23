 {{-- <a href="{{ url('expertise', $expertise->slug) }}"> --}}
    <div class="expertise">
        <!-- Front -->        
        <div class="service-img">
            <img src="{{ asset ($expertise->thumbnail) }}" alt="" class="w-100">
        </div>
        <div class="content">
            <h5><a href="#">{{ $expertise->expertise_title }}</a></h5>
                {!! str_limit($expertise->expertise_brief, $limit = 80, $end = '...') !!} <br>
                <a href="{{ url('expertise', $expertise->slug) }}" class="genric-btn primary btn mt-3"> Read More</a>
        </div>
    </div>
    
{{-- </a> --}}