<?php

namespace App\User\Domain\Factory;

use App\User\Domain\Entity\User;
use App\User\Domain\ValueObject\Email;
use App\User\Domain\ValueObject\FirstName;
use App\User\Domain\ValueObject\IsVerified;
use App\User\Domain\ValueObject\LastName;
use App\User\Domain\ValueObject\Password;
use App\User\Domain\ValueObject\Phone;
use App\User\Domain\ValueObject\Roles;

interface UserFactoryInterface
{
    public function make(): User;

    /**
     * @param Email $email
     *
     * @return $this
     */
    public function setEmail(Email $email): UserFactoryInterface;

    /**
     * @param array $roles
     *
     * @return $this
     */
    public function setRoles(array $roles): UserFactoryInterface;

    /**
     * @param Password $password
     *
     * @return $this
     */
    public function setPassword(Password $password): UserFactoryInterface;

    /**
     * @param FirstName $firstname
     *
     * @return $this
     */
    public function setFirstname(FirstName $firstname): UserFactoryInterface;

    /**
     * @param LastName $lastname
     *
     * @return $this
     */
    public function setLastname(LastName $lastname): UserFactoryInterface;

    /**
     * @param Phone $phone
     *
     * @return $this
     */
    public function setPhone(Phone $phone): UserFactoryInterface;

    /**
     * @param int $isVerified
     *
     * @return $this
     */
    public function setIsVerified(int $isVerified): UserFactoryInterface;

}