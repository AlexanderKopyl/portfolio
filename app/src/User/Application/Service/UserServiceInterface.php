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
     * @param ID $ID
     *
     * @return User|null
     */
    public function get(ID $ID): ?User;

    /**
     * @param User $user
     *
     * @return void
     */
    public function delete(User $user): void;
}