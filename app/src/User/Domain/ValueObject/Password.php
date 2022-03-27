<?php
declare(strict_types=1);

namespace App\User\Domain\ValueObject;

class Password extends AbstractValueObject
{
    /**
     * @var string
     */
    protected string $password;

    /**
     * @param string $password
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->getPassword();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getPassword();
    }
}