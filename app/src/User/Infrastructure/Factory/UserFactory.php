<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Factory;

use App\User\Domain\Entity\User;
use App\User\Domain\Factory\UserFactoryInterface;
use App\User\Domain\ValueObject\Email;
use App\User\Domain\ValueObject\FirstName;
use App\User\Domain\ValueObject\IsVerified;
use App\User\Domain\ValueObject\LastName;
use App\User\Domain\ValueObject\Password;
use App\User\Domain\ValueObject\Phone;
use App\User\Domain\ValueObject\Roles;

class UserFactory implements UserFactoryInterface
{
    /**
     * @var FirstName
     */
    protected $firstname;

    /**
     * @var LastName
     */
    protected $lastname;

    /**
     * @var Email
     */
    protected $email;

    /**
     * @var Phone
     */
    protected $phone;

    /**
     * @var Roles
     */
    protected $roles;

    /**
     * @var Password
     */
    protected $password;

    /**
     * @var IsVerified
     */
    protected $isVerified;

    /**
     * @return static
     */
    public static function create(): UserFactoryInterface
    {
        return new self();
    }

    /**
     * Create User
     *
     * @return User
     */
    public function make(): User
    {
        return (new User())
            ->setFirstname($this->getFirstname())
            ->setLastname($this->getLastname())
            ->setEmail($this->getEmail())
            ->setPhone($this->getPhone())
            ->setPassword($this->getPassword())
            ->setIsVerified($this->getIsVerified())
            ->setRoles($this->getRoles());
    }

    /**
     * @inheritDoc
     */
    public function setEmail(Email $email): UserFactoryInterface
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setRoles(Roles $roles): UserFactoryInterface
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPassword(Password $password): UserFactoryInterface
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setFirstname(FirstName $firstname): UserFactoryInterface
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLastname(LastName $lastname): UserFactoryInterface
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPhone(Phone $phone): UserFactoryInterface
    {
        $this->phone = $phone;

        return $this;
    }


    /**
     * @return FirstName
     */
    public function getFirstname(): FirstName
    {
        return $this->firstname;
    }

    /**
     * @return LastName
     */
    public function getLastname(): LastName
    {
        return $this->lastname;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return Phone
     */
    public function getPhone(): Phone
    {
        return $this->phone;
    }

    /**
     * @return Roles
     */
    public function getRoles(): Roles
    {
        return $this->roles;
    }

    /**
     * @return Password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }

    /**
     * @return IsVerified
     */
    public function getIsVerified(): IsVerified
    {
        return $this->isVerified;
    }

    /**
     * @param IsVerified $isVerified
     *
     * @return $this
     */
    public function setIsVerified(IsVerified $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}