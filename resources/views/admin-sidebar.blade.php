<div class="panel panel-default side-panel">
    <div class="panel-heading">
        <span class="panel-title">Admin Panel</span>
    </div>

    <div class="panel-body sidebar-menu">
        <ul class="list-group">
            <div class="list-group">
                <a href="{{ url('/item') }}" class="list-group-item">
                    <span class="oi oi-document"></span>
                    <span>Items</span>
                </a>

                <a href="{{ url('/category') }}" class="list-group-item">
                    <span class="oi oi-spreadsheet"></span>
                    <span>Categories</span>
                </a>

                <a href="{{ url('/news') }}" class="list-group-item">
                    <span class="oi oi-rss"></span>
                    <span>News</span>
                </a>

                @if(\Illuminate\Support\Facades\Auth::user()->isRoot())
                    <a href="{{ url('/user') }}" class="list-group-item">
                        <span class="oi oi-people"></span>
                        <span>User</span>
                    </a>
                @endcan

                <form></form>
            </div>
        </ul>
    </div>
</div>