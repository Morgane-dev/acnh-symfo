<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RoleRepository;
use App\Trait\TimestampableTrait;
use App\Trait\AutoIdentifyableTrait;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    use AutoIdentifyableTrait;
    use TimestampableTrait;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $code;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $label;

    #[ORM\OneToMany(mappedBy: 'role', targetEntity: User::class)]
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * Get the value of code
     */ 
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of label
     */ 
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Set the value of label
     *
     * @return  self
     */ 
    public function setLabel($label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setRole($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getRole() === $this) {
                $user->setRole(null);
            }
        }

        return $this;
    }
}