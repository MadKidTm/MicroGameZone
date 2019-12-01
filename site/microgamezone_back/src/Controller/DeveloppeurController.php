<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Developpeur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Annotation\Route;



/**
 * Class GameController
 * @package App\Controller
 * @Route("/api", name="api_")
 */
class DeveloppeurController extends FOSRestController
{
    /**
     *Lists all Developpeurs.
     *@Rest\Get("/developpeurs")
     **@return JsonResponse
     */
    public function getDeveloppeursAction(){
        $repository = $this->getDoctrine()->getRepository(Developpeur::class);
        $developpeur = $repository->findall();

        return $this->handleView($this->view($developpeur));
    }

    /**
     *Lists all Developpeurs.
     *@Rest\Get("/developpeurs/{id}")
     **@return JsonResponse
     */
    public function getDeveloppeurAction($id){
        $repository = $this->getDoctrine()->getRepository(Developpeur::class);
        $developpeur = $repository->find($id);

        return $this->handleView($this->view($developpeur));
    }

}
