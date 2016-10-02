<form action="{{ route('new_fc') }}" method="post" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="fc_name" class="control-label col-sm-4">Naziv</label>
        <div class="col-sm-8">
            <input type="text" name="fc_name" id="fc_name" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="fc_url" class="control-label col-sm-4">Url</label>
        <div class="col-sm-8">
            <input type="text" name="fc_url" id="fc_url" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="fc_logo_url" class="control-label col-sm-4">Logo Url</label>
        <div class="col-sm-8">
            <input type="text" name="fc_logo_url" id="fc_logo_url" class="form-control">
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
                Shrani Podatke
            </button>
        </div>
    </div>
</form>