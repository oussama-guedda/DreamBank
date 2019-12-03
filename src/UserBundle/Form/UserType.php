<?php
namespace UserBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('email', EmailType::class, ['attr'=>array('class'=>'form-control')])
            ->add('password', PasswordType::class, ['attr'=>array('class'=>'form-control')])
            ->add('username', TextType::class, ['attr'=>array('class'=>'form-control')])
            ->add('lastName', TextType::class, ['attr'=>array('class'=>'form-control')])
            ->add('phone', NumberType::class, ['attr'=>array('class'=>'form-control')])
            ->add('adresse', TextType::class, ['attr'=>array('class'=>'form-control')]);
      }
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array('data_class' => 'AppBundle\Entity\User',));
    }
}
