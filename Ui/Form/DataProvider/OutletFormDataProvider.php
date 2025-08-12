<?php

namespace Vikhyat\BlogManager\Ui\Form\DataProvider;

use Vikhyat\BlogManager\Model\ResourceModel\Outlet\CollectionFactory;

class OutletFormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;
    protected $_storeManager;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $employeeCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        protected \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $employeeCollectionFactory->create();
        $this->_storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $this->_loadedData[$item->getId()] = $item->getData();

            if ($item->getImage()) {
                
                $m['image'][0]['name'] = $item->getImage();
                $m['image'][0]['url'] = $this->getMediaUrl() . $item->getImage();

                $fullData = $this->_loadedData;
                $this->_loadedData[$item->getId()] = array_merge($fullData[$item->getId()], $m);
            }
        }
        return $this->_loadedData;
    }

    public function getMediaUrl()
    {
        /** @var \Magento\Store\Model\Store $store */
        $store = $this->_storeManager->getStore();
        $mediaUrl = $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        return $mediaUrl;
    }
}
