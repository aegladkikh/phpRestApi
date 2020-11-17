<?php

namespace App\Controller\api;

use App\Service\CurrencyService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api.")
 */
class CurrencyController extends AbstractController
{
    /**
     * @var CurrencyService
     */
    private CurrencyService $currencyService;

    /**
     * CurrencyController constructor.
     * @param CurrencyService $currencyService
     */
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * @Route("/currencies", name="currencies", methods={"GET"})
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function getCurrencies(): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER_API');

        $data = $this->currencyService->getAll();

        return $this->json(["result" => $data], 200);
    }

    /**
     * @Route("/currency/{id}", name="currency", methods={"GET"})
     * @param int $id
     *
     * @return JsonResponse
     */
    public function getCurrency(int $id): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER_API');

        $data = $this->currencyService->getCurrency($id);

        if (!$data) {
            throw $this->createNotFoundException('Информация не найдена.');
        }

        return $this->json(["result" => $data], 200);
    }
}
