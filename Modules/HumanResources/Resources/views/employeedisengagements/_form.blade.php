<div class="form-group mb-2">
    <label for="modality">How the Employee Left </label>
    <select class="custom-select{{ $errors->has('modality') ? ' is-invalid' : '' }} d-block w-100 select2"  name="modality" id="modality" required>
        <option value="Fired" selected> Fired</option>
        <option value="Absconded" selected>Absconded</option>
        <option value="Resigned" selected> Resigned</option>
    </select>
    @if ($errors->has('modality'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('modality') }}</strong>
        </span>
    @endif
</div>
<div class="form-group ">
    <label for="reason">Why the employee left or need to leave</label>
    <textarea name="reason" class="form-control">
        {!! old('reason') !!}
    </textarea>
    @if ($errors->has('reason'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('reason') }}</strong>
        </span>
    @endif
</div>