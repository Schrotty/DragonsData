<select name="landscape" class="selectpicker">

    @if(isset($iLandscapeID))
        <option value="{{ $iLandscapeID }}">{{ \App\Models\Landscape::find($iLandscapeID)->name }}</option>
    @else
        <option value="{{ $landscape->id }}">{{ $landscape->name }}</option>
    @endif
    @foreach(App\Models\Landscape::all() as $oLandscape)
        @if($landscape->id != $oLandscape->id)
            <option value="{{ $oLandscape->id }}">{{ $oLandscape->name }}</option>
        @endif
    @endforeach
</select>