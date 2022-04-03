<?php
declare(strict_types=1);

namespace App\User\Domain\Entity;

use App\User\Domain\ValueObject\Email;
use App\User\Domain\ValueObject\FirstName;
use App\User\Domain\ValueObject\LastName;
use App\User\Domain\ValueObject\Password;
use App\User\Domain\ValueObject\Phone;

class User
{
    /**
     * @var int
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
     * @var array
     */
    protected $roles;

    /**
     * @var Password
     */
    protected $password;

    /**
     * @var int
     */
    protected $isVerified;

    public function getId(): int
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
        return $this->roles;
    }

    public function setRoles(array $roles): self
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

    /**
     * @return int
     */
    public function getIsVerified(): int
    {
        return $this->isVerified;
    }

    /**
     * @param int $isVerified
     *
     * @return $this
     */
    public function setIsVerified(int $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @param array $arrayFromDataTransfer
     *
     * @return $this
     */
    public function fromArray(array $arrayFromDataTransfer): self
    {
        foreach ($arrayFromDataTransfer as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        return $this;
    }

    public function isEmpty(): bool
    {
        return (bool)get_object_vars($this);
    }
}
