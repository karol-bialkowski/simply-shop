<?php

declare(strict_types=1);

namespace App\Product\Domain;

class Mail
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
        $this->recipment = $recipment;
        $this->topic = $topic;
        $this->content = $content;
    }
}