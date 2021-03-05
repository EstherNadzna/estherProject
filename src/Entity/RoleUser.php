<?php

namespace App\Entity;

use App\Repository\RoleUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleUserRepository::class)
 */
class RoleUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $roleU;

    /**
     * @ORM\ManyToMany(targetEntity=AccountUser::class, mappedBy="role")
     */
    private $accountUsers;

    public function __construct()
    {
        $this->accountUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleU(): ?string
    {
        return $this->roleU;
    }

    public function setRoleU(string $roleU): self
    {
        $this->roleU = $roleU;

        return $this;
    }

    /**
     * @return Collection|AccountUser[]
     */
    public function getAccountUsers(): Collection
    {
        return $this->accountUsers;
    }

    public function addAccountUser(AccountUser $accountUser): self
    {
        if (!$this->accountUsers->contains($accountUser)) {
            $this->accountUsers[] = $accountUser;
            $accountUser->addRole($this);
        }

        return $this;
    }

    public function removeAccountUser(AccountUser $accountUser): self
    {
        if ($this->accountUsers->removeElement($accountUser)) {
            $accountUser->removeRole($this);
        }

        return $this;
    }
}
