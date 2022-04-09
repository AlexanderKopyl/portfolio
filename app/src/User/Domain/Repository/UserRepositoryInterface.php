<?php

namespace App\User\Domain\Repository;

use App\User\Domain\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User;

    /**
     * @param User $user
     *
     * @return User
     */
    public function save(User $user): User;

    /**
     * @param User $user
     *
     * @return void
     */
    public function delete(User $user): void;
}