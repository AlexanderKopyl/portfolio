<?php

namespace App\User\Domain\Repository;

use App\User\Domain\Entity\User;
use App\User\Domain\ValueObject\ID;

interface UserRepositoryInterface
{
    /**
     * @param ID $id
     * @return User|null
     */
    public function getById(ID $id): ?User;

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