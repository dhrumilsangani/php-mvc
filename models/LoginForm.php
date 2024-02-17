<?php 

namespace app\models;
use app\core\Application;
use app\core\Model;

/**
 * Summary of LoginForm
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class LoginForm extends Model {
    public string $email = ''; 
    public string $password = ''; 

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Your Email',
            'password' => 'Your Password',
        ];
    } 

    public function login() {
        $userModel = new Application::$app->userClass;
        // echo '<pre>';
        // print_r($userModel->findOne(['email' => $this->email]));
        // echo '</pre>'; die;
        $user = $userModel->findOne(['email' => $this->email]);
        if(!$user) {
            $this->addError('email', 'User does not exists with this email');
            return false;
        }
        if(!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }
        return Application::$app->login($user);
    } 
}