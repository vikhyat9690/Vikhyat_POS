<?php

namespace Vikhyat\BlogManager\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class OutletOptions implements OptionSourceInterface
{
    protected $outletCollection;

    public function __construct(
        \Vikhyat\BlogManager\Model\ResourceModel\Outlet\CollectionFactory $outletCollection
    ) {
        $this->outletCollection = $outletCollection;
    }

    public function toOptionArray()
    {
        $options = [];
        $collection = $this->outletCollection->create();

        foreach ($collection as $item) {
            $options[] = [
                'value' => $item->getId(),
                'label' => $item->getOwnerName()
            ];
        }
        return $options;
    }
}