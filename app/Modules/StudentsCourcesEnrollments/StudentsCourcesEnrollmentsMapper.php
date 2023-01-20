<?php

declare(strict_types=1);

namespace App\Modules\StudentsCourcesEnrollments;

use App\Modules\Common\MyHelpers;

class StudentsCourcesEnrollmentsMapper
{
    public static function mapFrom(array $data) : StudentsCourcesEnrollments
    {
        return new StudentsCourcesEnrollments(
            MyHelpers::nullStringToInt($data["id"] ?? null),
            $data["studentsId"],
            $data["coursesId"],
            $data["enrolledByUsersId"],
            $data["deletedAt"] ?? null,
            $data["createdAt"] ?? date("Y-m-d H:i:s"),
            $data["updatedAt"] ?? null
        );
    }
}
