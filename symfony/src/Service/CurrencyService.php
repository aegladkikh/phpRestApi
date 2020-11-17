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
    private CurrencyRepository $currency_repository;

    /**
     * CurrencyService constructor.
     * @param CurrencyRepository $currency_repository
     */
    public function __construct(CurrencyRepository $currency_repository)
    {
        $this->currency_repository = $currency_repository;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->currency_repository->findAll();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getCurrency(int $id): array
    {
        return $this->currency_repository->findBy(['id' => $id]);
    }
}
