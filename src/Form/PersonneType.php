<?php

namespace App\Form;

use App\Entity\Personne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           //->add('prenom')
            //->add('prenom',null,[ 'attr'=>['placeholder'=>'Prénom','data-test'=>'toto']])
            ->add('prenom',null,[ 'attr'=>['placeholder'=>'Prénom']])
            //->add('nom',null,[ 'attr'=>['placeholder'=>'Nom'],  'mapped' => false])
            ->add('nom',null,[
                'label'=>'Votre Nom',
                'attr'=>['placeholder'=>'Nom']])
            //->add('venir')
            // <select value="id"><option>choice_label</option></select>
            ->add('categ',null,[ 
                'label'=>'Type',
                'choice_label'=> 'title',
                ])
           

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}
