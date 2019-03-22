<div class="profile-img-wrap">
    <img class="inline-block"
         src="{{ (isset($img) && !is_null($img)) ? asset('storage/' . $img) : asset('img/user.jpg') }}" title="user"
         alt="user">
    <div class="fileupload btn btn-default">
        <span class="btn-text">{{ __('validation.attributes.edit') }}</span>
        <input class="upload input-file" name="{{ $name }}" type="file">
    </div>
</div>