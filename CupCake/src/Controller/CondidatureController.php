<?php

namespace App\Controller;

use App\Entity\Condidature;
use App\Repository\CondidatureRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CondidatureSiteController
 * @package App\Controller
 *
 * @Route(path="/condidature")
 */
class CondidatureController
{
    private $condidatureRepository;

    public function __construct(CondidatureRepository $condidatureRepository)
    {
        $this->condidatureRepository = $condidatureRepository;
    }

    /**
     * @Route("/add", name="add_condidature", methods={"POST"})
     */
    public function addCondidature(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $applicateur = $data['applicateur'];
        $patisserie = $data['patisserie'];
        $etat = $data['etat'];
        $message = $data['message'];
        $cv = $data['cv'];

        if (empty($applicateur) || empty($patisserie) || empty($etat) || empty($message) || empty($cv)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->condidatureRepository->saveCondidature($applicateur, $patisserie, $etat, $message, $cv);

        return new JsonResponse(['status' => 'Condidature added!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/get/{id}", name="get_one_condidature", methods={"GET"})
     */
    public function getOneCondidature($id): JsonResponse
    {
        $condidature = $this->condidatureRepository->findOneBy(['id' => $id]);

        $data = [
            'id' => $condidature->getId(),
            'applicateur' => $condidature->getApplicateur(),
            'patisserie' => $condidature->getPatisserie(),
            'etat' => $condidature->getetat(),
            'message' => $condidature->getMessage(),
            'cv' => $condidature->getCv()
        ];

        return new JsonResponse(['condidature' => $data], Response::HTTP_OK);
    }

    /**
     * @Route("/get-all", name="get_all_condidatures", methods={"GET"})
     */
    public function getAllCondidatures(): JsonResponse
    {
        $condidatures = $this->condidatureRepository->findAll();
        $data = [];

        foreach ($condidatures as $condidature) {
            $data[] = [
                'id' => $condidature->getId(),
                'applicateur' => $condidature->getApplicateur(),
                'patisserie' => $condidature->getPatisserie(),
                'etat' => $condidature->getetat(),
                'message' => $condidature->getMessage(),
                'cv' => $condidature->getCv()
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/update/{id}", name="update_condidature", methods={"PUT"})
     */
    public function updateCondidature($id, Request $request): JsonResponse
    {
        $condidature = $this->condidatureRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        $this->condidatureRepository->updateCondidature($condidature, $data);

        return new JsonResponse(['status' => 'condidature updated!']);
    }

    /**
     * @Route("/delete/{id}", name="delete_condidature", methods={"DELETE"})
     */
    public function deleteCondidature($id): JsonResponse
    {
        $condidature = $this->condidatureRepository->findOneBy(['id' => $id]);

        $this->condidatureRepository->removeCondidature($condidature);

        return new JsonResponse(['status' => 'condidature deleted']);
    }
    /**
     * @Route("/upload/", name="upload_cv", methods={"POST"})
     */
    public function uploadCV(Request $request): JsonResponse
    {
        $filesResult = array();
        $filesBag = $request->files->all();

        foreach ($filesBag as $file) {
            $filename = $file->getClientOriginalName();
            $filesResult[] =  array(
                'path' => $file->getPathname(),
                'url'  => 'ddd'
            );
            $src    =  __DIR__ . "/../../public/assets/";
            $file->move($src, $filename);
        }
        return new JsonResponse($filename);
    }
}
