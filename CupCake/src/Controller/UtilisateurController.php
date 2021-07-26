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
use VirusTotal;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;




class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index(): Response
    {
        return new Response(json_encode(array('resultat' => 'Home')));
    }

    /**
     * @Route("/utilisateur/ajouter", name="ajout_utilisateur")
     */
    public function ajoututilisateur(Request $request, SerializerInterface $seralizer, UserPasswordEncoderInterface $encoder): Response
    {
        try{
            $data = $request->getContent();
            $u = $seralizer->deserialize($data, Utilisateur::class, 'json');
            // TODO check field values
            $strongpass = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/', $u->getPassword());
            if(!$strongpass){
                if (!$strongpass) $code = 1012; //weak password
                return new Response(json_encode(array('resultat' => $code)));
            }
            // TODO check for user type
            $u->setDateCreation(new \DateTime('now'));
            $u->setActiver("true");
            $u->setToken("1333333333337");
            $u->setPassword($encoder->encodePassword($u, $u->getPassword()));
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
            $u_back = $u;
            $seralizer->deserialize($data, Utilisateur::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $u]);
            // TODO check field values
            // TODO disable activer and password, etc
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
    public function changerPassword(int $id, Request $request, SerializerInterface $seralizer, UserPasswordEncoderInterface $encoder): Response
    {
        try{
            $u = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneById($id);
            $data = json_decode($request->getContent(), true);
            $oldpassword = isset($data['oldpassword']) ? $data['oldpassword'] : null;
            $password = isset($data['password']) ? $data['password'] : null;
            $passwordre = isset($data['passwordre']) ? $data['passwordre'] : null;
            $strongpass = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/', $password);
            if($password==null || $password!==$passwordre || !$encoder->isPasswordValid($u, $oldpassword) || !$strongpass){
                if ($password==null) $code = 1001; //password value empty
                if ($password!==$passwordre) $code = 1002; //password verification does not match
                if (!$encoder->isPasswordValid($u, $oldpassword)) $code = 1003; //old password does not match
                if (!$strongpass) $code = 1012; //weak password
                return new Response(json_encode(array('resultat' => $code)));
            }
            $u->setPassword($encoder->encodePassword($u, $password));
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
     * @Route("/login", name="login_utilisateur")
     */
    public function loginutilisateur(Request $request, SerializerInterface $seralizer): Response
    {
        try{
            /*$data = json_decode($request->getContent(), true);
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
            //set session and auth token*/
            return new Response(json_encode(array('resultat' => '1')));
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logoututilisateur(): Response
    {
        return new Response(json_encode(array('resultat' => '0')));
    }

    /**
     * @Route("/utilisateur/reset/{user}", name="reset_utilisateur")
     */
    public function resetutilisateur(string $user, Request $request, MailerInterface $mailer): Response
    {
        try{
            if(strpos($user, '@') !== false){
                $u = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByEmail($user);
            }else{
                $u = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUsername($user);
            }
            if (!$u) return new Response(json_encode(array('resultat' => 1005))); //user not found
            $otp = random_int(100000, 999999);;
            $u->setToken($otp);
            $m = $this->getDoctrine()->getManager();
            $m->flush();
            
            $email = (new Email())
            ->from('pived.icsr@gmail.com')
            ->to($u->getEmail())
            ->subject('CupCake Password reset')
            ->text('Account: '.$otp.' is your CupCake account verification code');
            $mailer->send($email);
            
            return new Response(json_encode(array('resultat' => '0')));
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }
    }

    /**
     * @Route("/utilisateur/resetpass/{user}", name="resetPassword_utilisateur")
     */
    public function resetPassword(string $user, Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        try{
            if(strpos($user, '@') !== false){
                $u = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByEmail($user);
            }else{
                $u = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUsername($user);
            }
            if (!$u) return new Response(json_encode(array('resultat' => 1005))); //user not found
            $data = json_decode($request->getContent(), true);
            $otp = isset($data['otp']) ? $data['otp'] : null;
            $password = isset($data['password']) ? $data['password'] : null;
            $passwordre = isset($data['passwordre']) ? $data['passwordre'] : null;
            
            $strongpass = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/', $password);
            if($password==null || $password!==$passwordre || $otp!==$u->getToken() || !$strongpass){
                if ($password==null) $code = 1001; //password value empty
                if ($password!==$passwordre) $code = 1002; //password verification does not match
                if ($otp!==$u->getToken()) $code = 1003; //otp invalid
                if (!$strongpass) $code = 1012; //weak password
                return new Response(json_encode(array('resultat' => $code)));
            }
            $u->setPassword($encoder->encodePassword($u, $password));
            $u->setToken(13371337);
            $m = $this->getDoctrine()->getManager();
            $m->flush();
            return new Response(json_encode(array('resultat' => '0')));
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }
    }


    /**
     * @Route("/utilisateur/upload", name="upload_utilisateur")
     */
    public function uploadimgutilisateur(Request $request, HttpClientInterface $client, Security $security): Response
    {
        try{
            $img = $request->files->get('img');

            if ($img) {
                $originalFilename = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $ext = $img->guessExtension();
                if (!in_array(strtolower($ext), array("jpg", "png")))
                    return new Response(json_encode(array('resultat' => '1011'))); //invalid image
                $newFilename = $safeFilename.'-'.uniqid().'.'.$ext;
                try {
                    $img->move(
                        $this->getParameter('userimgs_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $file = new VirusTotal\File($this->getParameter('VirusTotalApiKey'));
                $resp = $file->scan($this->getParameter('userimgs_directory').'/'.$newFilename);
                $hash = $resp['sha1'];

                $post = array('apikey' => $this->getParameter('VirusTotalApiKey'),'resource'=> $hash);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://www.virustotal.com/vtapi/v2/file/report');
                curl_setopt($ch, CURLOPT_POST,1);
                curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
                curl_setopt($ch, CURLOPT_USERAGENT, "gzip, My php curl client");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER ,true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

                $result=curl_exec ($ch);
                $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                print("status = $status_code\n");
                if ($status_code == 200) {
                    $js = json_decode($result, true);
                    print_r($js);
                } else {
                    print($result);
                }
                curl_close ($ch);
                
                if (1==1/* TODO not file is clean*/){
                    $u = $security->getUser();
                    $u->setImage($newFilename);
                    $m = $this->getDoctrine()->getManager();
                    $m->flush();
                }
            }
            

            return new Response(json_encode(array('resultat' => $hash)));
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
            // TODO returns graph of number of users and their types; graph showing user growth per day
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
            // TODO returns a zip link that expires in 24 hours, containning all user details (excel) and images
        }catch(\Throwable $throwable){
            return new Response(json_encode(array('resultat' => '1')));
        }  
    }

}
