<?php

declare(strict_types=1);

namespace App\Modules\Courses;

use App\Modules\Courses\Courses;

class CoursesService
{
    private CoursesValidator $validator;
    private CoursesRepository $repository;
    public function __construct(
        CoursesValidator $validator,
        CoursesRepository $repository
        )
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    public function get(int $id) : Courses
    {
        return $this->repository->get($id);
    }

    /**
     * Summary of update
     * @param array $data
     * @return Courses
     */
    public function update(array $data) : Courses
    {
        $this->validator->validateUpdate($data);
        return $this->repository->update(
            CoursesMapper::mapFrom($data)
        );
    }

    public function softDelete(int $id) : bool
    {
        return $this->repository->softDelete($id);
    }
}
