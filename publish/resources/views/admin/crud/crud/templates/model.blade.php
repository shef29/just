<?='<?php'?>


namespace App{{ ($crud->namespace) ? '\\'.$crud->namespace : '' }};

use Illuminate\Database\Eloquent\Model;

class <?=$crud->model ?> extends Model
{
    public $table = '<?=$crud->table ?>';

    public $guarded = ["id", "url", "created_at", "updated_at"];

    public static function findRequested($with = null)
    {
        $query = self::query();

        if ($with != null) {
            $query->with($with);
        }
        // search results based on user input
        {{--@foreach ( $fields as $field )--}}
        {{--\Request::input('{{$field->name}}') and $query->where({!! \Nvd\Crud\Db::getConditionStr($field) !!});--}}
        {{--@endforeach--}}
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(25);
    }

}
