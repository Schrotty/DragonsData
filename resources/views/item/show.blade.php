@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        {{ $item->name }}
                        <small class="text-muted"> - {{ \App\Category::find($item->category)->name }}</small>
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="realm-player">
                        <div>Author</div>
                        @php $user = \App\User::find($item->author) @endphp
                        <span>{{ $user->username }}</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="realm-player">
                        <div>Contributors</div>
                        @if($item->contributors != null)
                            @foreach($item->contributors as $id)
                                @php $user = \App\User::find($id) @endphp
                                @if(!$loop->last)
                                    <span>{{ $user->username }},</span>
                                @else
                                    <span>{{ $user->username }}</span>
                                @endif
                            @endforeach
                        @else
                            <span>-</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="realm-player">
                        <div>Known</div>
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
                            <span>-</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="realm-player">
                        <div>Parents</div>
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
                            <span>-</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="realm-player">
                        <div>Tags</div>
                        @if($item->tags != null)
                            @foreach($item->tags as $id)
                                @php $tag = \App\Tag::find($id) @endphp
                                @if($tag != null)
                                    <span class="label label-{{ $tag->style }}">{{ $tag->name }}</span>
                                @endif
                            @endforeach
                        @else
                            <span>-</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @if($item->properties)
                        @php $i = 0; @endphp
                        @foreach($item->properties as $property => $value)
                            @if(($i % 3) == 0)
                                <div class="row">
                            @endif

                            <div class="realm-player col-md-4">
                                @php $prop = \App\Property::find($property) @endphp
                                @if($prop != null)
                                    <div>{{ $prop->name }}</div>
                                    <span>{{ $value }}</span>
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

            <div class="description-box">
                @if($item->description != null)
                    <h2>Description</h2>
                    {!! $item->description !!}
                @endif
            </div>
        </div>

        @can('update', $item)
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        @can('delete', $item)
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                Delete Item
                            </button>
                        @endcan
                    </div>

                    <div class="col-md-6">
                        <form class="text-right" action="{{ $item->_id.'/edit' }}" method="POST">
                            {{ method_field('GET') }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Edit Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="text-right" action="{{ '/item/'.$item->_id }}" method="POST">
                {{ method_field('DELETE') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Item?</h5>
                    </div>

                    <div class="modal-footer">
                        <div class="col-md-6">
                            <button type="reset" class="btn btn-secondary btn-block" data-dismiss="modal">Abort</button>
                        </div>

                        <div class="col-md-6">
                            <div class="text-right">
                                <button type="submit" class="btn btn-danger btn-block">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection