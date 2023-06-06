<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\TestFixture\func;

class Responses
{
    public function success()
    {
        return function (string $title, string $message) {
            return \response()->json([
                "title" => $title,
                "message" => $message
            ], Response::HTTP_OK);
        };
    }

    public function successWithData()
    {
        return function ($data) {
            return \response()->json($data, Response::HTTP_OK);
        };
    }

    public function makeTokenData()
    {
        return function ($token) {
            return [
                "access_token" => $token,
                "token_type" => "bearer",
                "expires_in" => auth()->factory()->getTTL() * 60,
            ];
        };

    }

    public function error()
    {
        return function (string $message, int $status) {
            return \response()->json([
                "title" => MessageResource::DEFAULT_FAIL_TITLE,
                "message" => $message
            ], $status);
        };
    }

    public function unauthorized()
    {
        return function () {
            return \response()->json([
                "title" => MessageResource::DEFAULT_FAIL_TITLE,
                "message" => MessageResource::LOGIN_UNAUTHORIZED],
                Response::HTTP_UNAUTHORIZED,
            );
        };
    }
}
