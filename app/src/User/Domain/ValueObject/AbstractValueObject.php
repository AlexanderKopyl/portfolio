<?php
declare(strict_types=1);

namespace App\User\Domain\ValueObject;

abstract class AbstractValueObject
{
    /**
     * @return mixed|string|int
     */
    abstract public function getValue();
}