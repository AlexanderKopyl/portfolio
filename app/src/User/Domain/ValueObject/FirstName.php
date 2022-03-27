<?php
declare(strict_types=1);

namespace App\User\Domain\ValueObject;

class FirstName extends AbstractValueObject
{
    /**
     * @var string
     */
    protected string $firstname;

    /**
     * @param string $name
     */
    public function __construct(string $firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstname;
    }

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->getFirstName();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getFirstName();
    }
}