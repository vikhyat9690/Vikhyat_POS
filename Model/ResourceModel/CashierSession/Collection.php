<?php

namespace Vikhyat\BlogManager\Model\ResourceModel\CashierSession;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vikhyat\BlogManager\Model\CashierSession;
use Vikhyat\BlogManager\Model\ResourceModel\CashierSession as ResourceModelCashierSession;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            CashierSession::class,
            ResourceModelCashierSession::class
        );
    }
}