<?php

namespace App\Controller;

use App\Entity\Commande;
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
class CommandeController extends FOSRestController
{
    /**
     *Lists all Commandes.
     *@Rest\Get("/commandes")
     **@return JsonResponse
     */
    public function getCommandesAction(){
        $repository = $this->getDoctrine()->getRepository(Commande::class);
        $commandes = $repository->findall();

        return $this->handleView($this->view($commandes));
    }
}
