<?php

namespace App\Exceptions;

use App\Utils\MessageResource;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ExceptionProcessor
{
    public function processor(Throwable $e)
    {
        $response = "";
        if ($e instanceof QueryException) {
            $response = $this->queryException($e);
        }
        return $response;
    }

    public function queryException(QueryException $exception)
    {
        if ($exception->getCode() == 23000) {
            if (Str::contains($exception->getMessage(), ["Duplicate", "email"])) {
                return JsonResponse::error(
                    MessageResource::REGISTER_EMAIL_EXIST,
                    Response::HTTP_NOT_ACCEPTABLE
                );
            }
        }
        return JsonResponse::error(MessageResource::EXCEPTION_QUERY_DEFAULT_MESSAGE, Response::HTTP_CONFLICT);
    }
}
