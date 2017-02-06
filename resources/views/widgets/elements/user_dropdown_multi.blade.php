<select name="known-by[]" class="selectpicker" multiple>
    {{ $users = $obj->knownBy }}
    @foreach(App\Models\User::all() as $oUser)
        @if($users->find($oUser->id) == null)
            <option value="{{ $oUser->id }}">{{ $oUser->name }}</option>
        @else
            <option value="{{ $oUser->id }}" selected>{{ $oUser->name }}</option>
        @endif
    @endforeach
</select>