<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index(): Response
    {
        return new JsonResponse(array('name' => 'test'));
    }

    /**
     * @Route("/utilisateur/ajouter", name="ajout_utilisateur")
     */
    public function ajoututilisateur(): Response
    {
        $u = new Utilisateur();
        $u->initUtilisateur("baghdadi","baha","bibiwars@protonmail.com","cun","24332818","bibiwars","df104c87f67637164f937e2ebc071cd89d57052074acf4a452200473e977e554","admin",0,"");
        $u->setDateCreation(new \DateTime('now'));
        $m = $this->getDoctrine()->getManager();
        $m->persist($u);
        $m->flush();
        return new JsonResponse(array('result' => 'ajouté'));
    }

}
