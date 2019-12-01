<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Developpeur;
use App\Entity\Genre;
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
class GenreController extends FOSRestController
{
    /**
     *Lists all Genres.
     *@Rest\Get("/genres")
     **@return JsonResponse
     */
    public function getCommandesAction(){
        $repository = $this->getDoctrine()->getRepository(Genre::class);
        $genre = $repository->findall();

        return $this->handleView($this->view($genre));
    }
}
