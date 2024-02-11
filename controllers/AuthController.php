<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;
/**
 * Summary of AuthController
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class AuthController extends Controller
{
    /**
     * Summary of login
     * @return array|string
     */
    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }
    /**
     * Summary of register
     * @param \app\core\Request $request
     * @return array|string
     */
    public function register(Request $request)
    {
        $user = new User;
        if($request->isPost()) {
            $user->loadData($request->getBody());
            if($user->validate() && $user->save()){
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/');
                exit;
            }
            return $this->render('register', [
                'model' => $user
            ]);
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $user
        ]);
    }
}