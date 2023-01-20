<?php

declare(strict_types=1);

namespace App\Modules\StudentsCourcesEnrollments;

use App\Modules\StudentsCourcesEnrollments\StudentsCourcesEnrollmentsDatabaseValidator;

class StudentsCourcesEnrollmentsValidator
{
    private StudentsCourcesEnrollmentsDatabaseValidator $dbValidator;
    public function __construct(StudentsCourcesEnrollmentsDatabaseValidator $dbValidator)
    {
        $this->dbValidator = $dbValidator;
    }
    public function validateUpdate(array $data) : void
    {
        $validator = validator($data, [
            "studentsId" => "required|integer|exists:students,id",
            "coursesId" => "required|integer|exists:courses,id",
            "enrolledByUsersId" => "required|integer|exists:users,id"
        ]);

        if ($validator->fails()) {
            throw new \InvalidArgumentException(json_encode($validator->errors()->all()));
        }

        $this->dbValidator->validateUpdate($data["coursesId"], $data["studentsId"]);
    }
}
