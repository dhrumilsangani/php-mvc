<?php

namespace app\core;
use app\core\Application;
/**
 * Summary of Controller
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class Controller {
    public string $layout = 'main';
    /**
     * Summary of setLayout
     * @param mixed $layout
     * @return void
     */
    public function setLayout($layout) {
        $this->layout = $layout;
    }
    /**
     * Summary of render
     * @param mixed $view
     * @param mixed $params
     * @return array|string
     */
    public function render($view, $params = []) {
        return Application::$app->router->renderView($view, $params);
    }
}