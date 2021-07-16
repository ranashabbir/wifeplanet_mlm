<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'State Name:') !!}
    <p>{{ $state->name }}</p>
</div>

<!-- Short Code Field -->
<div class="form-group">
    {!! Form::label('short_code', 'Short Code:') !!}
    <p>{{ $state->short_code }}</p>
</div>

<!-- Country Id Field -->
<div class="form-group">
    {!! Form::label('country_id', 'Country Id:') !!}
    <p>{{ $state->country_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $state->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $state->updated_at }}</p>
</div>

