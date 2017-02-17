<div class="row">
    <div class="col-md-6">
        <input required value="{{ $oObject->name }}" id="name" type="text" class="form-control" name="title" autofocus>
    </div>

    <div class="col-md-6">
        <div class="pull-right">
            <a href="{{ url('/' . $sParentModel . '/' . $sParentURL) }}">
                {{ trans('general.abort') }}
            </a>
        </div>
    </div>
</div>