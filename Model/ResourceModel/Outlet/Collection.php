<?php
namespace Vikhyat\BlogManager\Model\ResourceModel\Outlet;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vikhyat\BlogManager\Model\Outlet;
use Vikhyat\BlogManager\Model\ResourceModel\Outlet as ResourceModelOutlet;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            Outlet::class,
            ResourceModelOutlet::class
        );
    }
}