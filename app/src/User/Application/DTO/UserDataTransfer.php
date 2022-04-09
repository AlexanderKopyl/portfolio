<?php
declare(strict_types=1);

namespace App\User\Application\DTO;

use App\Shared\DataObjectTransfer;
use App\User\Domain\ValueObject\Email;
use App\User\Domain\ValueObject\FirstName;
use App\User\Domain\ValueObject\LastName;
use App\User\Domain\ValueObject\Password;
use App\User\Domain\ValueObject\Phone;

class UserDataTransfer extends DataObjectTransfer
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var FirstName
     */
    public FirstName $firstname;

    /**
     * @var LastName
     */
    public LastName $lastname;

    /**
     * @var Email
     */
    public Email $email;

    /**
     * @var Phone
     */
    public Phone $phone;

    /**
     * @var array
     */
    public array $roles;

    /**
     * @var Password
     */
    public Password $password;

    /**
     * @var int
     */
    public int $isVerified;
}