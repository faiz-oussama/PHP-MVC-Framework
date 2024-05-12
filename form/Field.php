<?php

namespace app\core\form;

use app\core\Model;
class Field
{
    public Model $model;
    public string $attribute;
    public string $type;
    const TYPE_TEXT = 'text';
    const TYPE_PASSWORD = 'password';

    public function __construct(Model $model,string $attribute){
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }
    public function __toString()
    {
        return sprintf('
        <div class="mb-3">
            <label class="form-label">%s</label>
            <input type="%s" name = "%s" value = "%s" class="form-control %s"  >
            <div class="invalid-feedback">
                %s
            </div>
        </div>',
        $this->model->getLabel($this->attribute),
        $this->type,
        $this->attribute,
        $this->model->{$this->attribute},
        $this->model->hasError($this->attribute) ? 'is-invalid' : '',
        $this->model->getFirstError($this->attribute)
    );
    }
    public function passwordField(){
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}   