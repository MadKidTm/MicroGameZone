<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Jeu;
use App\Entity\Developpeur;
use App\Entity\Editeur;
use App\Form\JeuType;

/**
 * Class GameController
 * @package App\Controller
 * @Route("/api", name="api_")
 */
class GameController extends FOSRestController
{
    /**
     *Lists all Games.
     *@Rest\Get("/games")
     **@return JsonResponse
     */
    public function getGameAction(){
        $repository = $this->getDoctrine()->getRepository(Jeu::class);
        $games = $repository->findall();

        return $this->handleView($this->view($games));

    }

    /**
     * @param Request $request
     * @Rest\Post("/games")
     * @ParamConverter("jeu", converter="fos_rest.request_body")
     */
    public function postGameAction(Request $request, Jeu $jeu) {


        $game = $jeu;
        $form = $this->createForm(JeuType::class, $game);
        $data = json_decode($request->getContent(), true);
        $form->submit($game);

        $em = $this->getDoctrine()->getManager();
        $em->merge($game);
        $em->flush();
        return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));

        /*if($form->isSubmitted() && $form->isValid()){
            var_dump("test");die;
            $em = $this->getDoctrine()->getManager();
            $em->merge($game);
            $em->flush();
            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));*/
    }
}
