<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Dingo\Api\Exception\ResourceException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests, Helpers;

    /**
     * The controller's default status code
     *
     * @var int
     */
    protected $statusCode = \Dingo\Api\Http\Response::HTTP_OK;

    /**
     * Throws a validation Exception
     *
     * @param Request $request
     * @param $validator
     */
    protected function throwValidationException(Request $request, $validator)
    {
        throw new ResourceException("Validation failed", $validator->getMessageBag());
    }
}