<div class="panel panel-default side-panel">
    <div class="panel-heading">
        <span class="panel-title">Central Control</span>
    </div>
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
    <div class="panel-heading">
        <span class="panel-title">Search</span>
    </div>
    <form id="search" class="form-horizontal" role="form" method="post" action="{{ url('/search') }}">
        {{ csrf_field() }}
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group">
                        <input name="keyword" type="text" class="form-control" placeholder="Search for..."
                               aria-describedby="basic-addon2">

                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@if(true == false)
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Object Creator</span>
        </div>
        <form id="search" class="form-horizontal" role="form" method="get" action="{{ url('/test') }}">
            {{ csrf_field() }}
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            @include('widget.elements.objects_dropdown')

                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endif