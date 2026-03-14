<?php

namespace App\Form;

use App\Entity\Module;
use App\Repository\ModuleRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use function PHPSTORM_META\type;

class ModuleFormType extends AbstractType
{
    private array $modules;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $modules = $moduleRepository->findAll();
        foreach ($modules as $module) {
            $this->modules[$module->getName()] = $module->getId();
        }
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Module Name',
                'attr' => [
                    'placeholder' => 'Enter module name',
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'row mb-3',
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Enter module description',
                    'class' => 'form-control',
                ],
            ])
            ->add('url', TextType::class, [
                'label' => 'URL',
                'attr' => [
                    'placeholder' => 'Enter module URL',
                    'class' => 'form-control',
                ],
            ])
            ->add('label', TextType::class, [
                'label' => 'Label',
                'attr' => [
                    'placeholder' => 'Enter module label',
                    'class' => 'form-control',
                ],
            ])
            ->add('class', TextType::class, [
                'label' => 'Icon Class',
                'attr' => [
                    'placeholder' => 'Enter module class',
                    'class' => 'form-control',
                ],
            ])
            ->add('menuid', EntityType::class, [
                'label' => 'Related Menu',
                'attr' => [
                    'placeholder' => 'Enter related menu',
                    'class' => 'form-control',
                ],
                'class' => Module::class,
                'choice_label' => 'label',
                'query_builder' => function (ModuleRepository $repo) {
                    return $repo->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'multiple' => false,
                'expanded' => false,
                'required' => false,
                'placeholder' => 'Enter related menu',
            ])
            ->add('menuorder', IntegerType::class, [
                'label' => 'Order',
                'attr' => [
                    'title' => 'Order of the module in the menu',
                    'class' => 'form-control',
                ],
                'help' => 'Enter the order of the module in the menu',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save',
                'attr' => [
                    'class' => 'btn btn-primary mt-3',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Module::class,
        ]);
    }
}
