@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h2>
                        <span>{{ $item->getValue('name') }}</span>
                        <small class="text-muted"> - {{ $item->category->getValue('name', 'Unknown') }}</small>
                    </h2>

                    <div class="row">
                        <div class="col item-content">

                            <!-- DATA PANEL -->
                            <div class="float-right container-data-wrapper">
                                <table class="table table-bordered table-responsive">
                                    <tbody>

                                    <!-- USER INFO -->
                                    <tr>
                                        <th colspan="2">User info</th>
                                    </tr>

                                    <tr>
                                        <td>Author</td>
                                        <td>
                                            <span>{{ \App\User::byId($item->author)->username }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Known</td>
                                        <td>
                                            @if($item->hasUserWithReadAccess())
                                                @foreach($item->userWithReadAccess as $user)
                                                    <span>{{ $user->getValue('username') }}</span><br>
                                                @endforeach
                                            @else None @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Contributors</td>
                                        <td>
                                            @if($item->hasUserWithWriteAccess())
                                                @foreach($item->userWithWriteAccess as $user)
                                                    <span>{{ $user->getValue('username') }}</span><br>
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
                                            @if($item->hasParties())
                                                @foreach($item->parties as $party)
                                                    <a href="{{ '/party/'.$party->id }}">{{ $party->name }}<br></a>
                                                @endforeach
                                            @else None @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>References</td>
                                        <td>
                                            @if($item->hasReferences())
                                                @foreach($item->references as $reference)
                                                    <a href="{{ '/item/'.$reference->id }}">{{ $reference->getValue('name') }}<br></a>
                                                @endforeach
                                            @else None @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Tags</td>
                                        <td>
                                            @if($item->hasTags())
                                                @foreach($item->tags as $tag)
                                                    <span class="label label-primary">{{ $tag->getValue('name') }}</span><br>
                                                @endforeach
                                            @else None @endif
                                        </td>
                                    </tr>

                                    <!-- PROPERTIES -->
                                    @if($item->hasProperties())
                                        <tr><th colspan="2">Properties</th></tr>

                                        @foreach($item->properties as $property)
                                            <tr>
                                                <td>{{ $property->name }}</td>
                                                <td>{{ $property->pivot->value }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- CONTENT -->
                            <div class="container-data-content">
                                {!! $item->toMarkdown('description', 'No Description found') !!}
                            </div>
                        </div>
                    </div>
                </div>

                @can('edit', $item)
                    <div class="card-footer text-right">
                        <a href="{{ '/item/' . $item->id . '/edit' }}">
                            <button type="submit" class="btn btn-primary">Edit Item</button>
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
@endsection