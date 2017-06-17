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
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ReferenceController
 * @package AppBundle\Controller
 * @Route(path="/references")
 */
class ReferenceController extends Controller
{
    /**
     * @Route(".{_format}", name="list", defaults={"_format": "html"}, requirements={"format": "html|yml|yaml"})
     */
    public function listAction(Request $request)
    {
        $format = $request->get("_format");
        switch ($format) {
            case 'yml':
            case 'yaml':
                $referenceManager = $this->get('doctrine.orm.entity_manager')
                    ->getRepository('AppBundle:Reference');
                $yml = $referenceManager->dumpYAML();

                return new Response(
                    $yml,
                    Response::HTTP_OK,
                    ['Content-Type' => 'application/yaml']
                );
                break;
            default:
                $referenceManager = $this->get('doctrine.orm.entity_manager')
                    ->getRepository('AppBundle:Reference');
                $references = $referenceManager->findAll();

                return $this->render(
                    ':reference:list.html.twig',
                    [
                        'references' => $references,
                    ]
                );
        }
    }

    /**
     * @Route("/{id}.{_format}", name="show", defaults={"_format": "html"}, requirements={"format": "html|yml|yaml|md"})
     */
    public function showAction(Request $request, $id)
    {
        $referenceManager = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Reference');
        $reference = $referenceManager->find($id);

        if (!$reference) {
            throw $this->createNotFoundException();
        }

        $format = $request->get("_format");
        switch ($format) {
            case 'yml':
            case 'yaml':
                $yaml = $referenceManager->serialize([$reference], 'yaml');

                return new Response(
                    $yaml,
                    Response::HTTP_OK,
                    ['Content-Type' => 'application/yaml']
                );
                break;
            default:
                return $this->render(
                    ':reference:show.html.twig',
                    [
                        'reference' => $reference,
                    ]
                );
        }
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
        $form = $this->createForm(
            ReferenceType::class,
            $reference,
            ['method' => 'PUT']
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $referenceManager = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Reference');
            $referenceManager->persist($reference);

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
        $id = rawurldecode($id);
        $referenceManager = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Reference');
        $reference = $referenceManager->find($id);
        $form = $this->createForm(
            ReferenceType::class,
            $reference,
            ['method' => 'PATCH']
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $referenceManager->persist($reference);

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
        $id = rawurldecode($id);
        $referenceManager = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Reference');
        $reference = $referenceManager->find($id);

        if (!$reference) {
            throw $this->createNotFoundException();
        }
        $referenceManager->remove($reference);

        $response = [
            'status' => 'ok',
            'redirect' => $this->generateUrl('list'),
        ];

        return new JsonResponse($response);
    }
}
