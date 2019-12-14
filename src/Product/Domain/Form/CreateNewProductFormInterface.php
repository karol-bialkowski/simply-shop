<?php

namespace App\Product\Domain\Form;

use Symfony\Component\Form\FormInterface;

interface CreateNewProductFormInterface
{
    public function form(): FormInterface;
}