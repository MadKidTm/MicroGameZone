<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Developpeur;
use App\Entity\Editeur;
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
class EditeurController extends FOSRestController
{
    /**
     *Lists all Editeurs.
     *@Rest\Get("/editeurs")
     **@return JsonResponse
     */
    public function getEditeursAction(){
        $repository = $this->getDoctrine()->getRepository(Editeur::class);
        $editeurs = $repository->findall();

        return $this->handleView($this->view($editeurs));
    }

    /**
     *Lists all Editeurs.
     *@Rest\Get("/editeurs/{id}")
     **@return JsonResponse
     */
    public function getEditeurAction($id){
        $repository = $this->getDoctrine()->getRepository(Editeur::class);
        $editeur = $repository->find($id);

        return $this->handleView($this->view($editeur));
    }




}
