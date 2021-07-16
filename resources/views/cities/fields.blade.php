<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 120]) !!}
</div>

<!-- Country Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('country_id', 'Country Id:') !!}
    {!! Form::select('country_id', $countries, null, ['id' => 'country_id', 'class' => 'form-control select2']) !!}
</div>

<!-- State Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('state_id', 'State Id:') !!}
    {!! Form::select('state_id', [], null, ['id' => 'state_id', 'class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('cities.index') }}" class="btn btn-secondary">Cancel</a>
</div>
