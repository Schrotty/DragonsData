<select name="realm" class="selectpicker" required>
        @if(isset($oObject))
                <option value="{{ $oObject->realm->id }}">{{ $oObject->realm->name }}</option>
    @endif

    @foreach(App\Models\Realm::all() as $oRealm)
                @if(isset($oObject)) @if($oObject->realm->id == $oRealm->id) @continue @endif @endif
                <option value="{{ $oRealm->id }}">{{ $oRealm->name }}</option>
    @endforeach
</select>