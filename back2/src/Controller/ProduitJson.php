<?php


namespace App\Controller;
use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Routing\Annotation\Route;

class ProduitJson extends AbstractController
{
    /**
     * @Route("/pat/prod/{idpatisserie}", name="prod")
     */
    public function AfiAction($idpatisserie)
    {
        $tasks = $this->getDoctrine()->getManager()->getRepository(Produit::class)->findBy(array('idpatisserie'=>$idpatisserie));

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
    /**
     * @Route("/pat/prod/add", name="prodadhfhfd")
     */
    public function addAction(Request $request,NormalizerInterface $Normalizer)
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
        $rec = new Produit();
        $rec->setDescription($request->get('description'));
        $rec->setIdpatisserie($request->get('idpatisserie'));
        $rec->setDesignation($request->get('designation'));
        $rec->setImage($request->get('image'));
        $rec->setNote($request->get('note'));
        $rec->setPrix($request->get('prix'));
        $rec->setQteStock($request->get('qteStock'));
        $em->persist($rec);
        $em->flush();
        $jsonContent = $Normalizer->normalize($rec,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
    /**
     * @Route("/pat/prod/del/{id}", name="prodd")
     */
    public function del(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $comp = $em->getRepository(Produit::class)->find($id);
        $em->remove($comp);
        $em->flush();
        $jsonContent = $Normalizer->normalize($comp,'json',['groups'=>'post:read']);
        return new Response("Deleted".json_encode($jsonContent));
    }
    /**
     * @Route("/prod/{id}", name="produ")
     */
    public function find(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $cv = $em->getRepository(Produit::class)->find($id);
        $jsonContent = $Normalizer->normalize($cv,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
    /**
     * @Route("/prod/modify/{id}", name="prodm")
     */
    public function ModifyAction(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $rec = $em->getRepository(Produit::class)->find($id);
        $rec->setIdcompetition(5);
        $rec->setType($request->get('type'));
        $em->flush();
        $jsonContent = $Normalizer->normalize($rec,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
}
