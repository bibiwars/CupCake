<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index(): Response
    {
        return new Response(json_encode(array('resultat' => '1')));
    }

    /**
     * @Route("/utilisateur/ajouter", name="ajout_utilisateur")
     */
    public function ajoututilisateur(Request $request, SerializerInterface $seralizer): Response
    {
        try{
            $data = $request->getContent();
            $u = $seralizer->deserialize($data, Utilisateur::class, 'json');
            // check field values
            // check for user type
            $u->setDateCreation(new \DateTime('now'));
            $u->setActiver("true");
            $m = $this->getDoctrine()->getManager();
            $m->persist($u);
            $m->flush();
            return new Response(json_encode(array('resultat' => '0')));
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }
        
    }

    /**
     * @Route("/utilisateur/modifier/{id}", name="modifier_utilisateur")
     */
    public function modifierutilisateur(int $id, Request $request, SerializerInterface $seralizer): Response
    {
        try{
            $data = $request->getContent();
            $u = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneById($id);
            $seralizer->deserialize($data, Utilisateur::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $u]);
            // check field values
            $m = $this->getDoctrine()->getManager();
            $m->flush();
            return new Response(json_encode(array('resultat' => '0')));
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }  
    }

    /**
     * @Route("/utilisateur/liste", name="liste_utilisateur")
     */
    public function listeUtilisateurs(SerializerInterface $seralizer): Response
    {
        try{
            $users = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();
            $jsonContent = array();
            foreach ($users as $user) {
                $jsonContent[] = array(
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                );
            }
            // Alternative
            // $jsonContent = $seralizer->serialize($users, "json");
            return new Response(json_encode($jsonContent));
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }
    }

    /**
     * @Route("/utilisateur/id/{id}", name="rechercheId_utilisateur")
     */
    public function rechercheIdUtilisateur(int $id, SerializerInterface $seralizer): Response
    {
        try{
            $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByIdSecure($id);
            if (!$user)
                return new Response("");
            $jsonContent = $seralizer->serialize($user, "json");
            return new Response($jsonContent);
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }
    }

    /**
     * @Route("/utilisateur/recherche/{chaine}", name="recherche_utilisateurs")
     */
    public function rechercheUtilisateurs(string $chaine, SerializerInterface $seralizer): Response
    {
        try{
            $users = $this->getDoctrine()->getRepository(Utilisateur::class)->findMultipleSecure($chaine);
            if (!$users)
                return new Response("[]");
            $jsonContent = $seralizer->serialize($users, "json");
            return new Response($jsonContent);
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }
    }

    /**
     * @Route("/utilisateur/supprimer/{id}", name="supprimer_utilisateur")
     */
    public function supprimerUtilisateur(int $id): Response
    {
        try{
            $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneById($id);
            $m = $this->getDoctrine()->getManager();
            $m->remove($user);
            $m->flush();
            return new Response(json_encode(array('resultat' => '0')));
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }
    }

    /**
     * @Route("/utilisateur/changerpass/{id}", name="changerPassword_utilisateur")
     */
    public function changerPassword(int $id, Request $request, SerializerInterface $seralizer): Response
    {
        try{
            $u = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneById($id);
            $data = json_decode($request->getContent(), true);
            $oldpassword = isset($data['oldpassword']) ? $data['oldpassword'] : null;
            $password = isset($data['password']) ? $data['password'] : null;
            $passwordre = isset($data['passwordre']) ? $data['passwordre'] : null;
            if($password==null || $password!==$passwordre || $oldpassword!==$u->getPassword()){
                if ($password==null) $code = 1001; //password value empty
                if ($password!==$passwordre) $code = 1002; //password verification does not match
                if ($oldpassword!==$u->getPassword()) $code = 1003; //old password does not match
                return new Response(json_encode(array('resultat' => $code)));
            }
            $u->setPassword($password);
            $m = $this->getDoctrine()->getManager();
            $m->flush();
            return new Response(json_encode(array('resultat' => '0')));
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }
    }

    /**
     * @Route("/utilisateur/bloquer/{id}", name="bloquer_utilisateur")
     */
    public function bloquerutilisateur(int $id): Response
    {
        try{
            $u = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneById($id);
            $u->setActiver(false);
            $m = $this->getDoctrine()->getManager();
            $m->flush();
            return new Response(json_encode(array('resultat' => '0')));
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }  
    }

    /**
     * @Route("/utilisateur/activer/{id}", name="activer_utilisateur")
     */
    public function activerutilisateur(int $id): Response
    {
        try{
            $u = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneById($id);
            $u->setActiver(true);
            $m = $this->getDoctrine()->getManager();
            $m->flush();
            return new Response(json_encode(array('resultat' => '0')));
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }  
    }

    /**
     * @Route("/utilisateur/login", name="login_utilisateur")
     */
    public function loginutilisateur(Request $request, SerializerInterface $seralizer): Response
    {
        try{
            $data = json_decode($request->getContent(), true);
            $user = isset($data['user']) ? $data['user'] : null;
            $password = isset($data['password']) ? $data['password'] : null;
            
            if ($user==null) return new Response(json_encode(array('resultat' => 1006))); //user value empty
            if ($password==null) return new Response(json_encode(array('resultat' => 1001))); //password value empty
            if(strpos($user, '@') !== false){
                $u = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByEmail($user);
            }else{
                $u = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUsername($user);
            }
            if (!$u) return new Response(json_encode(array('resultat' => 1005))); //user not found
            if ($password!==$u->getPassword()) return new Response(json_encode(array('resultat' => 1004))); //login failed
            //set session and auth token
            return new Response(json_encode(array('resultat' => '0')));
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }
    }

    /**
     * @Route("/utilisateur/logout", name="logout_utilisateur")
     */
    public function logoututilisateur(): Response
    {
        try{
            //deletes user session
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }  
    }

    /**
     * @Route("/utilisateur/reset", name="reset_utilisateur")
     */
    public function resetutilisateur(): Response
    {
        try{
            //resets user password using otp
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }  
    }

    /**
     * @Route("/utilisateur/authz", name="authz_utilisateur")
     */
    public function authzutilisateur(): Response
    {
        try{
            //checks authentication; returns userid
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }  
    }

    /**
     * @Route("/utilisateur/upload", name="upload_utilisateur")
     */
    public function uploadimgutilisateur(): Response
    {
        try{
            //uploads user image; returns image path or base64
            //check image using VirusTotal API
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }  
    }

    /**
     * @Route("/utilisateur/statistique", name="statistique_utilisateur")
     */
    public function statistiqueutilisateur(): Response
    {
        try{
            //returns graph of number of users and their types; graph showing user growth per day
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }  
    }

    /**
     * @Route("/utilisateur/export", name="export_utilisateur")
     */
    public function exportutilisateur(): Response
    {
        try{
            //returns a zip link that expires in 24 hours, containning all user details (excel) and images
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }  
    }

}
