<?php


namespace App\Containers\Authentication\Exceptions;


use Porto\Core\Exceptions\Abstracts\CoreException;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationException extends CoreException
{
    public $httpStatusCode = Response::HTTP_UNAUTHORIZED;

    public $message = '尝试验证用户身份时发生异常。';
}