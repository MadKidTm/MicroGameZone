<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\Jeu;
use App\Entity\Developpeur;
use App\Entity\Editeur;
use App\Form\EditeurType;
use App\Form\DeveloppeurType;

class JeuType extends AbstractType {


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prix')
            ->add('description')
            ->add('image')
            ->add('titre')
            ->add('editeur', EditeurType::class)
            ->add('developpeur', DeveloppeurType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Jeu::class
        ));
    }
}
?>