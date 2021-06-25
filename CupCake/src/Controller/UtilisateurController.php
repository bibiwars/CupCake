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

    /**
     * @Route("/utilisateur/liste", name="liste_utilisateur")
     */
    public function listeUtilisateurs(): Response
    {
        $users = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();
        $response = array();
        foreach ($users as $user) {
            $response[] = array(
                'username' => $user->getUsername(),
            );
        }
        return new JsonResponse(json_encode($response));
    }

    /**
     * @Route("/utilisateur/id/{id}", name="rechercheId_utilisateur")
     */
    public function rechercheIdUtilisateur(int $id): Response
    {
        $response = array();
        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneById($id);
        if ($user==null){
            $response[] = array('resultat' => "erreur",       );
        }else{
            $response[] = array('username' => $user->getUsername(),       );
        }
        
        return new JsonResponse(json_encode($response));
    }

    /**
     * @Route("/utilisateur/supprimer/{id}", name="supprimer_utilisateur")
     */
    public function supprimerUtilisateur(int $id): Response
    {
        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneById($id);
        $m = $this->getDoctrine()->getManager();
        $m->remove($user);
        $m->flush();
        $response = array();
        $response[] = array(
            'resultat' => 'Supprime',
        );
        return new JsonResponse(json_encode($response));
    }

}
