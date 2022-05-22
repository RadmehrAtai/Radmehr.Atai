<?php

namespace App\Menu;

use App\Entity\Hotel;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class Builder
{

    private FactoryInterface $factory;
    private EntityManagerInterface $entityManager;

    public function __construct(FactoryInterface $factory, EntityManagerInterface $entityManager)
    {
        $this->factory = $factory;
        $this->entityManager = $entityManager;
    }

    public function mainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', ['route' => 'app_home_index']);

        // create another menu item
        $menu->addChild('About', ['route' => 'app_about_index']);

        // create another menu item
        $menu->addChild('Support', ['route' => 'app_support_index']);

        $hotelsMenu = $menu->addChild('Hotels', ['route' => 'app_hotel_index']);

        /** @var hotel[] $hotels */
        $hotels = $this->entityManager->getRepository(Hotel::class)->findAll();

        foreach ($hotels as $hotel) {
            $hotelsMenu->addChild($hotel->getName(), [
                'route' => 'app_hotel_show',
                'routeParameters' => ['id' => $hotel->getId()]
            ]);
        }

        return $menu;
    }

}