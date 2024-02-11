<?php

namespace app\core;

/**
 * Summary of Model
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
abstract class Model {
    public const RULE_REQUIRED  = 'required';
    public const RULE_EMAIL     = 'email';
    public const RULE_MIN       = 'min';
    public const RULE_MAX       = 'max';
    public const RULE_MATCH     = 'match';
    public const RULE_UNIQUE     = 'unique';

    public function loadData($data) {
        foreach($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules() : array;

    public function labels(): array
    {
        return [];
    }

    public function getLabels($attribute) {
        return $this->labels()[$attribute] ?? $attribute;
    }

    public array $errors = [];

    public function validate() {
        foreach($this->rules() as $attributes => $rules) {
            $value = $this->{$attributes};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if(!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attributes, self::RULE_REQUIRED);
                }
                if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attributes, self::RULE_EMAIL);
                }
                if($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attributes, self::RULE_MIN, $rule);
                }
                if($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attributes, self::RULE_MAX, $rule);
                }
                if($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $rule['match'] = $this->getLabels($rule['match']);
                    $this->addError($attributes, self::RULE_MATCH, $rule);
                }
                if($ruleName === self::RULE_UNIQUE ) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attributes;
                    $tableName = $className::tableName();
                    $stmt = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :attr");
                    $stmt->bindValue(":attr", $value);
                    $stmt->execute();
                    $record = $stmt->fetchObject();
                    if($record) {
                        $this->addError($attributes, self::RULE_UNIQUE, ['field' => $this->getLabels($attributes)]);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function addError(string $attributes, string $rule, $params = []) {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attributes][] = $message;
    }

    public function errorMessages() {
        return [
            self::RULE_REQUIRED     => 'This field is required',
            self::RULE_EMAIL        => 'This field must be valid email address',
            self::RULE_MIN          => 'Min length of this field must be {min}',
            self::RULE_MAX          => 'Max length of this field must be {max}',
            self::RULE_MATCH        => 'This field must be same as {match}',
            self::RULE_UNIQUE       => 'This {field} is already exists',
        ];
    }

    public function hasError($attributes) { 
        return $this->errors[$attributes] ?? false;
    }

    public function getFirstError($attribute) { 
        return $this->errors[$attribute][0] ?? false;
    }
}