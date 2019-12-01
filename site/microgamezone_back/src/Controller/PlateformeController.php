<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Developpeur;
use App\Entity\Jeu;
use App\Entity\Plateforme;
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
class PlateformeController extends FOSRestController
{
    /**
     *Lists all Plateformes.
     *@Rest\Get("/plateformes")
     **@return Response
     */
    public function getPlateformesAction(){
        $repository = $this->getDoctrine()->getRepository(Plateforme::class);
        $plateformes = $repository->findall();

        return $this->handleView($this->view($plateformes));
    }

    /**
     *Lists all Plateformes for a game.
     *@Rest\Get("/plateformes/{idJeu}")
     **@return Response
     */
    public function getPlatefromesForGame($idJeu){
        $plateformeRepository = $this->getDoctrine()->getRepository(Plateforme::class);
        $jeuRepository = $this->getDoctrine()->getRepository(Jeu::class);

        $jeu = $jeuRepository->findBy(array('id' => $idJeu));

        var_dump($jeu);die;

        $plateformes = $plateformeRepository->findBy(array('idJeu' => $jeu));

        return $this->handleView($this->view($plateformes));
    }
}
