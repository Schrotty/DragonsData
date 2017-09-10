@extends('layout.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-12">
                    <h2>
                        {{ $item->name }}
                        <small class="text-muted"> - {{ \App\Category::byId($item->category)->getValue('name', 'Unknown') }}</small>
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    <!-- DATA PANEL -->
                    <div class="float-right container-data-wrapper">
                        <table class="table table-bordered">
                            <tbody>

                            <!-- USER INFO -->
                                <tr>
                                    <th colspan="2">User info</th>
                                </tr>

                                <tr>
                                    <td>Author</td>
                                    <td>
                                        <span>{{ \App\User::byId($item->author)->getValue('username') }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Known</td>
                                    <td>
                                        @if($item->hasValues('known'))
                                            @foreach($item->known as $id)
                                                <span>{{ \App\User::byId($id)->username }}</span><br>
                                            @endforeach
                                        @else None @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>Contributors</td>
                                    <td>
                                        @if($item->hasValues('contributors'))
                                            @foreach($item->contributors as $id)
                                                <span>{{ \App\User::byId($id)->username }}</span><br>
                                            @endforeach
                                        @else None @endif
                                    </td>
                                </tr>

                                <!-- CONTAINER DATA -->
                                <tr>
                                    <th colspan="2">Container Data</th>
                                </tr>

                                <tr>
                                    <td>Parties</td>
                                    <td>
                                        @if($item->hasValues('party'))
                                            @foreach($item->party as $id)
                                                <a href="{{ '/party/'.$id }}">{{ \App\Party::byId($id)->name }}<br></a>
                                            @endforeach
                                        @else None @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>References</td>
                                    <td>
                                        @if($item->hasValues('parents'))
                                            @foreach($item->parents as $id)
                                                <a href="{{ '/item/'.$id }}">{{ \App\Item::byId($id)->name }}<br></a>
                                            @endforeach
                                        @else None @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>Tags</td>
                                    <td>
                                        @if($item->hasValues('tags'))
                                            @foreach($item->tags as $id)
                                                @if(\App\Tag::exist($id))
                                                    <span class="label label-{{ \App\Tag::byId($id)->style }}">{{ \App\Tag::byId($id)->name }}</span><br>
                                                @endif
                                            @endforeach
                                        @else None @endif
                                    </td>
                                </tr>

                                <!-- PROPERTIES -->
                                @if($item->hasValues('properties'))
                                    <tr><th colspan="2">Properties</th></tr>

                                    @foreach($item->properties as $id => $value)
                                        @if(\App\Property::exist($id))
                                            <tr>
                                                <td>{{ \App\Property::byId($id)->getValue('name') }}</td>
                                                <td>{{ $value }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- CONTENT -->
                    <div class="container-data-content">
                        {!! $item->description !!}
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