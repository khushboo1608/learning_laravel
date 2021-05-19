<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $post->title }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $post->description }}</p>
</div>

<!-- Articles Id Field -->
<div class="form-group">
    {!! Form::label('articles_id', 'Articles Id:') !!}
    <p>{{ $post->articles_id }}</p>
</div>


<!-- Image Url Field -->
<div class="form-group">
    {!! Form::label('image_url','Image Url:')  !!}
    <!-- <p>{{ $post->image_url }} </p> -->
    @if(empty($post->image_url))

    @else
        <p><img src="{{ $post->image_url }}" width="100" />
        <input type="hidden" name="hidden_image" value="{{ $post->image_url }}" /></p>
    @endif
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $post->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $post->updated_at }}</p>
</div>

