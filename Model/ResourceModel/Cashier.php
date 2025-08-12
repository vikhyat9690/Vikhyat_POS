<?php
namespace Vikhyat\BlogManager\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Cashier extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('vikhyat_cashier', 'entity_id');
    }
}