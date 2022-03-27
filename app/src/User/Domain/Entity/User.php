<?php
declare(strict_types=1);

namespace App\User\Domain\Entity;

use App\User\Domain\ValueObject\Email;
use App\User\Domain\ValueObject\FirstName;
use App\User\Domain\ValueObject\ID;
use App\User\Domain\ValueObject\LastName;
use App\User\Domain\ValueObject\Password;
use App\User\Domain\ValueObject\Phone;
use App\User\Domain\ValueObject\Roles;

class User
{
    /**
     * @var ID
     */
    protected $id;

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

    public function getId(): ?ID
    {
        return $this->id;
    }

    public function getEmail(): ?Email
    {
        return $this->email;
    }

    public function setEmail(Email $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see Roles
     */
    public function getRoles(): array
    {
        $this->roles->setRole('ROLE_USER');

        return $this->roles->getValue();
    }

    public function setRoles(Roles $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(Password $password): self
    {
        $this->password = $password;

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
     * @param FirstName $firstname
     *
     * @return $this
     */
    public function setFirstname(FirstName $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return LastName
     */
    public function getLastname(): LastName
    {
        return $this->lastname;
    }

    /**
     * @param LastName $lastname
     *
     * @return $this
     */
    public function setLastname(LastName $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Phone
     */
    public function getPhone(): Phone
    {
        return $this->phone;
    }

    /**
     * @param Phone $phone
     *
     * @return $this
     */
    public function setPhone(Phone $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
