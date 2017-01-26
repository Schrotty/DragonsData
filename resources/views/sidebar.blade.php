<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">{{trans('sidebar.profile')}}</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                    <p>Ruben Maurer</p>
                    <span>{{Auth::user()->name}} - @if(Auth::user()->isAdmin) Admin @else Member @endif</span>
                </div>

                <div class="col-md-4">
                    <img src="{{ URL::to('/img') }}/{{ strtolower(Auth::user()->avatar) }}" class="default-avatar">
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