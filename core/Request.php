<?php

namespace app\core;
/**
 * Summary of Request
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class Request
{
    /**
     * Summary of getPath
     * @return string
     */
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }
    /**
     * Summary of method
     * @return string
     */
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    } 
    /**
     * Summary of isGet
     * @return bool
     */
    public function isGet()
    {
        return $this->method() === 'get';
    } 
    /**
     * Summary of isPost
     * @return bool
     */
    public function isPost()
    {
        return $this->method() === 'post';
    }
    /**
     * Summary of getBody
     * @return array
     */
    public function getBody()
    {
        $body = [];
        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}