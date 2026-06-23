<div class="client-image">      
    <a href="{{  route('clients.show', $client) }}">
        <img src="{{ asset($client->Profile->passport) }}">
        <p>{{ $client->name }}</p>       
    </a>
</div>