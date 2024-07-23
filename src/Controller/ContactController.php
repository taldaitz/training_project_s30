<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact/generate', name: 'app_contact_generate')]
    public function generate(EntityManagerInterface $entityManager): Response
    {
        
        $contact1 = new Contact();
        $contact1->setFirstname('Thomas');
        $contact1->setLastname('Aldaitz');
        $contact1->setEmail('taldaitz@dawan.fr');
        $contact1->setDateOfBirth( new DateTime('1985-04-28'));

        $contact2 = new Contact();
        $contact2->setFirstname('Robert')
            ->setLastname('Du Test')
            ->setEmail('rdutest@gmail.com')
            ->setDateOfBirth( new DateTime());

        $contact3 = new Contact();
        $contact3
            ->setFirstname('Jean')
            ->setLastname('Retest')
            ->setEmail('jretest@gmail.com')
            ->setDateOfBirth( new DateTime());


        $entityManager->persist($contact1);
        $entityManager->persist($contact2);
        $entityManager->persist($contact3);

        //$entityManager->flush();

        return new Response('OK');
    }

    #[Route('/contact/list', name: 'app_contact_list')]
    public function listContact(ContactRepository $contactRepository) : Response
    {
        $contacts = $contactRepository->findAll();

        $result = '<ul>';
        foreach($contacts as $contact) {
            $result .= '<li>' . $contact->getFirstname() . ' ' . $contact->getLastname() . '</li>';
        }
        $result .= '</ul>';

        return new Response($result);
    }
}
