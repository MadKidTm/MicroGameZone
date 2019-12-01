<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Avis;
use App\Form\AvisType;

/**
 * Class ReviewController
 * @package App\Controller
 * @Route("/api", name="api_")
 */
class ReviewController extends FOSRestController {

    /**
     *Lists all Reviews.
     *@Rest\Get("/reviews")
     **@return Response
     */
    public function getReviewsAction() {
        $repository = $this->getDoctrine()->getRepository(Avis::class);
        $reviews = $repository->findAll();

        return $this->handleView($this->view($reviews));
    }
}

?>