<?php


namespace App\MainController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    public function index()
    {


        echo 'aaa111';
        exit;

        return $this->render('@main/homepage.html.twig');
    }

}