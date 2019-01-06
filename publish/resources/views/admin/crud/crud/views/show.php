@extends('admin.backend')

@section('content')

<div class="card-header card-header-success"><?= $crud->titleSingular() ?> : {{$model-><?= array_values($fields)[1]->name ?>}}</div>
<div class="card-body">
    <!--actions-->
    <p>
        <a href="{{url('<?= $crud->url ?>')}}" title="Back">
            <button class="btn btn-warning btn-sm">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
            </button>
        </a>
    </p>

    <a href="{{url('<?= $crud->url ?>/'.$model->id.'/edit')}}" class="btn btn-success">Edit</a>
    {!! Form::open(['method' => 'DELETE', 'url' => ['<?= $crud->url ?>', $model->id], 'style' => 'display:inline']) !!}

    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete',[
    'type' => 'submit',
    'class' => 'btn btn-danger btn-sm',
    'title' => 'Delete User',
    'onclick'=>'return confirm("Confirm Delete?")'])
    !!}
    {!! Form::close() !!}


    <div class="card">
        <div class="card-block">
            <table id="w0" class="table table-striped table-bordered detail-view">
                <tbody>
                <?php foreach ($fields as $field)  : ?>
                    <tr>
                        <th><?= ucwords(str_replace('_', ' ', $field->name)) ?></th>
                        <td>{{$model-><?= $field->name ?>}}</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection