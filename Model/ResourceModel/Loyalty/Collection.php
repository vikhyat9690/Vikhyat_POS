<?php
namespace Vikhyat\BlogManager\Model\ResourceModel\Loyalty;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vikhyat\BlogManager\Model\ResourceModel\Loyalty;
use Vikhyat\BlogManager\Model\Loyalty as LoyaltyModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            LoyaltyModel::class,
            Loyalty::class
        );
    }
}