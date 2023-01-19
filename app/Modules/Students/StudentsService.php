<?php

declare(strict_types=1);

namespace App\Modules\Students;

use App\Modules\Students\Students;

class StudentsService
{
    private StudentsValidator $validator;
    private StudentsRepository $repository;
    public function __construct(
        StudentsValidator $validator,
        StudentsRepository $repository
        )
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    public function get(int $id) : Students
    {
        return $this->repository->get($id);
    }

    /**
     * Summary of getByCourseId
     * @param int $courseId
     * @return Students[]
     */
    public function getByCourseId(int $courseId) : array
    {
        return $this->repository->getByCourseId($courseId);
    }
    /**
     * Summary of update
     * @param array $data
     * @return Students
     */
    public function update(array $data) : Students
    {
        $this->validator->validateUpdate($data);
        return $this->repository->update(
            StudentsMapper::mapFrom($data)
        );
    }

    public function softDelete(int $id) : bool
    {
        return $this->repository->softDelete($id);
    }
}
