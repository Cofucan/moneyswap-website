<form>
    <div class="form-group mb-3">
        <label for="legalName">Name:</label>
        <input type="text" class="form-control @error('legal_name') is-invalid @enderror" id="legalName" placeholder="Enter Name" wire:model="legal_name">
        @error('legal_name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="shortName">Name:</label>
        <input type="text" class="form-control @error('short_name') is-invalid @enderror" id="shortName" placeholder="Enter Trading Name" wire:model="short_name">
        @error('short_name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="registrationNumber">Name:</label>
        <input type="text" class="form-control @error('registration_number') is-invalid @enderror" id="registrationNumber" placeholder="Enter Number" wire:model="registration_number">
        @error('registration_number') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    {{-- <div class="form-group mb-3">
        <label for="categoryDescription">Description:</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="categoryDescription" wire:model="description" placeholder="Enter Description"></textarea>
        @error('description') <span class="text-danger">{{ $message }}</span>@enderror
    </div> --}}
    <div class="d-grid gap-2">
        <button wire:click.prevent="store()" class="btn btn-success btn-block">Save</button>
    </div>
</form>
