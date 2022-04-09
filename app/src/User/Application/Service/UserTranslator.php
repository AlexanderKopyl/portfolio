<?php
declare(strict_types=1);

namespace App\User\Application\Service;

use App\User\Application\DTO\UserDataTransfer;
use App\User\Infrastructure\Entity\User;
use App\User\Domain\ValueObject\Password;
use App\User\Domain\ValueObject\Exception\InvalidEmailException;

class UserTranslator
{
    public function readDTO(UserDataTransfer $userDataTransfer, ?User $user = null): User
    {
        if (!$user) {
            $user = new User();
        }

        $user->fromArray($userDataTransfer->toArray());

        return $user;
    }

    /**
     * @param User $user
     * @param UserDataTransfer $userDataTransfer
     *
     * @return User
     */
    public function updateUser(User $user, UserDataTransfer $userDataTransfer): User
    {
        return $this->readDTO($userDataTransfer, $user);
    }

    /**
     * @param User $user
     *
     * @return UserDataTransfer|User
     *
     * @throws InvalidEmailException
     */
    public function writeDTO(User $user): UserDataTransfer|User
    {
        $dataUser = [
            'id' => $user->getId(),
            'firstname'=> $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'phone' => $user->getPhone(),
            'roles' => $user->getRoles(),
            'password' => new Password($user->getPassword()),
            'isVerified' => $user->getIsVerified()
        ];

        return (new UserDataTransfer())->fromArray($dataUser);
    }
}