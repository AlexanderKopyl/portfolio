<?php
declare(strict_types=1);

namespace App\User\Domain\ValueObject;

class IsVerified extends AbstractValueObject
{

    /**
     * @var bool
     */
    protected bool $isVerified;

    /**
     * @param bool $value
     */
    public function __construct(bool $value)
    {
        $this->isVerified = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function getValue(): bool
    {
        return $this->isVerified;
    }
}