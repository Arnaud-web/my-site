<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\PostEmploi;
use App\Form\PostEmploiType;
use App\Repository\PostEmploiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post-emploi')]
class PostEmploiController extends AbstractController
{
    #[Route('/{slug}/admin', name: 'post_emploi_index', methods: ['GET'])]
    public function index(PostEmploiRepository $postEmploiRepository, Article $article): Response
    {

        $post = $postEmploiRepository->findBy(['article'=>$article->getId()]);
        return $this->render('post_emploi/index.html.twig', [
            'post_emplois' => $post,
            'article'=>$article,
        ]);
    }

    #[Route('/{slug}/new', name: 'post_emploi_new', methods: ['GET', 'POST'])]
    public function new(Request $request,Article $article): Response
    {
        $postEmploi = new PostEmploi();
        $form = $this->createForm(PostEmploiType::class, $postEmploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $postEmploi->setPostAt(new \DateTime());
            $postEmploi->setArticle($article);
            $postEmploi->setUserPost($this->getUser());
            $entityManager->persist($postEmploi);
            $entityManager->flush();

            return $this->redirectToRoute('article_show', ['slug'=>$article->getSlug()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post_emploi/new.html.twig', [
            'post_emploi' => $postEmploi,
            'article'=>$article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'post_emploi_show', methods: ['GET'])]
    public function show(PostEmploi $postEmploi): Response
    {
        return $this->render('post_emploi/show.html.twig', [
            'post_emploi' => $postEmploi,
        ]);
    }

    #[Route('/{id}/edit', name: 'post_emploi_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PostEmploi $postEmploi): Response
    {
        $form = $this->createForm(PostEmploiType::class, $postEmploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_emploi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post_emploi/edit.html.twig', [
            'post_emploi' => $postEmploi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'post_emploi_delete', methods: ['POST'])]
    public function delete(Request $request, PostEmploi $postEmploi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$postEmploi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($postEmploi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post_emploi_index', [], Response::HTTP_SEE_OTHER);
    }
}
