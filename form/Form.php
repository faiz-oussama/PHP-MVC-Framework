<?php

namespace faizavel\mvc\form;
use faizavel\mvc\Model;
class Form
{
    public static function begin($action,$method)
    {
        echo sprintf('<form action="%s" method="%s">',$action,$method);
        return new Form();
    }
    public static function end()
    {
        echo '</form>';
    }
    public function field(Model $model,$attribute)
    {
        return new Field($model,$attribute);
    }
    public function button($value)
    {
        return "<button type='submit'>$value 
        </button>";
    }
}