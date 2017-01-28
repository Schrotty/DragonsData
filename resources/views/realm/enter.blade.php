<div class="panel panel-default">
    <div class="panel-heading">{{ trans('realm.enter') }}</div>
    <div class="panel-body">
        <p>{{ trans('realm.enter_question', ['name' => $realm->name]) }}</p>

        <div class="input-group">
            <span class="input-group-btn">
                <a class="btn btn-default" href="{{ url('realm/'. $realm->id .'/enter/') }}">
                    <button class="btn-empty" type="button">{{ trans('realm.enter') }}</button>
                </a>
            </span>
        </div>
    </div>
</div>