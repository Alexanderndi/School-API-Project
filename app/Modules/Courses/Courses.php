<?php

declare(strict_types=1);

namespace App\Modules\Courses;

class Courses
{
    private ?int $id;
    private string $name;
    private int $totalStudentsEnrolled;
    private int $capacity;
    private ?string $deletedAt;
    private string $createdAt;
    private ?string $updatedAt;

    public function __construct(
        ?int $id,
        string $name,
        int $totalStudentsEnrolled,
        int $capacity,
        ?string $deletedAt,
        string $createdAt,
        ?string $updatedAt
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->totalStudentsEnrolled = $totalStudentsEnrolled;
        $this->capacity = $capacity;
        $this->deletedAt = $deletedAt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function toArray() : array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "totalStudentsEnrolled" => $this->totalStudentsEnrolled,
            "capacity" => $this->capacity,
            "deletedAt" => $this->deletedAt,
            "createdAt" => $this->createdAt,
            "updatedAt" => $this->updatedAt,
        ];
    }
    public function toSQL() : array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "capacity" => $this->capacity,
            "deleted_at" => $this->deletedAt,
            "created_at" => $this->createdAt,
            "updated_at" => $this->updatedAt,
        ];
    }
    public function getId() : ?int
    {
        return $this->id;
    }
    public function getName() : string
    {
        return $this->name;
    }
    public function getEmail() : int
    {
        return $this->capacity;
    }
    public function getDeletedAt() : ?string
    {
        return $this->deletedAt;
    }
    public function getCreatedAt() : string
    {
        return $this->createdAt;
    }
    public function getUpdatedAt() : ?string
    {
        return $this->updatedAt;
    }
    public function getTotalStudentsEnrolled() : int
    {
        return $this->totalStudentsEnrolled;
    }

}
