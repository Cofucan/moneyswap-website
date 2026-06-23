<div class="form-popup" id="Publish">
    <form action="" class="form-container">
        <div class="form-row">
            <div class="col-md-6">
                <input type="date" name="publish_date" value="date" class="form-control" id="publish_date"/>
            </div>
            <div class="col-md-1">
                @
            </div>
            <div class="col-md-5">
                <input type="time" name="publish_time" value="time" class="form-control" id="publish_date"/>
            </div>
        </div><br>
        <div class="form-row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-sm btn-success" onclick="closeForm()">ok</button>
            </div>
            <div class="col-md-6">
                <a href="#" onclick="closePublish()">Cancel</a>
            </div>
        </div>
    </form>
</div>