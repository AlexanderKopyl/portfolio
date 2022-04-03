<?php

namespace App\User\Infrastructure\Entity;

use App\User\Domain\Entity\User as DomainUser;
use App\User\Domain\ValueObject\Email;
use App\User\Domain\ValueObject\Exception\InvalidEmailException;
use App\User\Domain\ValueObject\FirstName;
use App\User\Domain\ValueObject\LastName;
use App\User\Domain\ValueObject\Password;
use App\User\Domain\ValueObject\Phone;
use App\User\Domain\ValueObject\UkrainianPhone;
use App\User\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User extends DomainUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=180, unique=true)
     */
    protected $email;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    protected $roles;

    /**
     * @var string The hashed password
     *
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=1)
     */
    protected $isVerified;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @throws InvalidEmailException
     */
    public function getEmail(): ?Email
    {
        return new Email($this->email);
    }

    public function setEmail(Email $email): self
    {
        $this->email = (string)$email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     *
     * @return $this
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return (string)(new Password($this->password));
    }

    /**
     * @param Password $password
     *
     * @return $this
     */
    public function setPassword(Password $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return FirstName
     */
    public function getFirstname(): FirstName
    {
        return new FirstName($this->firstname);
    }

    /**
     * @param FirstName $firstname
     *
     * @return $this
     */
    public function setFirstname(FirstName $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return LastName
     */
    public function getLastname(): LastName
    {
        return new LastName($this->lastname);
    }

    /**
     * @param LastName $lastname
     *
     * @return $this
     */
    public function setLastname(LastName $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Phone
     */
    public function getPhone(): Phone
    {
        return new UkrainianPhone($this->phone);
    }

    /**
     * @param Phone $phone
     *
     * @return $this
     */
    public function setPhone(Phone $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return int
     */
    public function isVerified(): int
    {
        return $this->isVerified;
    }

    /**
     * @param int $isVerified
     *
     * @return $this
     */
    public function setIsVerified(int $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
