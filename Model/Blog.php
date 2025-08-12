<?php
namespace Vikhyat\BlogManager\Model;

use Magento\Framework\Model\AbstractModel;
use Vikhyat\BlogManager\Model\ResourceModel\Blog as ResourceBlog;

class Blog extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceBlog::class);
    }
}