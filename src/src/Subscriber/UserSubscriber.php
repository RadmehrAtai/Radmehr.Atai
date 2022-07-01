<?php

namespace App\Subscriber;

use App\Entity\User;
use App\Model\UserInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserSubscriber implements EventSubscriber
{
    /** @var TokenStorageInterface */
    private $tokenStorage;

    /**
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof UserInterface) {
            $token = $this->tokenStorage->getToken();
            if ($token instanceof TokenInterface) {
                /** @var User $user */
                $user = $token->getUser()->getUserIdentifier();

                $entity->setCreatedUser($user);
                $entity->setUpdatedUser($user);
            }
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof UserInterface) {
            $token = $this->tokenStorage->getToken();
            if ($token instanceof TokenInterface) {
                /** @var User $user */
                $user = $token->getUser()->getUserIdentifier();

                $entity->setUpdatedUser($user);
            }
        }
    }
}