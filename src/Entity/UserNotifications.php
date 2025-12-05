<?php

namespace App\Entity;

use App\Repository\UserNotificationsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: UserNotificationsRepository::class)]
#[Broadcast]
class UserNotifications
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userNotifications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'userNotifications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Notifications $notification_id = null;

    #[ORM\Column]
    private ?\DateTime $read_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getNotificationId(): ?Notifications
    {
        return $this->notification_id;
    }

    public function setNotificationId(?Notifications $notification_id): static
    {
        $this->notification_id = $notification_id;

        return $this;
    }

    public function getReadAt(): ?\DateTime
    {
        return $this->read_at;
    }

    public function setReadAt(\DateTime $read_at): static
    {
        $this->read_at = $read_at;

        return $this;
    }
}
