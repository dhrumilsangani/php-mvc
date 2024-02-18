<?php

namespace app\core;
/**
 * Summary of View
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class View {
    public string $title = '';

    public function renderView($view, $params = [])
    {
        $contentView = $this->renderContentView($view, $params);
        $layoutView = $this->renderLayoutView();
        return str_replace('{{content}}', $contentView, $layoutView);
    }

    protected function renderLayoutView()
    {
        $layout = Application::$app->layout;
        if(Application::$app->controller) {
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderContentView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}