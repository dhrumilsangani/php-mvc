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
    public ?Controller $controller = null;
    public ?DBModel $user;
    public Database $db;
    public string $userClass; 
    public string $layout = 'main'; 
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
        $this->userClass = $config['userClass'];
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        $userModel = new $this->userClass;
        if($primaryValue) {
            $primaryKey = $userModel->primaryKey();
            $this->user = $userModel->findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }
    /**
     * Summary of run
     * @return void
     */
    public function run() {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->router->renderView('_error', [
                'exception' => $e
            ]);
        }
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
    
    public function login(DBModel $user) {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true; 
    }

    public function logout() {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest() {
        return !self::$app->user;
    }
} 