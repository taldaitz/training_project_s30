<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    #[Route('/toto', name: 'home_toto')]
    public function toto() : Response
    {
        return new Response('<h1>toto est un test</h1>');
    }

    #[Route('/bonjour/{number}', name: 'home_bonjour_number', requirements: ['number' => '\d+'])]
    public function sayHelloNumber(int $number) : Response
    {
        $message = '';

        for ($i=0; $i < $number; $i++) { 
            $message .= '<h1>Bonjour !</h1>';
        }
        
        return new Response($message);
    }

    #[Route('/bonjour/{name}', name: 'home_bonjour')]
    public function sayHello(string $name) : Response
    {
        return new Response("<h1>Bonjour $name!</h1>");
    }

    #[Route('/bonjour/{firstname}/{lastname}', name: 'home_bonjour_complet')]
    public function sayCompleteHello(string $firstname, string $lastname) : Response
    {
        return new Response("<h1>Bonjour $firstname $lastname!</h1>");
    }

    
}
