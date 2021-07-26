<?php


namespace App\Controller;


use App\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Routing\Annotation\Route;
class PublicationJson extends AbstractController
{
    /**
     * @Route("/pub", name="pub")
     */
    public function AfiAction()
    {
        $tasks = $this->getDoctrine()->getManager()->getRepository(Publication::class)->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
    /**
     * @Route("/pub/add", name="pubadd")
     */
    public function adAction(Request $request,NormalizerInterface $Normalizer)
    {
        $em = $this->getDoctrine()->getManager();
        $rec = new Publication();
        $rec->setIdutilisateur(5);
        $rec->setIdcompetition(3);
        $rec->setMedia($request->get('media'));
        $rec->setTexte($request->get('texte'));
        $rec->setTitre($request->get('titre'));
        $em->persist($rec);
        $em->flush();
        $jsonContent = $Normalizer->normalize($rec,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
    /**
     * @Route("/pub/del/{id}", name="pubb")
     */
    public function del(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $comp = $em->getRepository(Publication::class)->find($id);
        $em->remove($comp);
        $em->flush();
        $jsonContent = $Normalizer->normalize($comp,'json',['groups'=>'post:read']);
        return new Response("Deleted".json_encode($jsonContent));
    }
    /**
     * @Route("/pub/{id}", name="pubu")
     */
    public function find(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $cv = $em->getRepository(Publication::class)->find($id);
        $jsonContent = $Normalizer->normalize($cv,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
    /**
     * @Route("/pub/modify/{id}", name="pubm")
     */
    public function ModifyAction(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $rec = $em->getRepository(Publication::class)->find($id);
        $rec->setIdutilisateur(5);
        $rec->setIdcompetition(3);
        $rec->setMedia($request->get('media'));
        $rec->setTexte($request->get('texte'));
        $rec->setTitre($request->get('titre'));
        $em->flush();
        $jsonContent = $Normalizer->normalize($rec,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
}
