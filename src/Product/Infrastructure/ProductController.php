<?php

declare(strict_types=1);

namespace App\Product\Infrastructure;

use App\Product\Application\Command\CreateNewProduct;
use App\Product\Domain\Exception\ProductException;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends BaseController
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        try {
            $command = new CreateNewProduct(
                'Ksiazka', 'taki fajny hgsdasdasd
                asdasdasdasasasasasasasasasasasasaasdasdasdasdasdasdasdasdasd
                sdasddfsdfsdfsdfsdfsdasdopis', 100
            );
        } catch (ProductException $exception) {

            return JsonResponse::create([
                'status' => false,
                'message' => $exception->getMessage()
            ], 400);

        } catch (\Exception $exception) {
            return JsonResponse::create([
                'status' => false,
                'message' => 'Oops. This looks like a bug or feature. Send request to our support.'
            ], 400);
        }

        //TODO: refactor JsonResponse to different class, DRY

        $this->handleMessage($command);

//        $second_command = $this->productQuery->getById(2);
//        echo '##'.$second_command->name().'##';

        return JsonResponse::create([
            'status' => true,
        ], 200);
    }

}