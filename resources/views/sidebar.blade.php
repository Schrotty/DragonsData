<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">{{trans('sidebar.profile')}}</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                    <p>{{ Auth::user()->forename }} {{ Auth::user()->surname }}</p>
                    <span>{{ Auth::user()->name }} - {{ Auth::user()->rank->name }}</span>
                </div>

                <div class="col-md-4">
                    <a href="{{ url('user/'. Auth::user()->id) }}"><img src="{{ URL::to('/img') }}/{{ strtolower(Auth::user()->avatar) }}" class="default-avatar"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">{{trans('sidebar.characters')}}</div>
        <div class="panel-body">
            <span>{{ trans('sidebar.no_characters_found') }}</span>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">{{trans('sidebar.feed')}}</div>
            <div class="panel-body">
                {{ trans('sidebar.no_news_found') }}
            </div>
        </div>
    </div>
</div>