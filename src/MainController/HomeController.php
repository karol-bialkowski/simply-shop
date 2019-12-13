<?php


namespace App\MainController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    public function index()
    {
        return $this->render('@main/homepage.html.twig');
    }

}