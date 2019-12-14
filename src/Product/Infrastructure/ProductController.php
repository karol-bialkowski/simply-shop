<?php

declare(strict_types=1);

namespace App\Product\Infrastructure;

use App\Product\Application\Command\CreateNewProduct;
use App\Product\Domain\Exception\ProductException;
use App\Product\Domain\Form\CreateNewProductForm;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends BaseController
{

    public function index(PaginatorInterface $paginator, Request $request)
    {
        $products = $this->productQuery->getAll();

        return $this->render('@main\Product\listing.html.twig', [
            'products' => $paginator->paginate(
                $products, $request->query->getInt('page', 1), 10)
        ]);
    }

    /**
     * @return Response
     */
    public function insert(): Response
    {
        //TODO: move this url to CreateNewProductForm, inject as service
        $createNewProductUrl = $this->generateUrl('create_product');
        $form = (new CreateNewProductForm($createNewProductUrl))->form();

        return $this->render('@main\Product\insert.html.twig', ['form' => $form->createView()]);
    }

    public function store(Request $request)
    {

        //TODO: move this to middleware or verify by $form
        $submittedToken = $request->request->get('token');
        if (!$this->isCsrfTokenValid('createProduct', $submittedToken)) {
            return new Response('Access denied!', 403);
        }

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