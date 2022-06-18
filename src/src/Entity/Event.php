<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event extends Attraction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public $id;

    #[ORM\Column(type: 'string', length: 255)]
    public ?string $organizer;

    #[ORM\Column(type: 'datetime_immutable')]
    public ?\DateTimeImmutable $start_datetime;

    #[ORM\Column(type: 'datetime_immutable')]
    public ?\DateTimeImmutable $end_datetime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrganizer(): ?string
    {
        return $this->organizer;
    }

    public function setOrganizer(string $organizer): self
    {
        $this->organizer = $organizer;

        return $this;
    }

    public function getStartDatetime(): ?\DateTimeImmutable
    {
        return $this->start_datetime;
    }

    public function setStartDatetime(\DateTimeImmutable $start_datetime): self
    {
        $this->start_datetime = $start_datetime;

        return $this;
    }

    public function getEndDatetime(): ?\DateTimeImmutable
    {
        return $this->end_datetime;
    }

    public function setEndDatetime(\DateTimeImmutable $end_datetime): self
    {
        $this->end_datetime = $end_datetime;

        return $this;
    }
}
