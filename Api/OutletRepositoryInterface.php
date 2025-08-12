<?php
/**
 * Copyright © Vikhyat. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Vikhyat\BlogManager\Api;

use Vikhyat\BlogManager\Api\Data\OutletInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Outlet repository interface
 * @api
 */
interface OutletRepositoryInterface
{
    /**
     * Save outlet
     *
     * @param OutletInterface $outlet
     * @return OutletInterface
     * @throws LocalizedException
     */
    public function save(OutletInterface $outlet): OutletInterface;

    /**
     * Retrieve outlet by ID
     *
     * @param int $id
     * @return OutletInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): OutletInterface;

    /**
     * Delete outlet
     *
     * @param OutletInterface $outlet
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(OutletInterface $outlet): bool;

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