<div class="table-responsive-sm">
    <table class="table table-striped" id="countries-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Short Code</th>
                <th>Time Zone</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countries as $country)
                <tr>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->code }}</td>
                    <td>{{ $country->short_code }}</td>
                    <td>{{ $country->time_zone }}</td>
                    <td>
                        <a class="btn btn-sm btn-success" href="{{ route('countries.show', [$country->id]) }}" data-toggle="tooltip" title="{!! __('laravelusers::laravelusers.tooltips.show') !!}">
                            {!! __('laravelusers::laravelusers.buttons.show') !!}
                        </a> 
                        <a class="btn btn-sm btn-info" href="{{ route('countries.edit', [$country->id]) }}" data-toggle="tooltip" title="{!! __('laravelusers::laravelusers.tooltips.edit') !!}">
                            {!! __('laravelusers::laravelusers.buttons.edit') !!}
                        </a> 
                        {!! Form::open(array('route' => ['countries.destroy', $country->id], 'class' => '', 'style' => 'display:inline-block;', 'data-bs-toggle' => 'tooltip', 'title' => __('laravelusers::laravelusers.tooltips.delete'))) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::button(__('laravelusers::laravelusers.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-bs-toggle' => 'modal', 'data-bs-target' => '#al-danger-alert', 'data-bs-id' => $country->id, 'data-bs-title' => __('Delete Country'), 'data-bs-message' => __('laravelusers::modals.delete_user_message', ['user' => $country->name]))) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $countries->links() }}
</div>