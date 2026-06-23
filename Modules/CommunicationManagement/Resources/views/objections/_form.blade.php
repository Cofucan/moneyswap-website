@push('styles')
    <style>        
        p{
            margin-bottom: 5px
        }
        .btn-white{
            background: #fff;
            color: #000 !important;
        }
    </style>
@endpush
<div class="small-box bg-red py-3 px-3 mt-2 mb-3">                     
   <p class="text-white">{!! $objection->reason!!}</p>
    <span class="text-white mb-2"><strong>Rejected By: </strong> {{ $objection->Creator->Profile->full_name }}</span>
    <hr>
    <form action="{{ route('objections.process') }}" method="POST"
        onsubmit="return confirm('Clikc OK to Confirm your Action ?');">
        {{csrf_field()}}
        <input type="hidden" name="objection_id" value="{{ $objection->id }}">
        <button type="submit" class="btn btn-white btn-danger btn-sm px-3" name="status" value="Resolved"> Mark as Resolve</button>
    </form>
            
</div>  