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
     * @Route("/rec", name="rec")
     */
    public function AffAction()
    {
        $tasks = $this->getDoctrine()->getManager()->getRepository(Reclamation::class)->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
    /**
     * @Route("/rec/add", name="recadd")
     */
    public function adAction(Request $request,NormalizerInterface $Normalizer)
    {
        $em = $this->getDoctrine()->getManager();
        $rec = new Reclamation();
        $rec->setImessage($request->get('imessage'));
        $rec->setIdutilisateur(4);
        $rec->setIdpatisserie(5);
        $rec->setVisible($request->get('visible'));
        $rec->setStatus($request->get('status'));
        $rec->setReponse($request->get('reponse'));
        $em->persist($rec);
        $em->flush();
        $jsonContent = $Normalizer->normalize($rec,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/rec/del/{id}", name="cvvd")
     */
    public function del(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $comp = $em->getRepository(Reclamation::class)->find($id);
        $em->remove($comp);
        $em->flush();
        $jsonContent = $Normalizer->normalize($comp,'json',['groups'=>'post:read']);
        return new Response("Deleted Succesfully".json_encode($jsonContent));
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
     * @Route("/rec/modify/{id_reclamation}", name="cvre")
     */
    public function ModifyAction(Request $request,NormalizerInterface $Normalizer,$id_reclamation)
    {
        $em = $this->getDoctrine()->getManager();
        $rec = $em->getRepository(Reclamation::class)->find($id_reclamation);
        $rec->setImessage($request->get('imessage'));
        $rec->setIdutilisateur($request->get('iduser'));
        $rec->setIdpatisserie($request->get('idpatisserie'));
        $rec->setVisible($request->get('visible'));
        $rec->setStatus($request->get('status'));
        $rec->setReponse($request->get('reponse'));
        $em->flush();
        $jsonContent = $Normalizer->normalize($rec,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }

}
