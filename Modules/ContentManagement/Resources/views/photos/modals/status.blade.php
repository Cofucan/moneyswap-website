<div class="form-popup" id="status">
    <form action="/action_page.php" class="form-container">
        <div class="form-group">
            <select name="post_status" class="custom-select d-block w-100" id="post_status" >
                <option value="Status"> Draft </option>
                <option> Pending Review</option>
            </select>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <button type="save" class="btn btn-sm btn-success" onclick="closeForm()">ok</button>
            </div>
            <div class="col-md-6">
                <a href="#" onclick="closeForm()">Cancel</a>
            </div>
        </div>
    </form>
</div>