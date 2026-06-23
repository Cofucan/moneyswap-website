<tr>
    <td>{{$loop->iteration }}</td>
    <td>{{$batch->label}}</td>
    <td>{{$batch->total_students}}</td>
    <td>{{$batch->elective_subjects }}</td>
    <td>{{$batch->mandatory_subjects }}</td>

    <td>
        @include('schoolmanagement::batches._actions')
    </td>
</tr>
