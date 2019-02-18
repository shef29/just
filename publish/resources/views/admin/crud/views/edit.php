@extends('admin.backend')

@section('content')

<div class="card-header card-header-success">
    <h4 class="card-title"> Update : <?= $crud->titlePlural() ?></h4>
</div>
<div class="card-body">
    @if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    {!! Form::model($model, [
        'method' => 'PATCH',  'class' => 'form-horizontal',
        'route' => ['<?= $crud->route ?>.update', $model->id],
        'enctype' => 'multipart/form-data',
    ]) !!}
    <?php foreach ($fields as $field) : ?>
        <?= \Shef29\JustAdmin\GenerateField::getHtmlField($field); ?>
    <?php endforeach; ?>

    <button type="submit" class="btn btn-primary">Update</button>

    {!! Form::close() !!}
</div>

@endsection