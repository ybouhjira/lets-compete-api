<?php
namespace AppBundle\Action\Membre;

use AppBundle\Entity\Membre;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Changer la photo de profil d'un membre
 */
class UploadPhoto
{
    public function __construct(EntityManager $em)
    {
        $this->enityManager = $em;
    }

    /**
     * @param Membre $membre le membre à modifier
     * @param Request $request instance requête
     * @return Response
     */
    public function __invoke(Membre $membre, Request $request)
    {
        $membre->setFichierPhoto($request->files->get('photo'));
        $this->enityManager->persist($membre);
        $this->enityManager->flush();

        return new Response();
    }
}