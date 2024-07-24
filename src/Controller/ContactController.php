<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Group;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact/generate', name: 'app_contact_generate')]
    public function generate(EntityManagerInterface $entityManager): Response
    {
        $groupFamily = new Group();
        $groupFamily->setName("Famille")->setCreationDate(new DateTime());

        $groupFriend = new Group();
        $groupFriend->setName('Amis')->setCreationDate(new DateTime());
        
        $contact1 = new Contact();
        $contact1->setFirstname('Thomas');
        $contact1->setLastname('Aldaitz');
        $contact1->setEmail('taldaitz@dawan.fr');
        $contact1->setDateOfBirth( new DateTime('1985-04-28'));

        $contact2 = new Contact();
        $contact2->setFirstname('Robert')
            ->setLastname('Du Test')
            ->setEmail('rdutest@gmail.com')
            ->setDateOfBirth( new DateTime())
        ;

        $contact3 = new Contact();
        $contact3
            ->setFirstname('Jean')
            ->setLastname('Retest')
            ->setEmail('jretest@gmail.com')
            ->setDateOfBirth( new DateTime())
        ;


        $groupFamily->addMember($contact1);
        $groupFriend->addMember($contact2);
        $groupFriend->addMember($contact3);


        $entityManager->persist($groupFamily);
        $entityManager->persist($groupFriend);

        $entityManager->persist($contact1);
        $entityManager->persist($contact2);
        $entityManager->persist($contact3);

        $entityManager->flush();

        return new Response('OK');
    }

    #[Route('/contact/list', name: 'app_contact_list')]
    public function listContact(ContactRepository $contactRepository) : Response
    {
        $contacts = $contactRepository->findAll();

        return $this->render('contact/list.html.twig', [
            'contacts' => $contacts
        ]);
    }

    #[Route('/contact/new', name: 'app_contact_new')]
    public function create(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_list');
        }

        return $this->render('contact/new.html.twig', [
            'form' => $form
        ]);
    }
}
