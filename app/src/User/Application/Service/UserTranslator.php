<?php
declare(strict_types=1);

namespace App\User\Application\Service;

use App\User\Application\DTO\UserDataTransfer;
use App\User\Domain\Entity\User as DomainUser;
use App\User\Infrastructure\Entity\User;
use App\User\Domain\ValueObject\Email;
use App\User\Domain\ValueObject\FirstName;
use App\User\Domain\ValueObject\ID;
use App\User\Domain\ValueObject\IsVerified;
use App\User\Domain\ValueObject\LastName;
use App\User\Domain\ValueObject\Password;
use App\User\Domain\ValueObject\Roles;
use App\User\Domain\ValueObject\UkrainianPhone;
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
     * @param UserDataTransfer $userDataTransfer
     *
     * @return User
     */
    public function createUserTransfer(UserDataTransfer $userDataTransfer): User
    {
        return $this->readDTO($userDataTransfer);
    }

    /**
     * @return User|DomainUser
     */
    public function createUser(): User|DomainUser
    {
        $userTransfer = new UserDataTransfer(
            new ID(0),
            new FirstName(''),
            new LastName(''),
            new Email('unknown@gmail.com'),
            new UkrainianPhone('0998887777'),
            new Roles([]),
            new Password(""),
            new IsVerified()
        );

        return (new User())->fromArray($userTransfer->toArray());
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
        if($user->isEmpty()) {
            return $this->createUser();
        }

        return new UserDataTransfer(
            $user->getId(),
            $user->getFirstname(),
            $user->getLastname(),
            $user->getEmail(),
            $user->getPhone(),
            new Roles($user->getRoles()),
            new Password($user->getPassword()),
            $user->getIsVerified()
        );
    }
}