@if($client->kindreds->count() > 0)
    <h5 class="mt-3">Relatives of {{ $client->name }}</h5>
    <div class="table-responsive">
        <table class="table w-100 " id="table">
           @include('clientmanagement::kindreds._tablehead')
            <tbody>
                @foreach($client->kindreds as $kindred)
                @include('clientmanagement::kindreds._tabledata')
                @endforeach
            </tbody>
        </table>
    </div>
@endif
