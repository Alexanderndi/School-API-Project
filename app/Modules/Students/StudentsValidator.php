<?php

declare(strict_types=1);

namespace App\Modules\Students;

class StudentsValidator
{
    public function validateUpdate(array $data)
    {
        $validator = validator($data, [
            "name" => "required|string",
            "email" => "required|string|email"
        ]);

        if ($validator->fails()) {
            throw new \InvalidArgumentException(json_encode($validator->errors()->all()));
        }
    }
}
