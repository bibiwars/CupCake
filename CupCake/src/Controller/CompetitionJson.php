<?php


namespace App\Controller;


use App\Entity\Competition;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Routing\Annotation\Route;


class CompetitionJson extends AbstractController
{
    /**
     * @Route("/competition", name="refsfsfs")
     */
    public function AfiAction()
    {
        $tasks = $this->getDoctrine()->getManager()->getRepository(Competition::class)->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
    /**
     * @Route("/competition/add", name="quazfdd")
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
        $comp = new Competition();
        $comp->setNomCompetition($request->get('nomCompetition'));


        $rest=substr($request->get('dateDebut'), 0, 20);
        $rest1=substr($request->get('dateDebut'), 30, 34);
        $res=$rest.$rest1;
        try {
            $date = new \DateTime($res);
            $comp->setDateDebut($date);
            $comp->setDateFin($date);

        } catch (\Exception $e) {}

        $restt=substr($request->get('dateFin'), 0, 20);
        $rest11=substr($request->get('dateFin'), 30, 34);
        $ress=$restt.$rest11;
        try {
            $datee = new \DateTime($ress);
            $comp->setDateFin($datee);

        } catch (\Exception $e) {}

        $em->persist($comp);
        $em->flush();
        $jsonContent = $Normalizer->normalize($comp,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
    /**
     * @Route("/competition/delete/{id_competition}", name="cvssfvd")
     */
    public function del(Request $request,NormalizerInterface $Normalizer,$id_competition)
    {
        $em = $this->getDoctrine()->getManager();
        $comp = $em->getRepository(Competition::class)->find($id_competition);
        $em->remove($comp);
        $em->flush();
        $jsonContent = $Normalizer->normalize($comp,'json',['groups'=>'post:read']);
        return new Response("Deleted".json_encode($jsonContent));
    }
    /**
     * @Route("/competition/{id}", name="qusgrf")
     */
    public function find(Request $request,NormalizerInterface $Normalizer,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $cv = $em->getRepository(Competition::class)->find($id);
        $jsonContent = $Normalizer->normalize($cv,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }
    /**
     * @Route("/comp/modify/{id_competition}", name="cvre")
     */
    public function ModifyAction(Request $request,NormalizerInterface $Normalizer,$id_competition)
    {
        $em = $this->getDoctrine()->getManager();
        $comp = $em->getRepository(Competition::class)->find($id_competition);
        $comp->setNomCompetition($request->get('nom_competition'));
        $rest=substr($request->get('date_debut'), 0, 20);
        $rest1=substr($request->get('date_debut'), 30, 34);
        $res=$rest.$rest1;
        try {
            $date = new \DateTime($res);
            $comp->setDateDebut($date);

        } catch (\Exception $e) {

        }
        $em->flush();
        $jsonContent = $Normalizer->normalize($comp,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }


}
