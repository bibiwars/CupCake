<?php


namespace App\Controller;
use App\Entity\Patisserie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Routing\Annotation\Route;


class PatisserieJson extends AbstractController
{
    /**
     * @Route("/pat", name="res")
     */
    public function AfiAction(NormalizerInterface $Normalizer)
    {
        $tasks = $this->getDoctrine()->getManager()->getRepository(Patisserie::class)->findAll();

        $jsonContent = $Normalizer->normalize($tasks,'json',['groups'=>'post:read']);

        /*$serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);*/
        return new JsonResponse($jsonContent);
    }
    /**
     * @Route("/pat/add", name="readd")
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
        $rec = new Patisserie();
        $rec->setNom($request->get('nom'));
        $rec->setIdutilisateur(5);
        $rec->setEmail($request->get('email'));
        $rec->setAdresse($request->get('adresse'));
        $rec->setTel($request->get('tel'));
        $rec->setTheme($request->get('theme'));
        $rec->setActiver($request->get('activer'));
        $em->persist($rec);
        $em->flush();
        $jsonContent = $Normalizer->normalize($rec,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
    /**
     * @Route("/pat/{id}", name="quf")
     */
    public function find(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $cv = $em->getRepository(Patisserie::class)->find($id);
        $jsonContent = $Normalizer->normalize($cv,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/pat/del/{id}", name="vd")
     */
    public function del(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $comp = $em->getRepository(Patisserie::class)->find($id);
        $em->remove($comp);
        $em->flush();
        $jsonContent = $Normalizer->normalize($comp,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/pat/update/{id}", name="cvrfe",methods={"GET","POST"})
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
        $rec = $em->getRepository(Patisserie::class)->find($id);
        $rec->setNom($request->get('nom'));
        $rec->setEmail($request->get('email'));
        $rec->setAdresse($request->get('adresse'));
        $rec->setTel($request->get('tel'));
        $rec->setTheme($request->get('theme'));
        $rec->setActiver($request->get('activer'));
        $em->flush();
        $jsonContent = $Normalizer->normalize($rec,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
}
