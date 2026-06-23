<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="country" class="control-label">{{ __('Country') }}</label>

            <select wire:model="selectedCountry" class="form-control">
                <option value="" selected>Choose country</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- @if (!is_null($selectedCountry)) -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="state" class="">{{ __('State') }}</label>
                <select wire:model="selectedState" class="form-control">
                    <option value="" selected>Choose state</option>
                    @foreach($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    <!-- @endif -->

    <!-- @if (!is_null($selectedState)) -->
        <div class="col-md-4">
            <div class="form-group">
            <label for="city" class="">{{ __('City') }}</label>

                <select wire:model="selectedCity" class="form-control" name="city_id">
                    <option value="" selected>Choose city</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    <!-- @endif -->
</div>
