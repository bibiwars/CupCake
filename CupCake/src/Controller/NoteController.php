<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use App\Entity\Note;
use App\Repository\NoteRepository;
/*use App\Entity\Patisserie;
use App\Repository\PatisserieRepository;
use App\Entity\Produit;
use App\Repository\ProduitRepository;*/
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class NoteController extends AbstractController
{
    /**
     * @Route("/note", name="note")
     */
    public function index(): Response
    {
        return new Response(json_encode(array('resultat' => '1')));
    }

        /**
     * @Route("/note/ajouter", name="ajout_note")
     */
    public function ajoutnote(Request $request, SerializerInterface $seralizer): Response
    {
        try{
            $data = json_decode($request->getContent(), true);
            $note = isset($data['note']) ? $data['note'] : null;
            $cibletype = isset($data['cible']) ? $data['cible'] : null;
            $cibleid = isset($data['cibleid']) ? $data['cibleid'] : null;
            if ($cibletype==null || !in_array($ciblenom, array("Produit", "Patisserie"))) return new Response(json_encode(array('resultat' => 1007))); //cibletype value invalid
            if ($ciblenom==null) return new Response(json_encode(array('resultat' => 1008))); //cibleid value invalid
            if ($note==null || $note<0 || $note>5) return new Response(json_encode(array('resultat' => 1009))); //note value invalid

            if($cibletype=="Patisserie"){
                $cible = $this->getDoctrine()->getRepository(Patisserie::class)->findOneById($cibleid);
            }else{
                $cible = $this->getDoctrine()->getRepository(Produit::class)->findOneById($cibleid);
            }
            if (!$cible) return new Response(json_encode(array('resultat' => 1008))); //cibleid value invalid
            
            $userid = 1; // get authz()
            $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneById($userid);
            
            $n = new Note($note, $user, $cibleid);
            $m = $this->getDoctrine()->getManager();
            $m->persist($n);
            $m->flush();
            return new Response(json_encode(array('resultat' => '0')));
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }
        
    }
}
