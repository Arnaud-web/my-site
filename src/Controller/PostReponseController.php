<?php

namespace App\Controller;

use App\Entity\PostEmploi;
use App\Entity\PostReponse;
use App\Form\PostReponseType;
use App\Repository\PostReponseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post-reponse')]
class PostReponseController extends AbstractController
{
    #[Route('/', name: 'post_reponse_index', methods: ['GET'])]
    public function index(PostReponseRepository $postReponseRepository): Response
    {
        return $this->render('post_reponse/index.html.twig', [
            'post_reponses' => $postReponseRepository->findAll(),
        ]);
    }

    #[Route('/{id}/new', name: 'post_reponse_new', methods: ['GET', 'POST'])]
    public function new(Request $request,PostEmploi $postEmploi): Response
    {
        $postReponse = new PostReponse();
        $test = $postEmploi->getPostReponse();
        if(isset($test)){
            $postReponse = $postEmploi->getPostReponse();
        }
        $form = $this->createForm(PostReponseType::class, $postReponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postReponse->setPost($postEmploi);
            $postReponse->setCreatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($postReponse);
            $entityManager->flush();

            return $this->redirectToRoute('post_emploi_index', ['slug'=>$postEmploi->getArticle()->getSlug()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post_reponse/new.html.twig', [
            'post_reponse' => $postReponse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'post_reponse_show', methods: ['GET'])]
    public function show(PostReponse $postReponse): Response
    {
        return $this->render('post_reponse/show.html.twig', [
            'post_reponse' => $postReponse,
        ]);
    }

    #[Route('/{id}/edit', name: 'post_reponse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PostReponse $postReponse): Response
    {
        $form = $this->createForm(PostReponseType::class, $postReponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_reponse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post_reponse/edit.html.twig', [
            'post_reponse' => $postReponse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'post_reponse_delete', methods: ['POST'])]
    public function delete(Request $request, PostReponse $postReponse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$postReponse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($postReponse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post_reponse_index', [], Response::HTTP_SEE_OTHER);
    }
}
