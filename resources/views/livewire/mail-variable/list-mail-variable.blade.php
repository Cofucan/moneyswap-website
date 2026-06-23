<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Mail Variables</div>


                <div class="card-body">
                    <button type="button" class="btn btn-secondary create-btn" style="float: right" wire:click="$emitTo('mail-variable.create-mail-variable', 'showCreateModal')"><i class="fa fa-plus"></i> Create</button>
                    <table class="table table-stripped">
                        <thead>
                        <tr>
                            <th>Variable Key</th>
                            <th>Variable Value</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($allVariables as $item)
                            <tr>
                                <td>{{$item->variable_key}}</td>
                                <td>{{$item->variable_value}}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-info btn-edit" wire:click="$emitTo('mail-variable.create-mail-variable', 'showCreateModalForUpdate', {{$item->id}})"><i class="fa fa-edit"></i> Edit</button>
                                </td>
                                <td>
                                    <form method="post" action="#" wire:submit.prevent="deleteVariable({{$item->id}})">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('are you sure?')"><i class="fa fa-remove"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No variables</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $allVariables->links() }}
                </div>
            </div>
        </div>
    </div>

    @livewire('mail-variable.create-mail-variable')
</div>
