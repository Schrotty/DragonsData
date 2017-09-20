<nav class="navbar navbar-expand-lg navbar-dark">
    <span class="h1 navbar-brand mb-0">LoreTool v2.0</span>

    @if(!\Illuminate\Support\Facades\Auth::guest())
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    @endif

    <div class="navbar-collapse collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @if(!\Illuminate\Support\Facades\Auth::guest())
                <li class="nav-item @if(\App\Http\Controllers\Util\RouteHelper::isRoute('')) active @endif">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item @if(\App\Http\Controllers\Util\RouteHelper::isRoute('item')) active @endif">
                    <a class="nav-link" href="{{ url('/item') }}">Items</a>
                </li>

                <li class="nav-item @if(\App\Http\Controllers\Util\RouteHelper::isRoute('party')) active @endif">
                    <a class="nav-link" href="{{ url('/party') }}">Parties</a>
                </li>

                <li class="nav-item @if(\App\Http\Controllers\Util\RouteHelper::isRoute('notification')) active @endif">
                    <a class="nav-link" href="#">Notifications</a>
                </li>

                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                    <li class="nav-item @if(\App\Http\Controllers\Util\RouteHelper::isRoute('admin')) active @endif">
                        <a class="nav-link" href="{{ url('/admin') }}">Admin</a>
                    </li>
                @endif
            @endif
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                @if(!\Illuminate\Support\Facades\Auth::guest())
                    <span>Signed in as <strong>{{ \Illuminate\Support\Facades\Auth::user()->getValue('username') }}</strong> |

                        <a href="{{ url('/logout') }}" class="logout nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span>Sign out</span>
                        </a>
                    </span>
                @endif
            </li>
        </ul>

        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
              style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</nav>