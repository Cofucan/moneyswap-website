<div>
    @if($showModal)
        <div class="modal fade show show-modal" tabindex="-1" id="mail-variable-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="mail-variable-form" wire:submit.prevent="submit">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">{{ !$itemId ? 'Create Variable' : 'Update Variable' }}</h5>
                            <button type="button" class="btn-close" wire:click="$emitTo('mail-variable.create-mail-variable', 'closeCreateModal')"></button>
                        </div>
                        <div class="modal-body">

                            @if (session()->has('success'))

                                <div class="alert alert-success">

                                    {{ session('success') }}

                                </div>

                            @endif

                            <div class="form-group">
                                <label>Key</label>
                                <input type="text" class="form-control" name="variable_key" wire:model.lazy="variableKey" />
                                @error('variableKey') <span class="invalid-feedback">{{ $message }}</span> @enderror

                                <div class="text-muted">
                                    Tip: Template variable keys must be unique and enclosed with two square brackets, <br/>
                                    <ul>
                                        <li>for static variables use uppercase letters like [WEBSITE_URL]</li>
                                        <li>for input variables use [INPUT:field_name] like [INPUT:name]</li>
                                        <li>for dynamic data use [DYNAMIC:$data]</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Value</label>
                                <input type="text" class="form-control" name="variable_value" wire:model.lazy="variableValue" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="$emitTo('mail-variable.create-mail-variable', 'closeCreateModal')">Close</button>
                            <button type="submit" class="btn btn-primary">{{ !$itemId ? 'Save' : 'Update' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
cd
