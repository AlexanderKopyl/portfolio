<?php
declare(strict_types=1);

namespace App\User\Domain\ValueObject;

class LastName extends AbstractValueObject
{
    /**
     * @var string
     */
    protected string $lastName;

    /**
     * @param string $lastName
     */
    public function __construct(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->getLastName();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getLastName();
    }
}