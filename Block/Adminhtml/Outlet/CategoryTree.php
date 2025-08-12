<?php
namespace Vikhyat\BlogManager\Block\Adminhtml\Outlet;

class CategoryTree extends \Magento\Framework\View\Element\Template
{
    protected $categoryCollectionFactory;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        array $data = []
    ) {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        parent::__construct($context, $data);
    }
    
    public function getCategoryTree()
    {
        // Your logic to fetch and structure categories
        return $this->categoryCollectionFactory->create()
            ->addAttributeToSelect('*')
            ->addIsActiveFilter()
            ->setOrder('position', 'ASC');
    }
}