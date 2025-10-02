<?php

namespace Vikhyat\BlogManager\Ui\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Vikhyat\BlogManager\Model\ResourceModel\Loyalty\Grid\CollectionFactory;

class LoyaltyListingDataProvider extends AbstractDataProvider
{
    protected $loadedData;
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $data = $item->getData();
            $this->loadedData[$item->getId()] = $data;
        }
        return ['items' => [], 'totalRecords' => 0];
    }
}
