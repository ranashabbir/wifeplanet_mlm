<div class="table-responsive plans-table">
    <table class="table table-striped table-bordered display" id="file_export">
        <thead class="thead">
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Type</th>
                <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody id="plans_table">
            @foreach($plans as $plan)
                <tr>
                    <td>{{ $plan->title }}</td>
                    <td>{{ $plan->price }}</td>
                    <td>{{ $plan->type }}</td>
                    <td>{!! $plan->description !!}</td>
                    <td>
                        {!! Form::open(['route' => ['plans.destroy', $plan->id], 'method' => 'delete']) !!}
                            <a href="{{ route('plans.show', [$plan->id]) }}" class='btn btn-sm btn-success'><i class="fa fa-eye"></i></a> 
                            <a href="{{ route('plans.edit', [$plan->id]) }}" class='btn btn-sm btn-info'><i class="fa fa-pencil-alt"></i></a> 
                            {!! Form::button('<i class="fa fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $plans->links() }}
</div>