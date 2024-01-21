<?php

namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
/**
 * Summary of SiteController
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class SiteController extends Controller{
    /**
     * Summary of home
     * @return array|string
     */
    public function home() {
        $params = [
            'name' => 'Dhrumil Sangani',
        ];
        return $this->render('home', $params);
    } 
    /**
     * Summary of contact
     * @return array|string
     */
    public function contact() {
        return Application::$app->router->renderView('contact');
    }
    /**
     * Summary of handleContact
     * @param \app\core\Request $request
     * @return never
     */
    public function handleContact(Request $request) {
        $body = $request->getBody();
        echo '<pre>';
        var_dump($body);
        echo '</pre>'; die;
    }
}