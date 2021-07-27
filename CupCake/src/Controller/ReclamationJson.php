<?php


namespace App\Controller;


use App\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Routing\Annotation\Route;

class ReclamationJson extends AbstractController
{


    /**
     * @Route("/reclamation", name="rec")
     */
    public function AffAction()
    {
        $tasks = $this->getDoctrine()->getManager()->getRepository(Reclamation::class)->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    /**
     * @Route("/reclamation/{id}", name="resfsfsc")
     */
    public function AfffAction($id)
    {
        $tasks = $this->getDoctrine()->getManager()->getRepository(Reclamation::class)->findOneBy(array('idReclamation' => $id));

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    /**
     * @Route("/reclamationadd", name="recaddd")
     */
    public function adAction(Request $request,NormalizerInterface $Normalizer)
    {
        $data = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        $em = $this->getDoctrine()->getManager();
        $rec = new Reclamation();
        $rec->setType($request->get('type'));
        $rec->setImessage($request->get('imessage'));
        $rec->setIdutilisateur(4);
        $rec->setStatus('non traite');
        $rec->setReponse('');
        $em->persist($rec);
        $em->flush();
        $jsonContent = $Normalizer->normalize($rec,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/reclamation/delete/{id}", name="cvvd")
     */
    public function del(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $comp = $em->getRepository(Reclamation::class)->find($id);
        $em->remove($comp);
        $em->flush();
        $jsonContent = $Normalizer->normalize($comp,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
    /**
     * @Route("/rec/{id}", name="qf")
     */
    public function find(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $cv = $em->getRepository(Reclamation::class)->find($id);
        $jsonContent = $Normalizer->normalize($cv,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
    /**
     * @Route("/reclamationupdate", name="cvre")
     */
    public function ModifyAction(Request $request,NormalizerInterface $Normalizer)
    {
        $data = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        $em = $this->getDoctrine()->getManager();
        $rec = $em->getRepository(Reclamation::class)->find($request->get('idReclamation'));
        $rec->setType($request->get('type'));
        $rec->setImessage($request->get('imessage'));
        $rec->setStatus('non traite');
        $rec->setReponse('');
        $em->flush();
        $jsonContent = $Normalizer->normalize($rec,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/reclamation/user/{iduser}", name="redsc")
     */
    public function recUserAction($iduser)
    {
        $tasks = $this->getDoctrine()->getManager()->getRepository(Reclamation::class)->findBy(array('idutilisateur'=>$iduser));

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }


    /**
     * @Route("/reclamations/repondre/{id}", name="repondreee",methods={"GET","POST"})
     */
    public function repondreeAction(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $data = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        $em = $this->getDoctrine()->getManager();
        $rec = $em->getRepository(Reclamation::class)->find($id);
        $rec->setStatus('traite');
        $rec->setReponse($request->get('reponse'));
        $em->flush();
        $jsonContent = $Normalizer->normalize($rec,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/reclamationCalcul/{type}", name="sfsff")
     */
    public function fqqffAction($type)
    {
        $tasks = $this->getDoctrine()->getManager()->getRepository(Reclamation::class)->findBy(array('type'=>$type));

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        $total=0;
        foreach ($tasks as $row){
            $total ++;
        }
        return new JsonResponse($total);
    }

}
