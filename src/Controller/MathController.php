<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MathController extends AbstractController
{
    
    #[Route('addition/{firstNumber}/{secondNumber}', 
            name:'math_addition', 
            requirements: [
                            'firstNumber' => '\d+',
                            'secondNumber' => '\d+',
                        ]
            )]
    public function sum(int $firstNumber, int $secondNumber) : Response
    {
        return new Response($firstNumber + $secondNumber);
    }


    #[Route('multiplication/{firstNumber}/{secondNumber}', 
            name:'math_multiplication', 
            requirements: [
                            'firstNumber' => '\d+',
                            'secondNumber' => '\d+',
                        ]
            )]
    public function multiply(int $firstNumber, int $secondNumber) : Response
    {
        $result = $firstNumber * $secondNumber;
        return new Response($result);
    }


    #[Route('operation/{firstNumber}/{operator}/{secondNumber}', 
            name:'math_operation', 
            requirements: [
                            'firstNumber' => '\d+',
                            'operator' => '[+x]',
                            'secondNumber' => '\d+',
                        ]
            )]
    public function operation(int $firstNumber, string $operator, int $secondNumber) : Response
    {
        /* 1er solution
        $result = 0;

        if($operator == '+') $result = $firstNumber + $secondNumber;
        if($operator == 'x') $result = $firstNumber * $secondNumber;

        return new Response($result);*/

        //2eme solution - les redirections 
        
        if($operator == '+') return $this->redirectToRoute('math_addition', ['firstNumber' => $firstNumber, 'secondNumber' => $secondNumber]);
        if($operator == 'x') return $this->redirectToRoute('math_multiplication', ['firstNumber' => $firstNumber, 'secondNumber' => $secondNumber]);
    }

}
