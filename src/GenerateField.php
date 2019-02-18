<?php

namespace Shef29\JustAdmin;

class GenerateField
{
    public static function getHtmlField($field)
    {
        if ($field->name == 'id' or $field->name == 'created_at' or $field->name == 'updated_at') return '';

        $required = ($field->required) ? ['required' => 'required'] : null;

        if (preg_match('/^(file)|(img)|(image)|(photo)|(avatar)/i', $field->name) == true) {
            return self::htmlInputFile($field->name, $required);
        }

        if (stristr($field->name, 'email') == true) {
            return self::htmlInput($field->name, 'email', $required);
        }

        if (preg_match('/^(keyword)|(descrip)|(meta_)|(keyword)/i', $field->name) == true) {
            return self::htmlInput($field->name, 'textarea', $required);
        }

        if ($field->type == 'tinyint') {
            return self::htmlCheckbox($field->name);
        }

        // todo  add date

        return self::htmlInput($field->name, 'text', $required);
    }

    private static function htmlInput($name, $type = 'text', $config)
    {
        return
            '<div class="form-group bmd-form-group {{ $errors->has("' . $name . '") ? "has-error" : ""}}">
          {!! Form::label("' . $name . '", "' . $name . ' : ", [\'class\' => \'bmd-label-floating\']) !!}
          {!! Form::' . $type . '("' . $name . '", null, [\'class\' => \'form-control\', \'required\' => \'required\']) !!}
          {!! $errors->first("' . $name . '", \'<p class="help-block">:message</p>\') !!}
          </div>';
    }

    private static function htmlInputFile($name, $config)
    {
        return
            '<div class="form-group form-file-upload form-file-multiple {{ $errors->has("' . $name . '") ? "has-error" : ""}}">
            <input type="file" name="' . $name . '" multiple="" class="inputFileHidden">
            <div class="input-group">
                <input type="text" class="form-control inputFileVisible" placeholder="Upload file">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-fab btn-round btn-primary">
                        <i class="material-icons">attach_file</i>
                    </button>
                </span>
            </div>
          </div>';
    }

    private static function htmlCheckbox($name)
    {
        return
            '<div class="form-group bmd-form-group {{ $errors->has("' . $name . '") ? "has-error" : ""}}">
          {!! Form::label("' . $name . '", "' . $name . ' : ", [\'class\' => \'bmd-label-floating\']) !!}
          {!! Form::checkbox("' . $name . '") !!}
          {!! $errors->first("' . $name . '", \'<p class="help-block">:message</p>\') !!}
          </div>';
    }
}