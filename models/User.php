<?php

namespace app\models;

use app\core\DBModel;
use app\core\UserModel;

/**
 * Summary of User
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class User extends UserModel {
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 2;
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $password = '';
    public int $status = self::STATUS_INACTIVE;
    public string $confirmPassword = '';

    public function tableName(): string
    {
        return 'users';
    }
    
    public function attributes(): array
    {
        return ['first_name', 'last_name', 'email', 'password', 'status'];
    }

    public function labels(): array
    {
        return [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password',
        ];
    }

    
    public function primaryKey(): string
    {
        return 'id';
    }

    public function getDisplayName(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function save() {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    } 

    public function rules() : array 
    {
        return [
            'first_name'         => [self::RULE_REQUIRED],
            'last_name'          => [self::RULE_REQUIRED],
            'email'             => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password'          => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 12]],
            'confirmPassword'   => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }
}