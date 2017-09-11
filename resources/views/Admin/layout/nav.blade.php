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
                <li class="nav-item @if(\Illuminate\Support\Facades\Route::getFacadeRoot()->current()->uri() == '/') active @endif">
                    <a class="nav-link" href="/">Search</a>
                </li>

                <li class="nav-item @if(\Illuminate\Support\Facades\Route::getFacadeRoot()->current()->uri() == 'item') active @endif">
                    <a class="nav-link" href="/item/">Items</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Parties</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Notifications</a>
                </li>
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