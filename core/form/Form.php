<?php

namespace app\core\form;
use app\core\Model;

/**
 * Summary of Form
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class Form {
    public static function begin($action ,$method) {
        echo sprintf('<form action="%s", method="%s">', $action, $method);
        return new Form(); 
    }

    public static function end() {
        echo '</form>';
    }
    public static function field(Model $model ,$method) {
        return new InputField($model, $method);
    }
}