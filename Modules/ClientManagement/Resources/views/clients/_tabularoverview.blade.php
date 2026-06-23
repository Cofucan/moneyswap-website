<table class="table table-bordered">
    <tr>
        <td width="50%"><b>Client Name:</b>  {{ $client->name }}</td>
        <td><b>Reference No:</b> {{ $client->roll_no }}</td>

    </tr>

<tr>
    <td width="50%"><b>Gender:</b>   {{ $client->Profile->gender }} </td>
        
        <td><b>Category:</b> {{$client->category_name}}</td>
    </tr>
    <tr>
    <td><b>Date Of Birth:</b>   {{ $client->Profile->birthday }}</td>
    <td><b>Class:</b>  {{$client->program_name}}</td>
    </tr>
<tr>
</table>