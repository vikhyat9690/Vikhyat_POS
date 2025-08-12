<?php

namespace Vikhyat\BlogManager\Ui\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use PhpParser\JsonDecoder;
use Vikhyat\BlogManager\Model\ResourceModel\Outlet\Grid\CollectionFactory;

class OutletListingDataProvider extends AbstractDataProvider
{
    protected $loadedData;

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
            if($item->getOutletImage()) {
                $outletImage = json_decode($data['outlet_image'], true);
                unset($data['outlet_image']);
                $data['outlet_image'] = $outletImage['url'];
                // $data['outlet_image']['name'] = $outletImage['name'];
            }
            $this->loadedData[$item->getId()] = $data;
            // $item->getOutletImage() != '' ? dd($this->loadedData[$item->getId()]) : '';
        }
        return ['items' => array_values($this->loadedData), 'totalRecords' => $this->collection->getSize()];
    }
}
