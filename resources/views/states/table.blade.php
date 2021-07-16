<div class="table-responsive-sm">
    <table class="table table-striped" id="states-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Short Code</th>
                <th>state</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($states as $state)
                <tr>
                    <td>{{ $state->name }}</td>
                    <td>{{ $state->short_code }}</td>
                    <td>{{ $state->country->name }}</td>
                    <td>
                        <a class="btn btn-sm btn-success" href="{{ route('states.show', [$state->id]) }}" data-toggle="tooltip" title="{!! __('laravelusers::laravelusers.tooltips.show') !!}">
                            {!! __('laravelusers::laravelusers.buttons.show') !!}
                        </a> 
                        <a class="btn btn-sm btn-info" href="{{ route('states.edit', [$state->id]) }}" data-toggle="tooltip" title="{!! __('laravelusers::laravelusers.tooltips.edit') !!}">
                            {!! __('laravelusers::laravelusers.buttons.edit') !!}
                        </a> 
                        {!! Form::open(array('route' => ['states.destroy', $state->id], 'class' => '', 'style' => 'display:inline-block;', 'data-bs-toggle' => 'tooltip', 'title' => __('laravelusers::laravelusers.tooltips.delete'))) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::button(__('laravelusers::laravelusers.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-bs-toggle' => 'modal', 'data-bs-target' => '#al-danger-alert', 'data-bs-id' => $state->id, 'data-bs-title' => __('Delete State'), 'data-bs-message' => __('laravelusers::modals.delete_user_message', ['user' => $state->name]))) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>