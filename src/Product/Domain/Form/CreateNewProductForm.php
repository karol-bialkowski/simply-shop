<?php

declare(strict_types=1);

namespace App\Product\Domain\Form;

use App\Product\Domain\Form\DataTransformer\ProductPriceDataTransformer;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

//TODO: extend interface
class CreateNewProductForm implements CreateNewProductFormInterface
{
    /**
     * @var FormFactoryInterface
     */
    private FormFactoryInterface $formFactory;
    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;
    /**
     * @var string
     */
    private string $action_url;

    public function __construct(string $action_url)
    {
        //TODO: remove this after moved csrf verification to middleware
//        $session = new Session();
//        $csrfGenerator = new UriSafeTokenGenerator();
//        $csrfStorage = new SessionTokenStorage($session);
//        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);

        $this->action_url = $action_url;
        $this->validator = Validation::createValidator();
        $this->formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new HttpFoundationExtension())
//            ->addExtension(new CsrfExtension($csrfManager)) //TODO: as below
            ->addExtension(new ValidatorExtension($this->validator))
            ->getFormFactory();
    }

    /**
     * @return FormInterface
     */
    public function form(): FormInterface
    {
        $form = $this->formFactory->createBuilder(FormType::class, null, [
            'action' => $this->action_url,
            'method' => 'POST',
            'attr' => ['id' => 'CreateNewProductForm']
        ])
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 1, 'max' => 2])
                ]
            ])
            ->add('description', TextType::class)
            ->add('price', TextType::class);

        $form->get('price')
            ->addModelTransformer(new ProductPriceDataTransformer());

        return $form->getForm();
    }

}