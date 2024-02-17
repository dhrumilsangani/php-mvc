<?php

namespace app\core\middlewares;
use app\core\Application;
use app\core\exceptions\ForbiddenException;

/**
 * Summary of BaseMiddleware
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class AuthMiddleware extends BaseMiddleware {
    public array $actions = [];
    
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute() {
        if(Application::isGuest()) {
            if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}