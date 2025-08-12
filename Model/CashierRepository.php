<?php
/**
 * Copyright © Vikhyat. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Vikhyat\BlogManager\Model;

use Vikhyat\BlogManager\Api\Data\CashierInterface;
use Vikhyat\BlogManager\Api\Data\CashierInterfaceFactory;
use Vikhyat\BlogManager\Api\Data\CashierSearchResultsInterfaceFactory;
use Vikhyat\BlogManager\Model\ResourceModel\Cashier as ResourceCashier;
use Vikhyat\BlogManager\Model\ResourceModel\Cashier\CollectionFactory as CashierCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Vikhyat\BlogManager\Api\CashierRepositoryInterface;

/**
 * Class OutletRepository
 * @package Vikhyat\BlogManager\Model
 */
class CashierRepository implements CashierRepositoryInterface
{
    /**
     * @var ResourceCashier
     */
    protected $resource;

    /**
     * @var CashierInterfaceFactory
     */
    protected $cashierFactory;

    /**
     * @var CashierCollectionFactory
     */
    protected $cashierCollectionFactory;

    /**
     * @var CashierSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $extensionAttributesJoinProcessor;

    /**
     * @param ResourceCashier $resource
     * @param OutletInterfaceFactory $outletFactory
     * @param OutletCollectionFactory $outletCollectionFactory
     * @param OutletSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct(
        ResourceCashier $resource,
        CashierInterfaceFactory $cashierFactory,
        CashierCollectionFactory $cashierCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->resource = $resource;
        $this->cashierFactory = $cashierFactory;
        $this->cashierCollectionFactory = $cashierCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
    }

    /**
     * Save outlet
     *
     * @param CashierInterface $cashier
     * @return OutletInterface
     * @throws CouldNotSaveException
     */
    public function save(CashierInterface $cashier): CashierInterface
    {
        try {
            $this->resource->save($cashier);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the outlet: %1', $exception->getMessage()),
                $exception
            );
        }
        return $cashier;
    }

    /**
     * Retrieve outlet by ID
     *
     * @param int $id
     * @return CashierInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): CashierInterface
    {
        $cashier = $this->cashierFactory->create();
        $this->resource->load($cashier, $id);
        if (!$cashier->getId()) {
            throw new NoSuchEntityException(__('Outlet with id "%1" does not exist.', $id));
        }
        return $cashier;
    }

    /**
     * Delete outlet
     *
     * @param CashierInterface $outlet
     * @return bool true on success
     * @throws CouldNotDeleteException
     */
    public function delete(CashierInterface $outlet): bool
    {
        try {
            $cashierModel = $this->cashierFactory->create();
            $this->resource->load($cashierModel, $cashier->getEntityId());
            $this->resource->delete($cashierModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the outlet: %1', $exception->getMessage())
            );
        }
        return true;
    }

    /**
     * Delete outlet by ID
     *
     * @param int $id
     * @return bool true on success
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool
    {
        return $this->delete($this->getById($id));
    }
}