<div class="col-md-12">
    <div class="object-description">
        <div>{{ trans('general.description') }}</div>
        <textarea id="name" type="text" class="form-control edit-block default-edit-block" name="description"
                  autofocus>{!!trim(html_entity_decode($oObject->description))!!}</textarea>
    </div>
</div>

<div class="col-md-12">
    <div class="object-description-short">
        <div>{{ trans('general.description-short') }}</div>
        <textarea id="name" type="text" class="form-control edit-block small-edit-block"
                  name="short-description">{!!trim(html_entity_decode($oObject->shortDescription))!!}</textarea>
    </div>
</div>