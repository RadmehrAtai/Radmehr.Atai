<?php

namespace App\Security;

use App\Entity\User;
use App\Entity\Hotel;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;


class OwnerVoter extends Voter
{
    const EDIT = 'edit';
    const DELETE = 'delete';
    const NEW = 'new';
    const VIEW = 'view';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::VIEW, self::EDIT, self::DELETE, self::NEW])) {
            return false;
        }

        // only vote on `Hotel` objects
        if (!$subject instanceof Hotel) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        /** @var Hotel $hotel */
        $hotel = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView();
            case self::EDIT:
                return $this->canEdit($hotel, $user);
            case self::NEW:
                return $this->canNew($hotel, $user);
            case self::DELETE:
                return $this->canDelete($hotel, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(): bool
    {
        return true;
    }

    private function canEdit(Hotel $hotel, User $user): bool
    {
        return $hotel->getEditor() === $user || $hotel->getOwner() === $user;
    }

    private function canNew(Hotel $hotel, User $user): bool
    {
        return !$user->getHotels()->isEmpty();
    }

    private function canDelete(Hotel $hotel, User $user): bool
    {
        return $hotel->getEditor() === $user || $hotel->getOwner() === $user;
    }
}