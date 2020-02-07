<?php


namespace App\Controller\api;


use App\Repository\CurrencyRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function getCurrencies(Request $request)
    {
        $json = $request->getContent();

        $page = 1; 

        if (!empty($json)) {
            $json = json_decode($json, true);

            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new Exception('invalid json', 500);
            }

            // TODO можно конечно валидатор прикрутить, но думаю тут и так все понятно
            $page = is_numeric($json['page']) ? (int)$json['page'] : 1;
        }

        $data = $this->currency_repository->findBy([], null, 5, 5 * ($page - 1));

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
