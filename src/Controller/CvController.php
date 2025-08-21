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
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CvController extends AbstractController
{
    #[Route('/cv/create', name: 'cv_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cv = new Cv();
        $form = $this->createForm(CvType::class, $cv);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
    /** @var UploadedFile $cvFile */
    $cvFile = $form->get('cvFile')->getData();
    if ($cvFile) {
        $newFilename = uniqid().'.'.$cvFile->guessExtension();
        $cvFile->move($this->getParameter('cv_directory'), $newFilename);
        $cv->setCvFile($newFilename);
    }

    $entityManager->persist($cv);
    $entityManager->flush();

    $this->addFlash('success', 'CV créé avec succès !');

    // IMPORTANT : utiliser HTTP_SEE_OTHER pour Turbo
    return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
}else {
        // Turbo attend HTML => renvoyer le form avec code 422
        return $this->render('cv/create.html.twig', [
            'form' => $form->createView(),
        ], new Response('', 422));
    }

    }
}
