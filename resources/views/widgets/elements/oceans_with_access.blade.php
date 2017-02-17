<select name="ocean" class="selectpicker" required>
    @if(isset($oObject))
        <option value="{{ $oObject->ocean->id }}">{{ $oObject->ocean->name }}</option>
    @endif

    @foreach(App\Models\Ocean::all() as $oOcean)
        @if(isset($oObject)) @if($oObject->ocean->id == $oOcean->id) @continue @endif @endif
        <option value="{{ $oOcean->id }}">{{ $oOcean->name }}</option>
    @endforeach
</select>