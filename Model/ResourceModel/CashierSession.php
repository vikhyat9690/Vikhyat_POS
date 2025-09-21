<?php
namespace Vikhyat\BlogManager\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CashierSession extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('vikhyat_cashier_session', 'entity_id');
    }
}