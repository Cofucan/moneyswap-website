<div class="form-popup" id="visibility">
    <form action="/action_page.php" class="form-container">
        <fieldset class="form-group">
            <div class="row">
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                    <label class="form-check-label" for="gridRadios1">
                        Public
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                    <label class="form-check-label" for="gridRadios2">
                        Private
                    </label>
                </div>
            </div>
            </div>
        </fieldset>
        <div class="form-row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-sm btn-success" onclick="closeForm()">ok</button>
            </div>
            <div class="col-md-6">
                <a href="#" onclick="closevisibility()">Cancel</a>
            </div>
        </div>
    </form>
</div>