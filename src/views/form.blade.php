@extends('admin.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">CRUD Generator Test</div>
                    <div class="card-body">
                        <a href="{{ url('/admin') }}" title="Back">
                            <button class="btn btn-warning btn-sm">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Admin
                            </button>
                        </a>
                        <br/>
                        <br/>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! Form::open(['method' => 'POST', 'url' => '/admin/crud', 'class' => 'form-horizontal'])  !!}
                        @csrf
                        <div class="form-group{{ $errors->has('table') ? ' has-error' : ''}}">
                            {!! Form::label('table', 'Table : ', ['class' => 'control-label']) !!}
                            {!! Form::text('table', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('table', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="form-group{{ $errors->has('model') ? ' has-error' : ''}}">
                            {!! Form::label('Model', 'Model: ', ['class' => 'control-label']) !!}
                            {!! Form::text('model', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('model', '<p class="help-block">:message</p>') !!}
                            <div class="hint-block">This <code>app\models\Post</code>.</div>
                        </div>
                        <div class="form-group{{ $errors->has('controller') ? ' has-error' : ''}}">
                            {!! Form::label('controller', 'controller Class: ', ['class' => 'control-label']) !!}
                            {!! Form::text('controller', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('controller', '<p class="help-block">:message</p>') !!}
                            <div class="hint-block">example : <code>admin\Post[Controller]</code>.</div>
                        </div>
                        <div class="form-group{{ $errors->has('viewPath') ? ' has-error' : ''}}">
                            {!! Form::label('viewPath', 'viewPath: ', ['class' => 'control-label']) !!}
                            {!! Form::text('viewPath', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('viewPath', '<p class="help-block">:message</p>') !!}
                            <div class="hint-block">example : <code>admin\post</code>.</div>
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <h3>Tables</h3>
                <ul>
                    @forelse($tables as $table)
                        <li>{{ head($table) }}</li>
                    @empty
                        <p>List empty</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection