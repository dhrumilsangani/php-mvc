<?php

namespace app\core;
/**
 * Summary of Application
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class Application{
    public static string $ROOT_DIR;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Controller $controller;
    public Database $db;
    /**
     * Summary of __construct
     * @param mixed $rootPath
     */
    public function __construct($rootPath, array $config) {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);
    }
    /**
     * Summary of run
     * @return void
     */
    public function run() {
        echo $this->router->resolve();
    }
    /**
     * Summary of getController
     * @return Controller
     */
    public function getController() {
        return $this->controller;
    } 
    /**
     * Summary of setController
     * @param \app\core\Controller $controller
     * @return void
     */
    public function setController(Controller $controller) {
        $this->controller = $controller;
    } 
} 