<?php


namespace App\Product\Infrastructure;


use App\Product\Application\Command\CreateNewProduct;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends BaseController
{

    public function index()
    {

        $command = new CreateNewProduct('Ksiazka');
        $this->handleMessage($command);

//        $second_command = $this->productQuery->getById(2);
//
//        echo '##'.$second_command->name().'##';

        return new Response('Produkt');
    }

}