<?php
namespace Vikhyat\BlogManager\Model;

use Magento\Framework\Model\AbstractModel;
use Vikhyat\BlogManager\Model\ResourceModel\Loyalty as ResourceLoyalty;

class Loyalty extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceLoyalty::class);
    }
}