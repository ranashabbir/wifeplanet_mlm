<!-- Country Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Country Name:') !!}
    <p>{{ $country->name }}</p>
</div>

<!-- Country Code Field -->
<div class="form-group">
    {!! Form::label('code', 'Country Code:') !!}
    <p>{{ $country->code }}</p>
</div>

<!-- Country Short Code Field -->
<div class="form-group">
    {!! Form::label('short_code', 'Short Form:') !!}
    <p>{{ $country->short_code }}</p>
</div>

<!-- Country Time Zone Field -->
<div class="form-group">
    {!! Form::label('time_zone', 'Time Zone:') !!}
    <p>{{ $country->time_zone }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $country->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $country->updated_at }}</p>
</div>

