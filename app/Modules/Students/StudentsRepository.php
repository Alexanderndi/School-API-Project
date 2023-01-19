<?php

declare(strict_types=1);

namespace App\Modules\Students;

use Exception;
use App\Modules\Students\Students;
use Illuminate\Support\Facades\DB;

class StudentsRepository
{
    private $tableName = "students";
    private $selectColumns = [
        "students.id",
        "students.name",
        "students.email",
        "students.deleted_at AS deletedAt",
        "students.created_at AS createdAt",
        "students.updated_at AS updatedAt",
    ];

    public function get(int $id) : Students
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
            throw new \InvalidArgumentException("Invalid student ID");
        }
        return StudentsMapper::mapFrom($result);
    }
    public function update(Students $students): Students
    {
        return DB::transaction(function () use ($students) {
            DB::table($this->tableName)->updateOrInsert([
                "id" => $students->getId()
            ], $students->toSQL());
            $id = ($students->getId() === null || $students->getId() === 0)
                ? (int) DB::getPdo()->lastInsertId()
                : $students->getId();

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
            throw new \InvalidArgumentException("Invalid Students ID");
        }
        return true;
    }

    public function getByCourseId(int $courseId): array
    {
        $selectColumns = implode(", ", $this->selectColumns);
        $result = json_decode(json_encode(
            DB::select(
                "SELECT $selectColumns
                    FROM {$this->tableName}
                    JOIN students_courses_enrollments ON students_courses_enrollments.courses_id : courseId
                    WHERE student.id = students_courses_enrollments.student_id
                    AND students_courses_enrollments.deleted_at IS NULL
                ", [
                    "courseId" => $courseId
                ])
        ), true);
        if (count($result) === 0) {
            throw new \InvalidArgumentException("No Student enrolled with the provided ID");
        }


        return array_map(function ($row) {
            return StudentsMapper::mapFrom($row);
        }, $result);
    }
}
