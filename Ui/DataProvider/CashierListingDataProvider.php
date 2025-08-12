<?php

namespace Vikhyat\BlogManager\Ui\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Vikhyat\BlogManager\Model\ResourceModel\Cashier\Grid\CollectionFactory;

class CashierListingDataProvider extends AbstractDataProvider
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
        if(empty($items)) {
            return [];
        }
        foreach ($items as $item) {
            $data = $item->getData();
            if($item->getCashierImage()) {
                $outletImage = json_decode($data['cashier_image'], true);
                unset($data['cashier_image']);
                $data['cashier_image'] = $outletImage['url'];
                // $data['outlet_image']['name'] = $outletImage['name'];
            }
            $data['cashier_name'] = $data['firstname'] . ' ' . $data['lastname'];
            $this->loadedData[$item->getId()] = $data;
            // $item->getOutletImage() != '' ? dd($this->loadedData[$item->getId()]) : '';
        }
        return ['items' => array_values($this->loadedData), 'totalRecords' => $this->collection->getSize()];
    }
}
