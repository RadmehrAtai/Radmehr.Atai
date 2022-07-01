<?php

namespace App\Controller\Admin;

use App\Entity\Room;
use Doctrine\DBAL\Types\TextType;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\This;

class RoomCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Room::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            BooleanField::new('isEmpty'),
            AssociationField::new("hotel"),
            IdField::new('id')->hideOnForm(),
            TextField::new('roomType'),
            IntegerField::new('floorNumber'),
            IntegerField::new('roomNumber'),
            IntegerField::new('NumberOfBeds')
        ];
    }
}
