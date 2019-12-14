<?php

declare(strict_types=1);

namespace App\Product\Application\Command;

use App\Product\Domain\Exception\ProductException;
use App\Product\Domain\Product;

class SendMail
{


    /**
     * @var string
     */
    private string $recipment;
    /**
     * @var string
     */
    private string $topic;
    /**
     * @var string
     */
    private string $content;

    public function __construct(string $recipment, string $topic, string $content)
    {
        //TODO: validation

        $this->recipment = $recipment;
        $this->topic = $topic;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getTopic(): string
    {
        return $this->topic;
    }

    /**
     * @return string
     */
    public function getRecipment(): string
    {
        return $this->recipment;
    }

}