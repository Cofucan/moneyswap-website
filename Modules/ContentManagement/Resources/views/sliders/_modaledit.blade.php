 {{-- modal begins--}}
 <div class="modal fade" id="editslider{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-caption text-center">Edit {{ $slider->caption }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sliders.update', $slider) }}" method="POST"  id="UpdateSlider">
                    {{csrf_field()}}
                    @method('PUT')             
                    @include('contentmanagement::sliders._formedit')

                    <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
{{-- modal ends--}}