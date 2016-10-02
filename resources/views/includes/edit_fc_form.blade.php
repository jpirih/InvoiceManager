<form action="" method="post" class="form-horizontal" id="editForm">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="fc_name" class="control-label col-sm-4">Naziv</label>
        <div class="col-sm-8">
            <input type="text" name="fc_edit_name" id="fc_edit_name" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="fc_url" class="control-label col-sm-4">Url</label>
        <div class="col-sm-8">
            <input type="text" name="fc_edit_url" id="fc_edit_url" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="fc_logo_url" class="control-label col-sm-4">Logo Url</label>
        <div class="col-sm-8">
            <input type="text" name="fc_edit_logo_url" id="fc_edit_logo_url" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <button type="reset" class="btn btn-info">
                <span class="glyphicon glyphicon-refresh"></span>
                Izprazni Obrazec
            </button>
        </div>
        <div class="col-sm-8">
            <button type="submit" class="btn btn-success btn-block">
                <span class="glyphicon glyphicon-save"></span>
                Shrani Spremembe
            </button>
        </div>
    </div>
</form>