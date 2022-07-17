<?php

namespace App\Form;

use App\Entity\Hotel;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'forms.hotel.name'])
            ->add('address', TextType::class, ['label' => 'forms.hotel.address'])
            ->add('grade', NumberType::class, ['label' => 'forms.hotel.grade'])
            ->add('numberOfRooms', NumberType::class, ['label' => 'forms.hotel.number'])
            ->add('phoneNumber', TextType::class, ['label' => 'forms.hotel.phone'])
            ->add('capacity', NumberType::class, ['label' => 'forms.hotel.capacity']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
        ]);
    }
}
