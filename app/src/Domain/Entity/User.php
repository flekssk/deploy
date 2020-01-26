<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * @var array
     */
    const ROLE_REAL_NAME = [
        'ROLE_GUEST' => 'Гость',
        'ROLE_MARKETER' => 'Маркетолог',
        'ROLE_SUPERVISOR' => 'Супервизор',
        'ROLE_ADMIN' => 'Администратор',
    ];

    public $publishGroup;

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string
     */
    private $roles;

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $email = '';

    /**
     * @var boolean
     */
    private $isActive;

    /**
     * @var \DateTimeInterface
     */
    private $createdAt;

    /**
     * @var \DateTimeInterface|null
     */
    private $deletedAt;

    /**
     * User constructor.
     * @param string $role
     * @throws \Exception
     */
    public function __construct(
        string $role = 'ROLE_GUEST'
    )
    {
        $this->roles = $role;
        $this->isActive = true;
        $this->createdAt = new \DateTimeImmutable();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return (string)$this->uuid;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return (string)$this->uuid;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return static::ROLE_REAL_NAME[$this->roles];
    }

    /**
     * @return string
     */
    public function getRoleRealName(): string
    {
        return $this->roles;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return $this->name;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return (array)$this->roles;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTimeInterface|null $deletedAt
     */
    public function setDeletedAt(?\DateTimeInterface $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $roles
     */
    public function setRoles(string $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @param string $role
     */
    public function setRoleRealName(string $role): void
    {
        $this->roles = $role;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
