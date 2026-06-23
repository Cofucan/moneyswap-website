@section('page_title', 'Photo Studio')
@extends('layouts.theme')
@push('style')

<link rel="stylesheet" href="{{ asset('css/compact-gallery.css')}}">
<link href="{{ asset ('css/gallery.css')}}" rel="stylesheet">
@endpush
@section('content')
      <div class="container section-padding">
        <nav aria-label ="breadcrumb bg-white">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"> <a href="{{ url('/') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Pictures</li>
              
          </ol>
        </nav>
          <div class="row mt-3">
            <div class="col-md-2 side-menu">
                
              <div class="side-menu-header">
                  <h5>View By Albums <i class="fa fa-list-ul"></i></h5>
              </div>
              <div class="quick-links">
                  <ul>
                    @foreach ($albums as $album)
                    <li><a href="{{url('photos', $album)}}">{{$album->label}}</a></li>
                    @endforeach
                  </ul> 
              </div>
          
            </div>
            <div class="col-md-10"> 
              <div class="section-title">
                <h3> Most Recent  Photos                  </h3>
              </div>                
    
              <div class="row">
                @foreach($photos as $photo)      
                  @include('contentmanagement::photos.single')
                @endforeach
                
              </div>

              <div class="section-title mt-4">
                <h3> Most Recent Outreach</h3>
              </div>                
    
             
             
        </div>
            
    </div>
</div> 

@endsection
@push('script')
      <script>
        let modalId = $('#image-gallery');
      
        $(document)
          .ready(function () {
      
            loadGallery(true, 'a.thumbnail');
      
            //This function disables buttons when needed
            function disableButtons(counter_max, counter_current) {
              $('#show-previous-image, #show-next-image')
                .show();
              if (counter_max === counter_current) {
                $('#show-next-image')
                  .hide();
              } else if (counter_current === 1) {
                $('#show-previous-image')
                  .hide();
              }
            }
      
            /**
            *
            * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
            * @param setClickAttr  Sets the attribute for the click handler.
            */
      
            function loadGallery(setIDs, setClickAttr) {
              let current_image,
                selector,
                counter = 0;
      
              $('#show-next-image, #show-previous-image')
                .click(function () {
                  if ($(this)
                    .attr('id') === 'show-previous-image') {
                    current_image--;
                  } else {
                    current_image++;
                  }
      
                  selector = $('[data-image-id="' + current_image + '"]');
                  updateGallery(selector);
                });
      
              function updateGallery(selector) {
                let $sel = selector;
                current_image = $sel.data('image-id');
                $('#image-gallery-title')
                  .text($sel.data('title'));
                $('#image-gallery-image')
                  .attr('src', $sel.data('image'));
                disableButtons(counter, $sel.data('image-id'));
              }
      
              if (setIDs == true) {
                $('[data-image-id]')
                  .each(function () {
                    counter++;
                    $(this)
                      .attr('data-image-id', counter);
                  });
              }
              $(setClickAttr)
                .on('click', function () {
                  updateGallery($(this));
                });
            }
          });
      
        // build key actions
        $(document)
        .keydown(function (e) {
          switch (e.which) {
            case 37: // left
              if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
                $('#show-previous-image')
                  .click();
              }
              break;
      
            case 39: // right
              if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
                $('#show-next-image')
                  .click();
              }
              break;
      
            default:
              return; // exit this handler for other keys
          }
          e.preventDefault(); // prevent the default action (scroll / move caret)
        });
      </script>
<script src="{{ asset ('plugins/magnific-popup/magnific-popup.min.js')}}"></script>
@endpush
