<?php


namespace App\Controller\api;


use App\Repository\CurrencyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_USER_API")
 */
class CurrencyController extends AbstractController
{
    /**
     * @var CurrencyRepository
     */
    private CurrencyRepository $currency_repository;

    public function __construct(CurrencyRepository $currency_repository)
    {
        $this->currency_repository = $currency_repository;
    }

    /**
     * @Route("/currencies", name="api.currencies", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function getCurrencies()
    {
        $data = $this->currency_repository->findAll();

        return $this->json(["result" => $data], 200);
    }

    /**
     * @Route("/currency/{id}", name="api.currency", methods={"GET"})
     * @param int $id
     *
     * @return JsonResponse
     */
    public function getCurrency(int $id)
    {
        $data = $this->currency_repository->findBy(['id' => $id]);

        return $this->json(["result" => $data], 200);
    }
}
