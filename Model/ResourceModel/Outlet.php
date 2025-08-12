<?php
namespace Vikhyat\BlogManager\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Outlet extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('vikhyat_outlet', 'entity_id');
    }
}