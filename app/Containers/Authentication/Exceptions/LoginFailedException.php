<?php


namespace App\Containers\Authentication\Exceptions;


use Porto\Core\Exceptions\Abstracts\CoreException;
use Symfony\Component\HttpFoundation\Response;

class LoginFailedException extends CoreException
{
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = '登录失败';
}