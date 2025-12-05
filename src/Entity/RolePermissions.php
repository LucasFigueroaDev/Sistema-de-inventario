<?php

namespace App\Entity;

use App\Repository\RolePermissionsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: RolePermissionsRepository::class)]
#[Broadcast]
class RolePermissions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'rolePermissions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?roles $role = null;

    #[ORM\ManyToOne(inversedBy: 'rolePermissions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Permissions $permission = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?roles
    {
        return $this->role;
    }

    public function setRole(?roles $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getPermission(): ?Permissions
    {
        return $this->permission;
    }

    public function setPermission(?Permissions $permission): static
    {
        $this->permission = $permission;

        return $this;
    }
}
