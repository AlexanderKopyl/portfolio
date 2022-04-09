<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Factory;

use App\User\Application\DTO\UserDataTransfer;
use App\User\Infrastructure\Entity\User;

class UserFactory
{
    /**
     * @return UserDataTransfer
     */
    public static function createUserTransfer(): UserDataTransfer
    {
        return new UserDataTransfer();
    }

    public function createUser()
    {
        return new User();
    }
}