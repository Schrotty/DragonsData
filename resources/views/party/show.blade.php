@extends('layout.app')

@section('content')

    <!-- Containerr -->
    <div class="panel panel-default">

        <!-- Heading -->
        <div class="panel-heading">
            <span class="panel-title">{{ $party->name }}</span>
        </div>

        <!-- Content -->
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <dt>Member</dt>
                    <dd>
                        @if($party->member != null)
                            @foreach($party->member as $id)
                                @php $player = \App\User::find($id) @endphp
                                @if($player != null){{ $player->username }}@if(!$loop->last),@endif @endif
                            @endforeach
                        @else
                            -
                        @endif
                    </dd>
                </div>

                <div class="col-md-4">
                    <dt>Player</dt>
                    <dd>
                        @if($party->player != null)
                            @foreach($party->player as $id)
                                @php $player = \App\Item::find($id) @endphp
                                @if($player != null)<a href="{{ '/item/'.$player->_id }}">{{ $player->name }}</a>@if(!$loop->last),@endif @endif
                            @endforeach
                        @else
                            -
                        @endif
                    </dd>
                </div>

                <div class="col-md-4">
                    <dt>Chronist</dt>
                    <dd>{{ \App\User::find($party->chronist)->username ?? 'Unknown' }}</dd>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <dt>Journal</dt>
                    <dd>
                        @if(count(\App\Journal::find($party->journal)->description) > 0)
                            {!! \App\Journal::find($party->journal)->description !!}
                        @else
                            -
                        @endif
                    </dd>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @can('update', \App\Journal::find($party->journal))
            <div class="panel-footer text-right">
                <div class="row text-right">
                    <div class="col-md-12">
                        <a href="{{ '/journal/' . $party->journal . '/edit' }}">
                            <button class="btn btn-primary">
                                Edit Journal
                            </button>
                        </a>

                        @can('update', $party)
                            <a href="{{ '/party/' . $party->_id . '/edit' }}">
                                <button class="btn btn-primary">
                                    Edit Party
                                </button>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        @endcan
    </div>
@endsection