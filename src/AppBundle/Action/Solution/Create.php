<?php

namespace AppBundle\Action\Solution;

use AppBundle\Entity\Solution;
use AppBundle\Form\SolutionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Créer une solution
 */
class Create extends Controller
{

    public function action(Request $request)
    {
        $solution = new Solution();
        $form = $this->createForm(SolutionType::class, $solution);
        $form->submit(array_merge(
            $request->request->all(),
            $request->files->all()
        ));

        if ($form->isValid() && $form->isSubmitted()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($solution);
            $em->flush();

            return new JsonResponse([
                '@id' => '/solutions/' . $solution->getId(),
            ]);
        } else {
           return new JsonResponse($form->getErrors());
        }
    }
}