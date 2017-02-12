<select name="tags[]" class="selectpicker" multiple>
    @foreach(App\Models\Tag::all() as $oTag)
        @if(get_class($obj) == $oTag->usedModel || $oTag->usedModel == null)
            @if($obj->tags->find($oTag->id) == null)
                <option value="{{ $oTag->id }}">{{ $oTag->name }}</option>
            @else
                <option selected value="{{ $oTag->id }}">{{ $oTag->name }}</option>
            @endif
        @endif
    @endforeach
</select>