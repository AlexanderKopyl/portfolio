<?php
declare(strict_types=1);

namespace App\User\Domain\ValueObject;

use App\User\Domain\ValueObject\Exception\InvalidEmailException;

class Email extends AbstractValueObject
{
    /**
     * @var string
     */
    protected string $email;

    /**
     * @param string $email
     * @throws InvalidEmailException
     */
    public function __construct(string $email)
    {
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException($email);
        }

        $this->email = $email;
    }

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getValue();
    }
}