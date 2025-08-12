<?php

namespace Vikhyat\BlogManager\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class SourceOptions implements OptionSourceInterface
{
    protected $sourceCollection;

    public function __construct(
        \Magento\Inventory\Model\ResourceModel\Source\CollectionFactory $sourceCollection
    ) {
        $this->sourceCollection = $sourceCollection;
    }

    public function toOptionArray()
    {
        $options = [];
        $collection = $this->sourceCollection->create();

        foreach ($collection as $item) {
            $options[] = [
                'value' => $item->getId(),
                'label' => $item->getName()
            ];
        }

        return $options;
    }
}
