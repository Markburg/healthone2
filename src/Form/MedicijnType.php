<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicijnType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
        $builder
            ->add('naam', TextType::class)
            ->add('type', TextType::class)
            ->add('bijwerking', TextType::class)
            ->add('verzekerd', ChoiceType::class,[
                'choices'=>[
                    'Ja'=>'Ja',
                    'Nee'=>'Nee'
                    ]
                ])
            ->add('submit',SubmitType::class);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Medicijn'
        ]);
    }

}