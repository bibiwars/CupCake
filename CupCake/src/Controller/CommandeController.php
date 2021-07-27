<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CommandeSiteController
 * @package App\Controller
 *
 * @Route(path="/commande")
 */
class CommandeController
{
    private $commandeRepository;

    public function __construct(CommandeRepository $commandeRepository)
    {
        $this->commandeRepository = $commandeRepository;
    }

    /**
     * @Route("/add", name="add_commande", methods={"POST"})
     */
    public function addCommande(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $ref_cmd = $data['ref_cmd'];
        $date_cmd = $data['date_cmd'];
        $etat_cmd = $data['etat_cmd'];


        if (empty($ref_cmd) || empty($date_cmd) || empty($etat_cmd)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->commandeRepository->saveCommande($ref_cmd, $date_cmd, $etat_cmd);

        return new JsonResponse(['status' => 'Commande added!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/get/{id}", name="get_one_commande", methods={"GET"})
     */
    public function getOneCommande($id): JsonResponse
    {
        $commande = $this->commandeRepository->findOneBy(['id' => $id]);

        $data = [
            'id' => $commande->getId(),
            'ref_cmd' => $commande->getRefCmd(),
            'date_cmd' => $commande->getDateCmd(),
            'etat_cmd' => $commande->getEtatCmd(),
        ];

        return new JsonResponse(['commande' => $data], Response::HTTP_OK);
    }

    /**
     * @Route("/get-all", name="get_all_commandes", methods={"GET"})
     */
    public function getAllCommandes(): JsonResponse
    {
        $commandes = $this->commandeRepository->findAll();
        $data = [];

        foreach ($commandes as $commande) {
            $data[] = [
                'id' => $commande->getId(),
                'ref_cmd' => $commande->getRefCmd(),
                'date_cmd' => $commande->getDateCmd(),
                'etat_cmd' => $commande->getEtatCmd()

            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/update/{id}", name="update_commande", methods={"PUT"})
     */
    public function updateCommande($id, Request $request): JsonResponse
    {
        $commande = $this->commandeRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        $this->commandeRepository->updateCommande($commande, $data);

        return new JsonResponse(['status' => 'commande updated!']);
    }

    /**
     * @Route("/delete/{id}", name="delete_commande", methods={"DELETE"})
     */
    public function deleteCommande($id): JsonResponse
    {
        $commande = $this->commandeRepository->findOneBy(['id' => $id]);

        $this->commandeRepository->removeCommande($commande);

        return new JsonResponse(['status' => 'commande deleted']);
    }
    /**
     * @Route("/upload/{name}", name="upload_pdf", methods={"POST"})
     */
    public function uploadpdf(Request $request, $name): JsonResponse
    {
        $pdf = $request->getContent();
        $data = base64_decode($pdf);
        $src    =  __DIR__ . "/../../public/assets/" . $name . ".pdf";
        file_put_contents($src, $data);
        return new JsonResponse("success");
    }
}
