<?php


namespace App\Containers\Authentication\Exceptions;


use Porto\Core\Exceptions\Abstracts\CoreException;
use Symfony\Component\HttpFoundation\Response;

class RefreshTokenMissedException extends CoreException
{

    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = '找不到Refresh Token!';
}