<nav class="navbar navbar-expand-lg navbar-dark">
    <span class="h1 navbar-brand mb-0">LoreTool v2.0</span>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/item/">Items</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Parties</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Notifications</a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <span>Signed in as <strong>{{ \Illuminate\Support\Facades\Auth::user()->getValue('username') }}</strong> | Sign out</span>
            </li>
        </ul>
    </div>
</nav>