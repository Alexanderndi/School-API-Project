<?php

declare(strict_types=1);

namespace App\Modules\StudentsCourcesEnrollments;

use App\Modules\StudentsCourcesEnrollments\StudentsCourcesEnrollmentsValidator;
use Illuminate\Support\Facades\Auth;

class StudentsCourcesEnrollmentsService
{
    private StudentsCourcesEnrollmentsValidator $validator;
    private StudentsCourcesEnrollmentsRepository $repository;
    public function __construct(
        StudentsCourcesEnrollmentsValidator $validator,
        StudentsCourcesEnrollmentsRepository $repository
        )
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    public function get(int $id) : StudentsCourcesEnrollments
    {
        return $this->repository->get($id);
    }

    /**
     * Summary of update
     * @param array $data
     * @return StudentsCourcesEnrollments
     */
    public function update(array $data) : StudentsCourcesEnrollments
    {
        $data = array_merge(
            $data,
            [
                "enrolledByUsersId" => Auth::user()->id
            ]
        );
        $this->validator->validateUpdate($data);
        return $this->repository->update(
            StudentsCourcesEnrollmentsMapper::mapFrom($data)
        );
    }

    public function softDelete(int $id) : bool
    {
        return $this->repository->softDelete($id);
    }
}
