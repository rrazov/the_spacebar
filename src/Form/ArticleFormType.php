<?php
/**
 * Created by PhpStorm.
 * User: razov
 * Date: 04.05.19.
 * Time: 11:58
 */

namespace App\Form;


use App\Entity\Article;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('content')
            ->add('publishedAt', null, [
            'widget' => 'single_text'
            ])
            ->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => function(User $user) {
                    return sprintf('(%d) %s', $user->getId(), $user->getEmail());
                },
                'placeholder' => 'Choose an author',
                'choices' => $this->userRepository->findAllEmailAlphabetical(),

            ])



    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class
        ]);
    }


}