<?php

namespace Vikhyat\BlogManager\Model\ResourceModel\BlogIndexer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vikhyat\BlogManager\Model\BlogIndexer;
use Vikhyat\BlogManager\Model\ResourceModel\BlogIndexer as ResourceModelBlogIndexer;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            BlogIndexer::class,
            ResourceModelBlogIndexer::class
        );
    }
}