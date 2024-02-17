<?php

namespace app\core\exceptions;

/**
 * Summary of NotFoundException
 * @author Dhrumil Sangani
 * @copyright (c) 2024
 */
class NotFoundException extends \Exception {
    protected $message = 'Page not found';
    protected $code = 404;
}