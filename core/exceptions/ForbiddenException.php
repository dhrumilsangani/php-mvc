<?php

namespace app\core\exceptions;

/**
 * Summary of ForbiddenException
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class ForbiddenException extends \Exception {
    protected $message = 'You don\'t have permissions to access this page';
    protected $code = 403;
}