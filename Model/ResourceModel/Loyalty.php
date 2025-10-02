<?php
namespace Vikhyat\BlogManager\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Loyalty extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('vikhyat_loyalty_points', 'entity_id');
    }
}