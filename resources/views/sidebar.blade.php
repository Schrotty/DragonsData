<div class="panel panel-default side-panel">
    <div class="panel-heading">Central Control</div>
    <div class="panel-body sidebar-menu">
        <ul class="list-group">
            <div class="list-group">
                <a href="{{ url('dashboard/') }}" class="list-group-item">
                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ url('user/' . Auth::user()->url) }}" class="list-group-item">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <span>View Profile</span>
                </a>

                <a href="#" class="list-group-item">
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                    <span>Notifications</span>
                </a>

                <a href="#" class="list-group-item">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    <span>Settings</span>
                </a>

                <a href="{{ url('/logout') }}" class="list-group-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    <span>Sign out</span>
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </ul>
    </div>
</div>

<div class="panel panel-default side-panel">
    <div class="panel-heading">Search</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." aria-describedby="basic-addon2">

                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Search</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

@can('isDungeonMaster', Auth::user())
    <div class="panel panel-default object-control-panel">
        <div class="panel-heading">{{trans('general.controls')}}</div>
        <div class="panel-body">
            <div class="row">
                <form id="new-object-form" class="form-horizontal" role="form" method="GET" action="{{ url('/realm/creator') }}">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        @include('widget.elements.objects_dropdown')
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-default btn-block"
                                value="{{ trans('general.create') }}">{{ trans('general.create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcan