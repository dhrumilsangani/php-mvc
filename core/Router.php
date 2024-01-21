<?php

namespace app\core;
/**
 * Summary of Router
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;
    /**
     * Summary of __construct
     * @param \app\core\Request $request
     * @param \app\core\Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    /**
     * Summary of get
     * @param mixed $path
     * @param mixed $callback
     * @return void
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    /**
     * Summary of post
     * @param mixed $path
     * @param mixed $callback
     * @return void
     */
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }
    /**
     * Summary of resolve
     * @return mixed
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback == false) {
            Application::$app->response->setStatusCode(404);
            return $this->renderView("404");
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if(is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }
        return call_user_func($callback, $this->request);
    }
    /**
     * Summary of renderView
     * @param mixed $view
     * @param mixed $params
     * @return array|string
     */
    public function renderView($view, $params = [])
    {
        $layoutView = $this->renderLayoutView();
        $contentView = $this->renderContentView($view, $params);
        return str_replace('{{content}}', $contentView, $layoutView);
    }
    /**
     * Summary of renderLayoutView
     * @return bool|string
     */
    protected function renderLayoutView()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }
    /**
     * Summary of renderContentView
     * @param mixed $view
     * @param mixed $params
     * @return bool|string
     */
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