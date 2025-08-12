<?php
namespace Vikhyat\BlogManager\Model\ResourceModel\Blog;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vikhyat\BlogManager\Model\ResourceModel\Blog;
use Vikhyat\BlogManager\Model\Blog as BlogModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            BlogModel::class,
            Blog::class
        );
    }
}