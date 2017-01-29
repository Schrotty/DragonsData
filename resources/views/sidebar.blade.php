<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">{{trans('general.profile')}}</div>
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

<!--
    <div class="panel panel-default">
        <div class="panel-heading">{{trans_choice('character.characters', 2)}}</div>
        <div class="panel-body">
            <span>{{ trans('character.no_characters_found') }}</span>
        </div>
    </div>
-->

    <div class="panel panel-default">
        <div class="panel-heading">{{trans('general.feed')}}</div>
            <div class="panel-body">
                {{ trans('general.no_feed') }}
            </div>
        </div>
    </div>
</div>