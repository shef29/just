@extends('admin.backend')

@section('content')
<div class="card-header card-header-success">
    <h4 class="card-title"> Create : <?= $crud->titlePlural() ?></h4>
</div>
<div class="card-body">
    @if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    <form action="{{route('<?= $crud->route ?>.store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <?php foreach ($fields as $field) : ?>
            <?= \Shef29\JustAdmin\GenerateField::getHtmlField($field); ?>
        <?php endforeach; ?>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

@endsection