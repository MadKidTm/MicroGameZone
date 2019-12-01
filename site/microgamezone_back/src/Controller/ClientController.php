<?php

namespace App\Controller;

use App\Entity\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Class GameController
 * @package App\Controller
 * @Route("/api", name="api_")
 */
class ClientController extends FOSRestController
{
    /**
     *Lists all Games.
     *@Rest\Get("/clients")
     **@return JsonResponse
     */
    public function getClientsAction(){
        $repository = $this->getDoctrine()->getRepository(Client::class);
        $clients = $repository->findall();

        return $this->handleView($this->view($clients));
    }

}
