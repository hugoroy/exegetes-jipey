<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Reference;
use AppBundle\Form\ReferenceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ReferenceController extends Controller
{
    /**
     * @Route("/", name="list")
     */
    public function listAction()
    {
        $referenceManager = $this->get('app.manager.reference');
        $references       = $referenceManager->findAll();

        return $this->render(
            ':reference:list.html.twig',
            [
                'references' => $references,
            ]
        );
    }

    /**
     * @Route("/create", name="create", methods={"GET", "PUT"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $reference = new Reference();
        $form      = $this->createForm(ReferenceType::class, $reference, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $referenceManager = $this->get('app.manager.reference');
            $referenceManager->persist($reference);
            $referenceManager->flush();

            return new RedirectResponse($this->generateUrl('list'));
        }

        return $this->render(
            ':reference:create.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "PATCH"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id)
    {
        $id               = rawurldecode($id);
        $referenceManager = $this->get('app.manager.reference');
        $reference        = $referenceManager->find($id);
        $form             = $this->createForm(ReferenceType::class, $reference, ['method' => 'PATCH']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $referenceManager->persist($reference);
            $referenceManager->flush();

            return new RedirectResponse($this->generateUrl('list'));
        }

        return $this->render(
            ':reference:edit.html.twig',
            [
                'reference' => $reference,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="delete")
     * @Method("DELETE")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($id)
    {
        $id               = rawurldecode($id);
        $referenceManager = $this->get('app.manager.reference');
        $reference        = $referenceManager->find($id);

        if ( ! $reference) {
            throw $this->createNotFoundException();
        }
        $referenceManager->remove($reference);
        $referenceManager->flush();

        $response = ['status' => 'ok', 'redirect' => $this->generateUrl('list')];

        return new JsonResponse($response);
    }
}
