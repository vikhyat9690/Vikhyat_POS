<?php
namespace Vikhyat\BlogManager\Model\ResourceModel\Cashier;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vikhyat\BlogManager\Model\Cashier;
use Vikhyat\BlogManager\Model\ResourceModel\Cashier as ResourceModelCashier;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            Cashier::class,
            ResourceModelCashier::class
        );
    }
}