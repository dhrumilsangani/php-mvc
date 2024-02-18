<?php

namespace app\core\form;

/**
 * Summary of TextAreaField
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class TextAreaField extends BaseField {
    public function renderInput(): string
    {
        return sprintf(
            '<textarea name="%s" class="form-control%s">%s</textarea>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->{$this->attribute},
        );
    }
}