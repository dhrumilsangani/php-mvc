<?php

namespace app\core;
use app\core\Application;
use app\core\middlewares\BaseMiddleware;
/**
 * Summary of Controller
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class Controller {
    public string $layout = 'main';
    public string $action = '';
    /**
     * Summary of middleware
     * @var \app\core\middlewares\BaseMiddleware[]
     */
    protected array $middleware = [];
    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function render($view, $params = []) {
        return Application::$app->router->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware) {
        $this->middleware[] = $middleware;
    }

    public function getMiddleware(): array
    {
        return $this->middleware;
    }
}