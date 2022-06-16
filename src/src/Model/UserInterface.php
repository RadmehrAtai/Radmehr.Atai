<?php

namespace App\Model;

interface UserInterface
{
    public function getCreatedUser();

    public function setCreatedUser($user);

    public function getUpdatedUser();

    public function setUpdatedUser($user);
}