<div class="col-md-6">
    <div class="input-group">
        <div class="input-group-btn">
            <select name="key[]" class="selectpicker" multiple data-max-options="1" data-live-search="true">
                @foreach(\App\Category::all() as $category)
                    <optgroup label="{{ $category->name }}">
                        @foreach(\App\Property::all()->where('category', $category->_id) as $property)
                            <option value="{{ $property->_id }}">{{ $property->name }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>

        <input placeholder="Value" name="value[]" type="text" class="form-control" aria-label="Text input with dropdown button">
    </div>
</div>