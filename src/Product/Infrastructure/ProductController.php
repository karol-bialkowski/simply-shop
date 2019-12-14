<?php

declare(strict_types=1);

namespace App\Product\Infrastructure;

use App\Product\Application\Command\CreateNewProduct;
use App\Product\Domain\Exception\ProductException;
use App\Product\Domain\Form\CreateNewProductForm;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends BaseController
{

    /**
     * @return Response
     */
    public function index(): Response
    {

        //TODO: move this url to CreateNewProductForm, inject as service
        $createNewProductUrl = $this->generateUrl('create_product');
        $form = (new CreateNewProductForm($createNewProductUrl))->form();

        return $this->render('@main\Product\insert.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        try {

            $requestFormData = $request->request->get('form');
            $command = new CreateNewProduct(
                $requestFormData['name'], $requestFormData['description'], 100
            );
            $this->handleMessage($command);
            $this->addFlash('success', 'Product created.');
        } catch (ProductException $exception) {
            $this->addFlash('danger', $exception->getMessage());
        } catch (\Exception $exception) {
            $this->addFlash('danger', 'Oops. This looks like a bug or feature. Send request to our support.');
        }

        return $this->redirectToRoute('new_product');
    }

}