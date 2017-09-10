@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <div class="panel-title">
                {{ $item->name }}
                <small class="text-muted"> - {{ \App\Category::find($item->category)->name }}</small>
            </div>
        </div>

        <div class="panel-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <div class="realm-player">
                            <dt>Author</dt>
                            @php $user = \App\User::find($item->author) @endphp
                            <dd>{{ $user->username ?? 'Unknown' }}</dd>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="realm-player">
                            <dt>Contributors</dt>
                            @if(count($item->contributors) > 0)
                                {{ app('debugbar')->info($item->contributors) }}
                                @foreach($item->contributors as $id)

                                    @php $user = \App\User::find($id) @endphp
                                    @if(!$loop->last)
                                        <dd>{{ $user->username }},</dd>
                                    @else
                                        <dd>{{ $user->username }}</dd>
                                    @endif
                                @endforeach
                            @else
                                <dd>-</dd>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="realm-player">
                            <dt>Known</dt>
                            @if($item->known != null)
                                @foreach($item->known as $id)
                                    @php $user = \App\User::find($id) @endphp
                                    @if(!$loop->last)
                                        <span>{{ $user->username }},</span>
                                    @else
                                        <span>{{ $user->username }}</span>
                                    @endif
                                @endforeach
                            @else
                                <dd>-</dd>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-8">
                        <div class="realm-player">
                            <dt>References</dt>
                            @if($item->parents != null)
                                @foreach($item->parents as $id)
                                    @php $itm = \App\Item::find($id) @endphp
                                    @if(!$loop->last)
                                        <span><a href="{{ url('item/' . $itm->_id) }}">{{ $itm->name }},</a></span>
                                    @else
                                        <span><a href="{{ url('item/' . $itm->_id) }}">{{ $itm->name }}</a></span>
                                    @endif
                                @endforeach
                            @else
                                <dd>-</dd>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="realm-player">
                            <dt>Tags</dt>
                            @if($item->tags != null)
                                @foreach($item->tags as $id)
                                    @php $tag = \App\Tag::find($id) @endphp
                                    @if($tag != null)
                                        <span class="label label-{{ $tag->style }}">{{ $tag->name }}</span>
                                    @endif
                                @endforeach
                            @else
                                <dd>-</dd>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        @if(count($item->properties) > 0)
                            <dt>Properties</dt>
                            @php $i = 0; @endphp
                            @foreach($item->properties as $property => $value)
                                @if(($i % 3) == 0)
                                    <div class="row">
                                        @endif

                                        <div class="realm-player col-md-4">
                                            @php $prop = \App\Property::find($property) @endphp
                                            @if($prop != null)
                                                <dt>{{ $prop->name }}</dt>
                                                <dd>{{ $value }}</dd>
                                            @endif
                                        </div>

                                        @if($loop->last || ($i % 3) == 2)
                                    </div>
                                @endif

                                @php $i++; @endphp
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-grop">
                <div class="row">
                    <div class="col-md-12 description-box">
                        @if($item->description != null)
                            <dt>Description</dt>
                            {!! $item->description !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @can('update', $item)
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ '/item/' . $item->_id . '/edit' }}">
                            <button type="submit" class="btn btn-primary">Edit Item</button>
                        </a>
                    </div>
                </div>
            </div>
        @endcan
    </div>
@endsection