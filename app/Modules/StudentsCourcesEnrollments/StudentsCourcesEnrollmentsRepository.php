<?php

declare(strict_types=1);

namespace App\Modules\StudentsCourcesEnrollments;

use Exception;
use App\Modules\StudentsCourcesEnrollments\StudentsCourcesEnrollments;
use Illuminate\Support\Facades\DB;

class StudentsCourcesEnrollmentsRepository
{
    private $tableName = "students_courses_enrollments";
    private $selectColumns = [
        "students_courses_enrollments.id",
        "students_courses_enrollments.students_id AS studentsId",
        "students_courses_enrollments.courses_id AS coursesId",
        "students_courses_enrollments.enrolled_by_users_id AS enrolledByUsersId",
        "students_courses_enrollments.deleted_at AS deletedAt",
        "students_courses_enrollments.created_at AS createdAt",
        "students_courses_enrollments.updated_at AS updatedAt",
    ];

    public function get(int $id) : StudentsCourcesEnrollments
    {
        $selectColumns = implode(", ", $this->selectColumns);
        $result = json_decode(json_encode(
            DB::selectOne(
                "SELECT $selectColumns
                    FROM {$this->tableName}
                    WHERE id = :id AND deleted_at IS NULL
                ", [
                    "id" => $id
                ])
        ), true);
        if ($result === null) {
            throw new \InvalidArgumentException("Invalid students ID or course enrollments ID");
        }
        return StudentsCourcesEnrollmentsMapper::mapFrom($result);
    }
    public function update(StudentsCourcesEnrollments $courses): StudentsCourcesEnrollments
    {
        return DB::transaction(function () use ($courses) {
            DB::table($this->tableName)->updateOrInsert([
                "id" => $courses->getId()
            ], $courses->toSQL());
            $id = ($courses->getId() === null || $courses->getId() === 0)
                ? (int) DB::getPdo()->lastInsertId()
                : $courses->getId();

            return $this->get($id);
        });
    }

    public function softDelete(int $id) : bool
    {
        $result = DB::table($this->tableName)
            ->where("id", $id)
            ->where("deleted_at", null)
            ->update([
                "deleted_at" => date("Y-m-d H:i:s")
            ]);

        if($result !== 1) {
            throw new \InvalidArgumentException("Invalid Course ID");
        }
        return true;
    }
}
