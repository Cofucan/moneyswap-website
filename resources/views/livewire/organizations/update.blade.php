<form>
    <input type="hidden" wire:model="organization_id">
    <div class="form-group mb-3">
        <label for="legalName">Name:</label>
        <input type="text" class="form-control @error('legal_name') is-invalid @enderror" id="legalName" placeholder="Enter Name" wire:model="legal_name">
        @error('legal_name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="legalName">registration number:</label>
        <input type="text" class="form-control @error('registration_number') is-invalid @enderror" id="registrationNumber" placeholder="Enter RC Number" wire:model="registration_number">
        @error('registration_number') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="shortName">Trading Name:</label>
        <textarea class="form-control @error('short_name') is-invalid @enderror" id="shortName" wire:model="short_name" placeholder="Enter Description"></textarea>
        @error('short_name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="d-grid gap-2">
        <button wire:click.prevent="update()" class="btn btn-success btn-block">Save</button>
        <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
    </div>
</form>
