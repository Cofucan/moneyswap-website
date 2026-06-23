<div>
    <div class="col-md-8 mb-2">
        <div class="card">
            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif

                @if($updateOrganization)
                    @include('livewire.organizations.update')
                @else
                    @include('livewire.organizations.create')
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Trading Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($organizations) > 0)
                                @foreach ($organizations as $organization)
                                    <tr>
                                        <td>    {{$organization->legal_name}}
                                        </td>
                                        <td>
                                            {{$organization->short_name}}
                                        </td>
                                        <td>
                                            <button wire:click="edit({{$organization->id}})" class="btn btn-primary btn-sm">Edit</button>
                                            <button onclick="deleteOrganization({{$organization->id}})" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" align="center">
                                        No Record Found.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteOrganization(id){
            if(confirm("Are you sure to delete this record?"))
                window.livewire.emit('deleteOrganization',id);
        }
    </script>
</div>
