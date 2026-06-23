<a href="{{ url('/messages/create') }}" class="btn btn-block btn-sm btn-success mb-3 "> <i class="fa fa-plus"></i> Compose</a>
<div class="message-links">
    <ul>
        <li><a href="{{ url('/messages') }}" class="active"><i class="fa fa-inbox"></i> Inbox</a></li>
        <li><a href="{{ url('/messages/mailbox', 'Draft') }}"><i class="fa fa-save"></i> Draft</a></li>
        <li><a href="{{ url('/messages/mailbox', 'Sent') }}"><i class="fa fa-send"></i> Sent</a></li>
        <li><a href="{{ url('/messages/mailbox', 'Archive') }}" ><i class="fa fa-archive"></i> Archive</a></li>
        <li><a href="{{ url('/messages/mailbox', 'Trash') }}" ><i class="fa fa-trash"></i> Trash</a></li>
        
    </ul> 
</div>