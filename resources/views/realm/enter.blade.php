<div class="panel panel-default">
    <div class="panel-heading">Enter Realm</div>
    <div class="panel-body">
        <p>Do you wish to enter '{{ $realm->name }}'?</p>

        <div class="input-group">
            <span class="input-group-btn">
                <a class="btn btn-default" href="{{ url('realm/'. $realm->id .'/enter/' . Auth::user()->id) }}"><button class="btn-empty" type="button">Enter Realm</button></a>
            </span>
        </div>
    </div>
</div>