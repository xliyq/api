<?php


namespace App\Containers\Authorization\Exceptions;


use Porto\Core\Exceptions\Abstracts\CoreException;
use Symfony\Component\HttpFoundation\Response;

class PermissionNotFoundException extends CoreException
{
    public $httpStatusCode = Response::HTTP_NOT_FOUND;

    public $message = '请求的Role未找到';
}