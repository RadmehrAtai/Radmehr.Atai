<?php

namespace App\Model;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

trait TimeTrait
{
    #[ORM\Column(type: 'datetime_immutable',nullable: true)]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable',nullable: true)]
    private $updatedAt;

    /**
     * @return mixed
     */
    public function getCreatedAt(): mixed
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeImmutable $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt(): mixed
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeImmutable $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}