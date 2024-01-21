<?php

namespace app\core;
/**
 * Summary of Response
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class Response {
    /**
     * Summary of setStatusCode
     * @param int $code
     * @return void
     */
    public function setStatusCode(int $code) {
        http_response_code($code);
    }
}