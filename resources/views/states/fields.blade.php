<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'State Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 120]) !!}
</div>

<!-- Short Code Field -->
<div class="form-group col-sm-12">
    {!! Form::label('short_code', 'Short Code:') !!}
    {!! Form::text('short_code', null, ['class' => 'form-control','maxlength' => 16]) !!}
</div>

<!-- Country Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('country_id', 'Country Id:') !!}
    {!! Form::select('country_id', $countries, null, ['id' => 'country_id', 'class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('states.index') }}" class="btn btn-secondary">Cancel</a>
</div>
