<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Reference;
use AppBundle\Form\ReferenceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $reference = new Reference();
        $form = $this->createForm(ReferenceType::class, $reference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($reference);

            $reference = new Reference();
            $form = $this->createForm(ReferenceType::class, $reference);
        }
        $referenceManager = $this->get('app.manager.reference');
        $references = $referenceManager->findAll();

        return $this->render(
            'default/index.html.twig',
            [
                'references' => $references,
                'form' => $form->createView(),
            ]
        );
    }
}
