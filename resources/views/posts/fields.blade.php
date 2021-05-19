<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', "id" => "editor"]) !!}
</div>

<!-- Articles Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('articles_id', 'Articles Id:') !!}
    {!! Form::select('articles_id', $articleItems, null, ['class' => 'form-control']) !!}
</div>

<!-- Image Url Field -->
<div class="form-group col-sm-6">
	{!! Form::label('image_url','Image Url:')  !!}
	{!! Form::file('image_url',null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
</div>
