<?php

namespace Vikhyat\BlogManager\Ui\DataProvider;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;

class LoyaltyPointDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $categoryCollection;
    protected $collection;
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CategoryCollectionFactory $categoryCollection,
        array $meta = [],
        array $data = [],
    ) {
        $this->collection = $categoryCollection->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData() {
        if(isset($this->loadedData)) {
            return $this->loadedData;
        }
        
    }
}
