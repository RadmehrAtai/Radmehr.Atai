<?php

namespace App\Model;

interface TimeInterface
{
    public function getCreatedAt();

    public function setCreatedAt($dateTime);

    public function getUpdatedAt();

    public function setUpdatedAt($dateTime);
}