<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">{{trans('general.profile')}}</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                    <p>{{ Auth::user()->forename }} {{ Auth::user()->surname }}</p>
                </div>

                <div class="col-md-4">
                    <a href="{{ url('user/'. Auth::user()->username()) }}"><img
                                src="{{ URL::to('/img') }}/{{ strtolower(Auth::user()->avatar) }}"
                                class="default-avatar"></a>
                </div>
            </div>
        </div>
    </div>

    @can('isDungeonMaster', Auth::user())
        <div class="panel panel-default object-control-panel">
            <div class="panel-heading">{{trans('general.controls')}}</div>
            <div class="panel-body">
                <div class="row">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/object-create') }}">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            @include('widgets.elements.objects_dropdown')
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-default btn-block"
                                    value="{{ trans('general.create') }}">{{ trans('general.create') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">{{trans('general.feed')}}</div>
            <div class="panel-body">
                {{ trans('general.no_feed') }}
            </div>
        </div>
    </div>
</div>