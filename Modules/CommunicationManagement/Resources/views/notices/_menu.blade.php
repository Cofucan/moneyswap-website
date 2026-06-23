<div class="message-links">
    <ul>
        <li><a href="{{ route('announcements.inbox', Auth::id()) }}"><i class="fa fa-inbox"></i> Inbox</a></li>
        <li><a href="{{ route('announcements.outbox', Auth::id()) }}"><i class="fa fa-send"></i> Outbox</a></li>
        <li><a href="{{ route('announcements.academicterm', $currentterm->id) }}"><i class="fa fa-calendar-o"></i> Term</a></li>
        @if (Auth::user()->profile->role_id == 11)
        <li><a href="{{ route('announcements.outbox', Auth::id()) }}"><i class="fa fa-refresh"></i> Pending</a></li>
        @endif

    </ul>
</div>
