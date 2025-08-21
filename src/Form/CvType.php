<?php

namespace App\Form;

use App\Entity\Cv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // Ligne 1: Téléphone + Date de naissance
            ->add('phone', TextType::class, ['label' => 'Téléphone'])
            ->add('birthDate', DateType::class, [
    'widget' => 'single_text',
    'html5' => true,
    'format' => 'yyyy-MM-dd',
    'label' => 'Date de naissance',
])



            // Ligne 2: Sexe
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme'
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Sexe'
            ])
            // Ligne 3: Domaine
            ->add('domain', ChoiceType::class, [
                'choices' => [
                    'Soins de santé' => 'Soins de santé',
                    'Gastronomie' => 'Gastronomie',
                    'Services de sécurité' => 'Services de sécurité',
                    'Services d\'équipage' => 'Services d\'équipage',
                    'Médiation de talent sportif' => 'Médiation de talent sportif',
                    'Assistance à Domicile' => 'Assistance à Domicile',
                    'Travailleurs Saisonniers' => 'Travailleurs Saisonniers',
                    'Industrie' => 'Industrie',
                    'Qualifications, études, Formation Professionnelle' => 'Qualifications, études, Formation Professionnelle'
                ],
                'label' => 'Domaine'
            ])
            // Ligne 4-6: Adresse, Ville, Pays
            ->add('address', TextType::class, ['label' => 'Adresse'])
            ->add('city', TextType::class, ['label' => 'Ville'])
            ->add('country', TextType::class, ['label' => 'Pays'])
            // Ligne 7: CV upload
            ->add('cvFile', FileType::class, [
    'label' => 'Télécharger CV',
    'mapped' => false,
    'required' => true
])
            ->add('submit', SubmitType::class, [
    'label' => 'Créer CV',
    'attr' => [
        'class' => 'btn-submit-cv',
        'style' => 'background-color: #3e41de; color: #fff; border-radius: 25px;'
    ]
]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cv::class,
        ]);
    }
}
