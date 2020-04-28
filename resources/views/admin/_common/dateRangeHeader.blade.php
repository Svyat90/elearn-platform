<form method="get">
    <div class="row">
        <div class="col-2 form-group">
            <label for='from' class='control-label'>{{ trans('global.timeFrom') }}</label>
            <input type="text" id="from" name="from" class="form-control date" value="{{ old('from', request()->get('from', date('Y-m-d'))) }}">
        </div>
        <div class="col-2 form-group">
            <label for='to' class='control-label'>{{ trans('global.timeTo') }}</label>
            <input type="text" id="to" name="to" class="form-control date" value="{{ old('to', request()->get('to', date('Y-m-d'))) }}">
        </div>
        <div class="col-4">
            <label class="control-label">&nbsp;</label><br>
            <button type="submit" class="btn btn-primary">{{ trans('global.filterDate') }}</button>
        </div>
    </div>
</form>