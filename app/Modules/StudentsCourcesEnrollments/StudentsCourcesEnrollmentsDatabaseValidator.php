<?php

declare(strict_types=1);

namespace App\Modules\StudentsCourcesEnrollments;

use App\Modules\Courses\CoursesService;
use App\Modules\Students\StudentsService;

class StudentsCourcesEnrollmentsDatabaseValidator
{
    private CoursesService $coursesService;
    private StudentsService $studentsService;
    public function __construct(CoursesService $coursesService, StudentsService $studentsService)
    {
        $this->coursesService = $coursesService;
        $this->studentsService = $studentsService;
    }

    public function validateUpdate(int $coursesId, int $studentsId): void
    {
        $course = $this->coursesService->get($coursesId);
        if ($course->getTotalStudentsEnrolled() >= $course->getCapacity())
        {
            throw new \InvalidArgumentException("Failed to enrolled student. Course enrollment limit {$course->getTotalStudentsEnrolled()} reached");
        }

        // No duplicate
        $studentsEnrolled = $this->studentsService->getByCourseId($coursesId);
        for ($i =0; $i < count($studentsEnrolled); $i++) {
            if ($studentsEnrolled[$i]->getId() === $studentsId) {
                throw new \InvalidArgumentException("Failed to enrolled student. Student already registered");
            }
        }

    }
}
