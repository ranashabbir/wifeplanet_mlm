<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Country Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'United States of America', 'maxlength' => 120]) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-12">
    {!! Form::label('code', 'Country Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => '1', 'maxlength' => 60]) !!}
</div>

<!-- Short Code Field -->
<div class="form-group col-sm-12">
    {!! Form::label('short_code', 'Short Form:') !!}
    {!! Form::text('short_code', null, ['class' => 'form-control', 'placeholder' => 'US', 'maxlength' => 30]) !!}
</div>

<!-- Time Zone Field -->
<div class="form-group col-sm-12">
    {!! Form::label('time_zone', 'Time Zone:') !!}
    {!! Form::text('time_zone', null, ['class' => 'form-control', 'placeholder' => 'UTC -4', 'maxlength' => 30]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('countries.index') }}" class="btn btn-secondary">Cancel</a>
</div>
