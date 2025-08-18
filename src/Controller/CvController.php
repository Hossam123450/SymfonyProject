<?php
// src/Controller/CvController.php
namespace App\Controller;

use App\Entity\Cv;
use App\Form\CvType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CvController extends AbstractController
{
    #[Route('/cv/create', name: 'cv_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $cv = new Cv();
        $form = $this->createForm(CvType::class, $cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
    $cvFile = $form->get('cvFile')->getData();

    if ($cvFile) {
    $newFilename = uniqid().'.'.$cvFile->guessExtension();
    dump($cvFile->getClientOriginalName(), $newFilename); // <-- debug
    try {
        $cvFile->move($this->getParameter('cv_directory'), $newFilename);
    } catch (FileException $e) {
        dump($e->getMessage()); // <-- debug si erreur
    }
    $cv->setCvFile($newFilename);
}


    dump($cv); // <--- vérifier ici
    $em->persist($cv);
    $em->flush();

    $this->addFlash('success', 'Votre CV a été envoyé avec succès !');
    return $this->redirectToRoute('home');
}


        return $this->render('cv/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
