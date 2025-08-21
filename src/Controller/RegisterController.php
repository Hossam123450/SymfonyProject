<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
    // Hash le mot de passe
    $user->setPassword(
        $passwordHasher->hashPassword($user, $form->get('password')->getData())
    );

    $em->persist($user);
    $em->flush();

    $this->addFlash('success', 'Compte créé avec succès !');

    return $this->redirectToRoute('app_login');
}

return $this->render('register/index.html.twig', [
    'form' => $form->createView(),
]);

    }
}
