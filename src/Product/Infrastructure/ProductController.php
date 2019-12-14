<?php

declare(strict_types=1);

namespace App\Product\Infrastructure;

use App\Product\Application\Command\CreateNewProduct;
use App\Product\Domain\Exception\ProductException;
use App\Product\Domain\Form\CreateNewProductForm;
use Knp\Component\Pager\PaginatorInterface;
use Money\Currencies\ISOCurrencies;
use Money\Parser\DecimalMoneyParser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends BaseController
{

    /**
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
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

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function store(Request $request)
    {

        //TODO: move this to middleware or verify by $form
        $submittedToken = $request->request->get('token');
        if (!$this->isCsrfTokenValid('createProduct', $submittedToken)) {
            return new Response('Access denied!', 403);
        }

        $requestFormData = $request->request->get('form');
        
        try {

            $currencies = new ISOCurrencies();
            $moneyParser = new DecimalMoneyParser($currencies);
            $money = $moneyParser->parse($requestFormData['price'], 'PLN');
            $command = new CreateNewProduct(
                $requestFormData['name'], $requestFormData['description'], (int)$money->getAmount()
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

    public function product(int $id)
    {
        $product = $this->productQuery->getById($id);
        return $this->render('@main\Product\specific_product.html.twig', [
            'product' => $product
        ]);
    }

}