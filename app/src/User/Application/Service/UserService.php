<?php
declare(strict_types=1);

namespace App\User\Application\Service;

use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObject\ID;

class UserService implements UserServiceInterface
{

    /**
     * @var UserRepositoryInterface
     */
    protected UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function save(User $user): User
    {
        return $this->repository->save($user);
    }

    /**
     * {@inheritdoc}
     */
    public function get(ID $ID): ?User
    {
        return $this->repository->getById($ID);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(User $user): void
    {
        $this->repository->delete($user);
    }
}