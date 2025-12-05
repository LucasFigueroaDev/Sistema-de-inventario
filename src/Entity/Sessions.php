<?php

namespace App\Entity;

use App\Repository\SessionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionsRepository::class)]
class Sessions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'sessions', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user_id = null;

    #[ORM\Column]
    private ?\DateTime $login_time = null;

    #[ORM\Column]
    private ?\DateTime $logout_time = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(user $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getLoginTime(): ?\DateTime
    {
        return $this->login_time;
    }

    public function setLoginTime(\DateTime $login_time): static
    {
        $this->login_time = $login_time;

        return $this;
    }

    public function getLogoutTime(): ?\DateTime
    {
        return $this->logout_time;
    }

    public function setLogoutTime(\DateTime $logout_time): static
    {
        $this->logout_time = $logout_time;

        return $this;
    }
}
