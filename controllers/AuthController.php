<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
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
        if($request->isPost()) {
            return 'Handling register data..';
        }
        $this->setLayout('auth');
        return $this->render('register');
    }
}