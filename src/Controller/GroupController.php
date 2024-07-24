<?php

namespace App\Controller;

use App\Entity\Group;
use App\Form\GroupType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GroupController extends AbstractController
{
    #[Route('/group/new', name: 'app_group_new')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $group = new Group();

        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $group = $form->getData();

            $entityManager->persist($group);
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_list');

        }

        return $this->render('group/new.html.twig', [
            'form' => $form
        ]);
    }
}
