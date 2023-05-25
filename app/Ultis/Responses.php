<?php

namespace App\Ultis;

use Symfony\Component\HttpFoundation\Response;

class Responses
{
    public static function success(string $title, string $message) {
        return \response()->json(["title" => $title, "message" => $message], Response::HTTP_OK);
    }

    public static function successWithData($data) {
        return \response()->json($data, Response::HTTP_OK);
    }

    public static function makeTokenData($token) {
        return [
          "access_token" => $token,
          "token_type" => "bearer",
          "expires_in" => auth()->factory()->getTTL() * 60
        ];
    }

    public static function successWithToken(string $token) {
        return \response()->json([
          "access_token" => $token,
          "token_type" => "bearer",
          "expires_in" => auth()->factory()->getTTL() * 60
        ]);
    }

    public static function error(string $message, int $status) {
        return \response()->json(["message" => $message], $status);
    }

    public static function exceptionError(\Throwable $exception) {
        return \response()->json(["message" => $exception->getMessage()], Response::HTTP_CONFLICT);
    }

    public static function unauthorized() {
        return \response()->json(["message" => "Unauthorized"], Response::HTTP_UNAUTHORIZED);
    }
}
