<?php
/**
 * Created by PhpStorm.
 * User: Valter
 * Date: 30.12.2018
 * Time: 17:59
 */

namespace Shef29\JustAdmin;

use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    public $table;
    public $model;
    public $controller;
    public $viewPath;
    public $route;
    public $as = '';
    public $namespace = '';
    public $url = '';

    protected $fillable = ['*'];

    public function generateAll()
    {
        $this->setViewPath();
        $this->setNameSpace();
        $this->setRoute();
        $this->setUrl();
        $this->setAs();

        $this->model = $this->createClassName($this->model);
        if (stristr($this->controller, 'controller') === FALSE) {
            $this->controller .= 'Controller';
        }

        $this->generateModel();
        $this->generateController();
        $this->generateViews();

        $this->generateWebRoute();
        $this->generateMenuItem();
    }

    public function setViewPath()
    {
        $this->viewPath = strtolower(preg_replace("/(?!^)([A-Z])/", '-$1', $this->viewPath));
    }

    public function getNameSpace($tr = '\\')
    {
        if (!empty($this->namespace)) {
            return $this->namespace . $tr;
        }
        return '';
    }

    public function setAs()
    {
        if ($pos = strpos($this->route, ".")) {
            $this->as = substr($this->route, 0, $pos);
        }
    }

    public function setUrl()
    {
        $this->url = str_replace('.', '/', $this->route);
    }

    public function generateModel()
    {
        if (!empty($this->namespace) and !file_exists(app_path($this->namespace))) {
            mkdir(app_path($this->namespace));
        }
        $modelFile = app_path($this->namespace) . '/' . $this->model . ".php";
        $content = view('admin.crud.templates.model', [
            'crud' => $this,
            //'fields' => Db::fields($this->tableName)
        ]);

        file_put_contents($modelFile, $content);
    }

    public function generateController()
    {
        $controllerFile = $this->controllersDir() . '/' . $this->controller . ".php";

//        $content = view($this->templatesDir('controller'), ['crud' => $this]);
        $content = view('admin.crud.templates.controller',
            ['crud' => $this, 'fields' => DataBase::fields($this->table)]);
        file_put_contents($controllerFile, $content);
    }

    public function generateViews()
    {
        if (!file_exists($this->viewsDir())) mkdir($this->viewsDir());
        $views = config('crud.views');
        if (empty($views)) return false;

        $fields = DataBase::fields($this->table);

        foreach ($views as $view) {
            $viewFile = $this->viewsDir() . "/" . $view . ".blade.php";

            $content = view('admin.crud.views.' . $view, [
                'crud' => $this,
                'fields' => $fields
            ]);

            file_put_contents($viewFile, $content);
        }
    }

    public function generateWebRoute()
    {
        $routeFile = app_path('Http/routes.php');
        if (\App::VERSION() >= '5.3') {
            $routeFile = base_path('routes/web.php');
        }
        $routes = <<<EOD
Route::resource('/$this->url', '$this->controller', ['as'=> '$this->as']);

EOD;
        \File::append($routeFile, "\n" . $routes);
    }

    public function generateMenuItem()
    {
        $menu = base_path('resources/views/admin/layouts/menu.blade.php');

        if (!file_exists($menu)) return false;

        $li = '
<li class="nav-item">
    <a class="nav-link" href="{{ route(\'' . $this->route . '.index\')}}">
        <i class="material-icons">' . $this->model . '</i>
        <p>' . $this->model . '</p>
    </a>
</li>';

        \Illuminate\Support\Facades\File::append($menu, "\n" . $li);
    }

    public function setRoute()
    {
        $this->route = strtolower(str_replace("\\", ".", $this->viewPath));
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function createClassName($class)
    {
        return ucfirst(class_basename(camel_case(str_singular($class))));
    }

    private function controllersDir()
    {
        return app_path('Http/Controllers');
    }

    private function modelsDir()
    {
        return app_path();
    }


    private function templatesDir($view)
    {
        return 'admin.crud.templates.' . $view;
    }

    public function viewsDir()
    {
        return base_path('resources/views/' . $this->viewPath);
    }

    public function viewsDirName()
    {
        return str_singular($this->table);
    }

    public function modelVariableName()
    {
        return camel_case(str_singular($this->table));
    }

    public function titleSingular()
    {
        return ucwords(str_singular(str_replace("_", " ", $this->table)));
    }

    public function titlePlural()
    {
        return ucwords(str_replace("_", " ", $this->table));
    }

    public function createRule($field)
    {
        $rule = '';
        if ($field->name == 'id' or $field->name == 'created_at' or $field->name == 'updated_at') return false;
        if ($field->required) $rule = 'required|';

        if (preg_match('/^(img)|(image)|(photo)|(avatar)/i', $field->name) == true) {
            return $rule = $rule . 'mimes:jpeg,jpg,png';
        }
        if ($field->name == 'email') $rule .= 'email|';

        if (preg_match('/^(varchar)|(text)|(longtext)/i', $field->type)) $rule .= 'string|';
        if (preg_match('/^(integer)|(tinyint)|(longtext)/i', $field->type)) $rule .= 'integer|';
        if ($field->maxLength > 0) $rule .= 'max:' . $field->maxLength;

        return $rule;
    }

    public function setNameSpace()
    {
        if (preg_match('|^([a-z]*)\\\|i', $this->controller, $result)) {
            # example : Admin\Controllers
            $this->namespace = $result[1];
        }
    }

}