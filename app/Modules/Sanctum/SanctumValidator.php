<?php

declare(strict_types=1);

namespace App\Modules\Sanctum;

class SanctumValidator
{
    public function validateIssuedToken(array $rawData) : void
    {
        $validator = validator($rawData, [
            "email" => "required|email",
            "password" => "required|string",
            "device" => "required|string"
        ]);

        if ($validator->fails()) {
            throw new \InvalidArgumentException(json_encode($validator->errors()->all()));
        }
    }
}
