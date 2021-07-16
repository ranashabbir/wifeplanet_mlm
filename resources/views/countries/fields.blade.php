<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 120]) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control','maxlength' => 60]) !!}
</div>

<!-- Short Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('short_code', 'Short Code:') !!}
    {!! Form::text('short_code', null, ['class' => 'form-control','maxlength' => 30]) !!}
</div>

<!-- Time Zone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time_zone', 'Time Zone:') !!}
    {!! Form::text('time_zone', null, ['class' => 'form-control','maxlength' => 30]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('countries.index') }}" class="btn btn-secondary">Cancel</a>
</div>
