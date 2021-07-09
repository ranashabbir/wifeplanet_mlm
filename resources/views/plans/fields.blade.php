<!-- Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 25]) !!}
</div>

<div class="form-group col-sm-12 col-lg-12">
    <div class="row">
        <!-- Price Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('price', 'Price:') !!}
            {!! Form::number('price', null, ['class' => 'form-control']) !!}
        </div>
        
        <!-- Image Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('image', 'Image:') !!}
            {!! Form::file('image', ['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group col-sm-4">
            <label class="d-block">Type:</label>
            <div class="form-check form-check-inline">
                {!! Form::radio('type', 'monthly', true, array('id' => 'monthly', 'class' => 'form-check-input')); !!}
                {!! Form::label('monthly', 'Monthly', array('class' => 'form-check-label')) !!}
            </div>
            <div class="form-check form-check-inline">
                {!! Form::radio('type', 'quarterly', true, array('id' => 'quarterly', 'class' => 'form-check-input')); !!}
                {!! Form::label('quarterly', 'Quarterly', array('class' => 'form-check-label')) !!}
            </div>
            <div class="form-check form-check-inline">
                {!! Form::radio('type', 'halfyearly', true, array('id' => 'halfyearly', 'class' => 'form-check-input')); !!}
                {!! Form::label('halfyearly', 'Half Yearly', array('class' => 'form-check-label')) !!}
            </div>
            <div class="form-check form-check-inline">
                {!! Form::radio('type', 'yearly', true, array('id' => 'yearly', 'class' => 'form-check-input')); !!}
                {!! Form::label('yearly', 'Yearly', array('class' => 'form-check-label')) !!}
            </div>
        </div>
    </div>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('plans.index') }}" class="btn btn-secondary">Cancel</a>
</div>
