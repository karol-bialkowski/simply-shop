<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\API;

use Symfony\Component\HttpFoundation\JsonResponse;

//TODO: create interface
class ApiJsonResponse
{

    /**
     * @var bool
     */
    private $status;
    /**
     * @var string
     */
    private ?string $message;
    /**
     * @var int
     */
    private int $httpCode;

    public function __construct(bool $status = true, int $httpCode = 200, string $message = null)
    {
        $this->status = $status;
        $this->httpCode = $httpCode;
        $this->message = $message;
    }

    public function response(): JsonResponse
    {
        return JsonResponse::create([
            'status' => $this->status,
            'message' => $this->message
        ], $this->httpCode);
    }

}