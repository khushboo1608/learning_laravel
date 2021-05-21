<!-- A Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('a_type', 'A Type:') !!}
    
</div>

<!-- A Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('a_name', 'A Name:') !!}
    {!! Form::text('a_name', null, ['class' => 'form-control']) !!}
</div>

<!-- A Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('a_number', 'A Number:') !!}
    {!! Form::text('a_number', null, ['class' => 'form-control']) !!}
</div>

<!-- A Houser No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('a_houser_no', 'A Houser No:') !!}
    {!! Form::text('a_houser_no', null, ['class' => 'form-control']) !!}
</div>

<!-- A Lendmark Field -->
<div class="form-group col-sm-6">
    {!! Form::label('a_lendmark', 'A Lendmark:') !!}
    {!! Form::text('a_lendmark', null, ['class' => 'form-control']) !!}
</div>

<!-- A Adderss Field -->
<div class="form-group col-sm-6">
    {!! Form::label('a_adderss', 'A Adderss:') !!}
    {!! Form::text('a_adderss', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', $userItems, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('addersses.index') }}" class="btn btn-secondary">Cancel</a>
</div>
