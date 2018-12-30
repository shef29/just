<?= '<?php' ?>

namespace App\Http\Controllers{{ ($space = $crud->getNameSpace('')) ? '\\'.$space : '' }};

use App\{{ $crud->getNameSpace()}}{{$crud->model}};
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class {{$crud->createClassName($crud->controller)}} extends Controller
{
    public function index()
    {
        $records = {{$crud->model}}::findRequested();

        return view( "{{$crud->route}}.index", ['records' => $records] );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view("{{$crud->route}}.create");
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->val($request);

        {{$crud->model}}::create($request->all());

        return redirect('/{{$crud->url}}');
    }

    /**
    * Display the specified resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        return view("{{$crud->route}}.show",['model' => $this->findModel($id)]);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        return view( "{{$crud->route}}.edit", ['model' => $this->findModel($id)]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $this->val($request);

        $model = $this->findModel($id);
        $model->update($request->all());

        return redirect('/{{$crud->url}}');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $this->findModel($id)->delete();

        return redirect('/{{$crud->url}}');
    }

    protected function val($request)
    {
        $this->validate(
            $request,
            [
@foreach($fields as $field)
 @if ($rule = $crud->createRule($field))
            '{!!$field->name!!}' => '{!!$rule!!}',
 @endif
@endforeach
            ]
        );
    }

    protected function findModel($id)
    {
        return {{$crud->model}}::findOrFail($id);
    }

}
