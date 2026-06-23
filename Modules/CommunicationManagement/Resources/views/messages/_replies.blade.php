@foreach($conversations as $conversation)
    <div class="display-conversation">
        <strong>{{ $conversation->user->name }}</strong>
        <p>{{ $conversation->comment }}</p>
        <a href="" id="reply"></a>
        <form method="POST" action="{{ route('conversations.addreply') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="comment" class="form-control" />
                <input type="hidden" name="message_id" value="{{ $message_id }}" />
                <input type="hidden" name="conversation_id" value="{{ $conversation->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
        </form>
        @include('messages._replies', ['conversations' => $conversation->replies])
    </div>
@endforeach
