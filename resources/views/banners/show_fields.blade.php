<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $banner->title }}</p>
</div>

<!-- Image Url Field -->
<div class="form-group">
    {!! Form::label('image_url','Image Url:')  !!}
    @if(empty($banner->image_url))

    @else
        <p><img src="{{ $banner->image_url }}" width="100" />
        <input type="hidden" name="hidden_image" value="{{ $banner->image_url }}" />
        </p>
    @endif
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $banner->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $banner->updated_at }}</p>
</div>

