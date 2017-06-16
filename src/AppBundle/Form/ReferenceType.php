<?php

namespace AppBundle\Form;

use AppBundle\Entity\Reference;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 14/06/2017
 * Time: 12:28
 */
class ReferenceType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, ['choices' => $this->getTypeChoices()])
            ->add('id')
            ->add('authority')
            ->add('section')
            ->add('issued', DateType::class)
            ->add('title')
            ->add('titleShort')
            ->add('number')
            ->add('ECLI', null, ['label' => 'ECLI'])
            ->add('URL', UrlType::class, ['label' => 'URL', 'required' => false])
            ->add('comments')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Reference',
        ));
    }

    protected function getTypeChoices()
    {
        return array_combine(Reference::getTypeChoices(), Reference::getTypeChoices());
    }

}