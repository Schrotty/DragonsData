<div class="panel panel-default side-panel">
    <div class="panel-body">
        <form action="/search" method="POST">
            <div class="input-group">
                {{ method_field('POST') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">Go!</button>
                </span>

                <input name="query" type="text" class="form-control" placeholder="Search for..." aria-label="Search for...">
            </div>
        </form>
    </div>
</div>