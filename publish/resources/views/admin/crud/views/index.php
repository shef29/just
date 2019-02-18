@extends('admin.backend')

@section('content')

    <div class="card-header card-header-success"><?= $crud->titlePlural() ?></div>
    <div class="card-body">
        <p>
            <a href="{{url('<?= $crud->url ?>/create')}}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i>
                Добавить
            </a>
        </p>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
        <?php foreach ($fields as $field) : ?>
                    <th><a href=""><?= $field->name ?></a></th>
        <?php endforeach; ?>
                        <th>#</th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form"></form>
                    </tr>
                </thead>
                <tbody>
                @forelse ( $records as $record )
                <tr>
            <?php foreach ($fields as $field) : ?>
                <td>{{$record['<?= $field->name ?>']}}</td>
            <?php endforeach; ?>
                    <td class="actions-cell">

                        <a href="{{route('<?= $crud->route ?>.show', ['id' => $record['id']])}}">
                            <button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
                        </a>

                        <a href="{{route('<?= $crud->route ?>.edit', ['id'=> $record['id']])}}">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                        </a>

                        {!! Form::open(['method' => 'DELETE', 'url' => route('<?= $crud->route ?>.destroy', ['id' =>
                        $record['id']]),
                        'style' => 'display:inline']) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>',
                        ['title' => 'Delete', 'onclick'=>'return confirm("Уверены ?")',
                        'class' => 'btn btn-danger btn-sm', 'type'=>'']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @empty
                empty
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination">
            @if(count($records))
            {!! $records->appends(Request::query())->render() !!}
            @endif
        </div>
    </div>
@endsection