<div class="table-responsive-sm">
    <table class="table table-striped" id="cities-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>State</th>
                <th>Country</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cities as $city)
                <tr>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->state->name }}</td>
                    <td>{{ $city->state->country->name }}</td>
                    <td>
                        <a class="btn btn-sm btn-success" href="{{ route('cities.show', [$city->id]) }}" data-toggle="tooltip" title="{!! __('laravelusers::laravelusers.tooltips.show') !!}">
                            {!! __('laravelusers::laravelusers.buttons.show') !!}
                        </a> 
                        <a class="btn btn-sm btn-info" href="{{ route('cities.edit', [$city->id]) }}" data-toggle="tooltip" title="{!! __('laravelusers::laravelusers.tooltips.edit') !!}">
                            {!! __('laravelusers::laravelusers.buttons.edit') !!}
                        </a> 
                        {!! Form::open(array('route' => ['cities.destroy', $city->id], 'class' => '', 'style' => 'display:inline-block;', 'data-bs-toggle' => 'tooltip', 'title' => __('laravelusers::laravelusers.tooltips.delete'))) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::button(__('laravelusers::laravelusers.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-bs-toggle' => 'modal', 'data-bs-target' => '#al-danger-alert', 'data-bs-id' => $city->id, 'data-bs-title' => __('Delete City'), 'data-bs-message' => __('laravelusers::modals.delete_user_message', ['user' => $city->name]))) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>