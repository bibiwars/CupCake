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
     * @Route("/publication", name="pub")
     */
    public function AfiAction()
    {
        $tasks = $this->getDoctrine()->getManager()->getRepository(Publication::class)->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
    /**
     * @Route("/publication/add", name="pubaddd")
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
        $rec = new Publication();
        $rec->setIdcompetition($request->get('idcompetition'));
        $rec->setMedia($request->get('media'));
        $rec->setTexte($request->get('texte'));
        $rec->setTitre($request->get('titre'));
        $em->persist($rec);
        $em->flush();

        $this->addFlash("success", "Inscription réussie !");


        $jsonContent = $Normalizer->normalize($rec,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
    /**
     * @Route("/publicationdelete/{id}", name="deletepubb")
     */
    public function del(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $comp = $em->getRepository(Publication::class)->find($id);
        $em->remove($comp);
        $em->flush();
        return new JsonResponse(true);
    }
    /**
     * @Route("/publication/{id}", name="pubfffqfu")
     */
    public function find(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $cv = $em->getRepository(Publication::class)->find($id);
        $jsonContent = $Normalizer->normalize($cv,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
    /**
     * @Route("/publicationupdate", name="pubupdate")
     */
    public function ModifyAction(Request $request,NormalizerInterface $Normalizer,$id)
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
        $rec = $em->getRepository(Publication::class)->find($request->get('idPublication'));
        $rec->setIdcompetition($request->get('idcompetition'));
        $rec->setMedia($request->get('media'));
        $rec->setTexte($request->get('texte'));
        $rec->setTitre($request->get('titre'));
        
        $em->flush();

        $this->addFlash("success", "Inscription réussie !");


        $jsonContent = $Normalizer->normalize($rec,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
}