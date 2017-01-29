<select name="known-by[]" class="selectpicker" multiple>
    {{ $users = $realm->knownBy }}
    @foreach(App\User::all() as $oUser)
        @if($users->find($oUser->id) == null)
            <option>{{ $oUser->name }}</option>
        @else
            <option selected>{{ $oUser->name }}</option>
        @endif
    @endforeach
</select>