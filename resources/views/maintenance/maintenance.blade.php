<div class="panel panel-default side-panel">
    <div class="panel-heading">
        <span class="panel-title">Maintenance Mode Settings</span>
    </div>

    <div class="panel-body">
        {{ method_field('PUT') }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
            <div class="col-md-2">
                <label for="maintain-status">Status</label>
                @if(\Illuminate\Support\Facades\App::isDownForMaintenance() == true)
                    <span id="maintain-status" class="badge badge-success">Activated</span>
                @else
                    <span id="maintain-status" class="badge badge-secondary">Deactivated</span>
                @endif
            </div>

            <div class="col-md-10">
                <label for="maintain-reason">Message</label>
                <span id="maintain-reason">{{ \App\Settings::maintainMessage() }}</span>
            </div>
        </div>
    </div>

    <div class="panel-footer">
        <div class="row">
            <div class="col-6">
                <a href="{{ '/maintenance/change' }}" class="btn btn-danger">Status Change</a>
            </div>

            <div class="col-md-6 text-right">
                <a href="{{ '/maintenance/edit' }}" class="btn btn-primary">Change Message</a>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default side-panel">
    <div class="panel-heading">
        <span class="panel-title">Maintenance IP Whitelist</span>
    </div>

    <div class="panel-body">
        {{ method_field('PUT') }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
            <div class="col-md-12">
                @include('whitelist.index', ['entries' => \App\Settings::maintenanceWhitelist()])
            </div>
        </div>
    </div>

    <div class="panel-footer">
        <div class="row">
            <div class="col-md-12 text-right">
                <a class="btn btn-primary" href="{{ '/whitelist/create' }}">Add Entry</a>
            </div>
        </div>
    </div>
</div>