<?php


namespace App\Product\Infrastructure;

use App\Product\Application\Query\ProductQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

abstract class BaseController extends AbstractController
{
    use HandleTrait;

    /**
     * @var ProductQuery
     */
    public $productQuery;

    public function __construct(MessageBusInterface $messageBus, ProductQuery $productQuery)
    {
        $this->messageBus = $messageBus;
        $this->productQuery = $productQuery;
    }

    /**
     * @param object $message
     * @return mixed
     */
    public function handleMessage(object $message)
    {
        return $this->handle($message);
    }

}