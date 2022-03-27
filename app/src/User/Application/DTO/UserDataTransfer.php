<?php
declare(strict_types=1);

namespace App\User\Application\DTO;

use App\User\Domain\ValueObject\Email;
use App\User\Domain\ValueObject\FirstName;
use App\User\Domain\ValueObject\ID;
use App\User\Domain\ValueObject\IsVerified;
use App\User\Domain\ValueObject\LastName;
use App\User\Domain\ValueObject\Password;
use App\User\Domain\ValueObject\Phone;
use App\User\Domain\ValueObject\Roles;

class UserDataTransfer
{
    /**
     * @var ID
     */
    public $id;

    /**
     * @var FirstName
     */
    public $firstname;

    /**
     * @var LastName
     */
    public $lastname;

    /**
     * @var Email
     */
    public $email;

    /**
     * @var Phone
     */
    public $phone;

    /**
     * @var Roles
     */
    public $roles;

    /**
     * @var Password
     */
    public $password;

    /**
     * @var IsVerified
     */
    public $isVerified;

    /**
     * @var array
     */
    public array $customData = [];

    /**
     * @param ID $id
     * @param FirstName $firstname
     * @param LastName $lastname
     * @param Email $email
     * @param Phone $phone
     * @param Roles $roles
     * @param Password $password
     * @param IsVerified $isVerified
     */
    public function __construct(
        ID         $id,
        FirstName  $firstname,
        LastName   $lastname,
        Email      $email,
        Phone      $phone,
        Roles      $roles,
        Password   $password,
        IsVerified $isVerified
    ) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->phone = $phone;
        $this->roles = $roles;
        $this->password = $password;
        $this->isVerified = $isVerified;
    }

    /**
     * @param string $name
     * @param $value
     *
     * @return void
     */
    public function __set(string $name, $value): void
    {
        $this->customData[$name] = $value;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        if (!isset($this->customData[$name])) {
            throw new \RuntimeException("Parameter " . $name . " doesn't exist");
        }

        return $this->customData[$name];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->customData[$name]);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}