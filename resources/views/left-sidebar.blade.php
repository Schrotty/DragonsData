<div class="panel panel-default side-panel">
    <div class="panel-heading">
        <span class="panel-title">Central Control</span>
    </div>

    <div class="panel-body sidebar-menu">
        <ul class="list-group">
            <div class="list-group">
                <a href="{{ url('/') }}" class="list-group-item">
                    <span class="oi oi-home"></span>
                    <span>Home</span>
                </a>

                <a href="{{ url('/user/'.strtolower(\Illuminate\Support\Facades\Auth::user()->username)) }}" class="list-group-item">
                    <span class="oi oi-person"></span>
                    <span>Profile</span>
                </a>

                <a href="{{ url('/notifications') }}" class="list-group-item">
                    <span class="oi oi-chat"></span>
                    <span>Notifications
                        @if(count(\Illuminate\Support\Facades\Auth::user()->notifications) > 0)
                            <span class="badge badge-secondary">
                                {{ count(\Illuminate\Support\Facades\Auth::user()->notifications) }}
                            </span>
                        @endif
                    </span>
                </a>

                <a href="{{ url('/account') }}" class="list-group-item">
                    <span class="oi oi-cog"></span>
                    <span>Account</span>
                </a>

                <div class="dropdown-divider"></div>

                <a href="{{ url('/logout') }}" class="list-group-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="oi oi-account-logout"></span>
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