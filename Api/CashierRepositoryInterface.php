<?php
/**
 * Copyright © Vikhyat. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Vikhyat\BlogManager\Api;

use Vikhyat\BlogManager\Api\Data\CashierInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Outlet repository interface
 * @api
 */
interface CashierRepositoryInterface
{
    /**
     * Save cashier
     *
     * @param CashierInterface $cashier
     * @return CashierInterface
     * @throws LocalizedException
     */
    public function save(CashierInterface $cashier): CashierInterface;

    /**
     * Retrieve outlet by ID
     *
     * @param int $id
     * @return OutletInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): CashierInterface;

    /**
     * Delete outlet
     *
     * @param CashierInterface $outlet
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(CashierInterface $cashier): bool;

    /**
     * Delete outlet by ID
     *
     * @param int $id
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $id): bool;
}