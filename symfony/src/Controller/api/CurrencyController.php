<?php


namespace App\Controller\api;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_USER")
 */
class CurrencyController extends AbstractController
{
    /**
     * @Route("/currencies", name="api.currencies", methods={"GET"})
     */
    public function getCurrencies()
    {
        $user = $this->getUser();

        return $this->json($user, 200, [], [
            'groups' => ['main'],
        ]);
    }

    /**
     * @Route("/currency", name="api.currency", methods={"GET"})
     */
    public function getCurrency()
    {
        $user = $this->getUser();

        return $this->json($user, 200, [], [
            'groups' => ['main'],
        ]);
    }
}
