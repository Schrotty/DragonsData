@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Notifications</span>
        </div>

        <div class="panel-body">
            @if(count($notifications) != 0)
                @foreach($notifications as $notification)
                        <div class="panel notification-panel">
                            <div class="panel-body {{ $notification->data['type'] }}">
                                <div class="row">
                                    <div class="col-md-1">
                                        <span class="oi oi-{{ $notification->data['icon'] }}"></span>
                                    </div>

                                    <div class="col-md-11 tetx-left">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div><strong>{{ $notification->data['message'] }}</strong></div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-11">
                                                <a href="{{ $notification->data['route'].'/'.$notification->data['id'] }}">
                                                    <span>{{ $notification->data['title'] }}</span>
                                                </a>
                                            </div>

                                            <div class="col-md-1">
                                                <form action="{{ 'notification/' . $notification->id }}" method="GET">
                                                    <input type="hidden" name="_method" value="GET">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                    <button type="submit" class="button btn-empty">
                                                        <span class="oi oi-check"></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            @else
                Nothing to show here!
            @endif
        </div>

        @if(count($notifications) != 0)
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a class="btn btn-primary" href="#" role="button">Mark all as read</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection