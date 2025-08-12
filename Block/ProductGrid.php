<?php

namespace Vikhyat\BlogManager\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Action\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\RequestInterface;

class ProductGrid extends Template
{
    protected $productRepository;
    protected $productFactory;
    protected $request;

    public function __construct(
        Template\Context $context,
        ProductRepositoryInterface $productRepository,
        CollectionFactory $productFactory,
        RequestInterface $request,
        array $data = []
    ) {
        $this->productRepository = $productRepository;
        $this->productFactory = $productFactory;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    public function getProductCollection()
    {
        $collection = $this->productFactory->create();
        $collection->addFieldToFilter('type_id', ['eq' => 'simple'])
            ->addFieldToFilter('price', ['lte' => (float) 20]);
        $this->setCollection($collection);
        return $collection;
    }

    public function getFilteredCollection()
    {
        $id = $this->request->getParams('entity_id');
        $collection = $this->getProductCollection();
        if (isset($id)) {
            $collection->addFieldToFilter('entity_id', ['eq' => $id]);
        }
        return $collection;
    }

    public function getColumns()
    {
        return [
            'entity_id' => [
                'label' => 'ID',
                'filterable' => true
            ],
            'attribute_set_id' => [
                'label' => 'Attribute Set Id',
                'filterable' => true
            ],
            'type_id' => [
                'label' => 'Type',
                'filterable' => false
            ],
            'sku' => [
                'label' => 'Sku',
                'filterable' => true
            ],
            'has_options' => [
                'label' => 'Has Options',
                'filterable' => false
            ],
            'required_options' => [
                'label' => 'Require Options',
                'filterable' => false
            ],
            'created_at' => [
                'label' => 'Created At',
                'filterable' => false
            ],
            'updated_at' => [
                'label' => 'Updated At',
                'filterable' => false
            ],
            'price' => [
                'label' => 'Price',
                'filterable' => false
            ]
        ];
    }
}
