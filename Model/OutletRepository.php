<?php
/**
 * Copyright © Vikhyat. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Vikhyat\BlogManager\Model;

use Vikhyat\BlogManager\Api\OutletRepositoryInterface;
use Vikhyat\BlogManager\Api\Data\OutletInterface;
use Vikhyat\BlogManager\Api\Data\OutletInterfaceFactory;
use Vikhyat\BlogManager\Api\Data\OutletSearchResultsInterfaceFactory;
use Vikhyat\BlogManager\Model\ResourceModel\Outlet as ResourceOutlet;
use Vikhyat\BlogManager\Model\ResourceModel\Outlet\CollectionFactory as OutletCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;

/**
 * Class OutletRepository
 * @package Vikhyat\BlogManager\Model
 */
class OutletRepository implements OutletRepositoryInterface
{
    /**
     * @var ResourceOutlet
     */
    protected $resource;

    /**
     * @var OutletInterfaceFactory
     */
    protected $outletFactory;

    /**
     * @var OutletCollectionFactory
     */
    protected $outletCollectionFactory;

    /**
     * @var OutletSearchResultsInterfaceFactory
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
     * @param ResourceOutlet $resource
     * @param OutletInterfaceFactory $outletFactory
     * @param OutletCollectionFactory $outletCollectionFactory
     * @param OutletSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct(
        ResourceOutlet $resource,
        OutletInterfaceFactory $outletFactory,
        OutletCollectionFactory $outletCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->resource = $resource;
        $this->outletFactory = $outletFactory;
        $this->outletCollectionFactory = $outletCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
    }

    /**
     * Save outlet
     *
     * @param OutletInterface $outlet
     * @return OutletInterface
     * @throws CouldNotSaveException
     */
    public function save(OutletInterface $outlet): OutletInterface
    {
        try {
            $this->resource->save($outlet);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the outlet: %1', $exception->getMessage()),
                $exception
            );
        }
        return $outlet;
    }

    /**
     * Retrieve outlet by ID
     *
     * @param int $id
     * @return OutletInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): OutletInterface
    {
        $outlet = $this->outletFactory->create();
        $this->resource->load($outlet, $id);
        if (!$outlet->getId()) {
            throw new NoSuchEntityException(__('Outlet with id "%1" does not exist.', $id));
        }
        return $outlet;
    }

    /**
     * Delete outlet
     *
     * @param OutletInterface $outlet
     * @return bool true on success
     * @throws CouldNotDeleteException
     */
    public function delete(OutletInterface $outlet): bool
    {
        try {
            $outletModel = $this->outletFactory->create();
            $this->resource->load($outletModel, $outlet->getEntityId());
            $this->resource->delete($outletModel);
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