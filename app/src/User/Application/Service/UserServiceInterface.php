<?php

namespace App\User\Application\Service;

use App\User\Domain\Entity\User;
use App\User\Domain\ValueObject\ID;

interface UserServiceInterface
{
    /**
     * @param User $user
     *
     * @return User
     */
    public function save(User $user): User;

    /**
     * @param int $id
     *
     * @return User|null
     */
    public function get(int $id): ?User;

    /**
     * @param User $user
     *
     * @return void
     */
    public function delete(User $user): void;
}