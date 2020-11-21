<?php

namespace App\Service;

use App\Repository\CurrencyRepository;

/**
 * Class CurrencyService
 * @package App\Service
 */
class CurrencyService
{
    /**
     * @var CurrencyRepository
     */
    private CurrencyRepository $currencyRepository;

    /**
     * CurrencyService constructor.
     * @param CurrencyRepository $currencyRepository
     */
    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->currencyRepository->findAll();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getCurrency(int $id): array
    {
        return $this->currencyRepository->findBy(['id' => $id]);
    }
}
