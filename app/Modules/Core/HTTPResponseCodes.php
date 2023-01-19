<?php

declare(strict_types=1);

namespace App\Modules\Core;

abstract class HTTPResponseCodes
{
    const Success = [
        "title"   => "success",
        "code"    => 200,
        "message" => "Request processed successfully!"
    ];

    const NotFound = [
        "title"   => "not_found_error",
        "code"    => 404,
        "message" => "Could not locate the resource!"
    ];

    const InvalidArguments = [
        "title"   => "invalid_arguments_error",
        "code"    => 400,
        "message" => "Invalid arguments. Server failed to process your request!"
    ];

    const BadRequest = [
        "title"   => "not_found_error",
        "code"    => 400,
        "message" => "Could not locate the resource!"
    ];
}
