<tr>
    <td>{{$telephone->phone_number}} ({{$telephone->phone_tag}})</td>
    <td>
    @if(Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3  || Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 16 )
        <div class="row">
        <div class="col-md-6 col-6">                                            
            @include('contactmanagement::telephones._editmodal')
        </div>
        <div class="col-md-6 col-6">
        @include('contactmanagement::telephones._removeform')
            
        </div>
        </div>
    @endif
    </td>
</tr>