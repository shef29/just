<?php

namespace Shef29\JustAdmin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Shef29\JustAdmin\Crud;

class CrudController extends Controller
{

    public function index()
    {
        $tables = DB::select('SHOW tables');

        return view('just::form', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'table' => 'required|string', // from database
                'model' => 'required|string',
                'controller' => 'required|string|max:255',
                'viewPath' => 'required|string',
//                'viewPath' => 'required|string|regex:/[a-z]$/i',
            ]
        );
        $crud = new Crud();

        $crud->table = $request->input('table');
        $crud->model = $request->input('model');
        $crud->controller = $request->input('controller');
        $crud->viewPath = $request->input('viewPath');

        $crud->generateAll();

        return redirect('/admin/crud')->with('flash_message', 'User added!');
    }

}