<tr>
    <td>By: {{ $communication->User->Profile->name }}</td>
    <td> <a href="{{ route('communications.show', $communication->id) }}">{{ $communication->subject }} - ({{ $communication->activity_type }} )</a></td>
    <td><i class="fa fa-clock-o"></i>:{{ $communication->sent_date }}</td>
</tr>
        