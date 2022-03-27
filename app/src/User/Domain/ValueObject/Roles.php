<?php
declare(strict_types=1);

namespace App\User\Domain\ValueObject;

class Roles extends AbstractValueObject
{

    protected array $roles = [];

    /**
     * @param array $roles
     */
    public function __construct(array $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return array
     */
    public function getUniqRole(): array
    {
        return array_unique($this->roles);
    }

    /**
     * @param string $role
     *
     * @return $this
     */
    public function setRole(string $role): self
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->getUniqRole();
    }

    /**
     * @return string
     *
     * @throws \JsonException
     */
    public function __toString()
    {
        return (string)json_encode($this->getUniqRole(), JSON_THROW_ON_ERROR);
    }
}