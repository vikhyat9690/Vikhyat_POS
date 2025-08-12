<?php

namespace Vikhyat\BlogManager\Model\Indexer;

use Magento\Framework\Indexer\ActionInterface;
use Magento\Framework\Mview\ActionInterface as MviewInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;

class BlogIndexer implements ActionInterface, MviewInterface
{
    protected $resource;
    protected $connection;
    public $customerFlat = 'customer_grid_flat';

    public function __construct(
        ResourceConnection $resource
    ) {
        $this->resource = $resource;
        $this->connection = $resource->getConnection();
    }

    public function executeFull()
    {
        $this->reindex();
    }

    public function execute($ids)
    {
        $this->reindex($ids);
    }

    public function executeList(array $ids)
    {
        $this->reindex($ids);
    }

    public function executeRow($id)
    {
        $this->reindex([$id]);
    }

    public function reindex(?array $ids = null)
    {
        $flatTable = $this->resource->getTableName('vikhyat_blog_indexer');

        if ($ids) {
            $where = 'e.entity_id IN (' . implode(',', array_map('intval', $ids)) . ')';
        } else {
            $where = '1=1';
        }

        // Clean existing entries
        if ($ids) {
            $this->connection->delete($flatTable, ['entity_id IN (?)' => $ids]);
        } else {
            $this->connection->truncateTable($flatTable);
        }

        $select = $this->connection->select()
            ->from(
                ['e' => $this->resource->getTableName('customer_entity')],
                ['entity_id', 'email']
            )
            ->joinLeft(
                ['cit' => $this->resource->getTableName('customer_grid_flat')],
                'e.entity_id = cit.entity_id',
                ['name', 'billing_full', 'shipping_full']
            )
            ->where($where);

        $rows = $this->connection->fetchAll($select);

        if (!empty($rows)) {
            $this->connection->insertMultiple($flatTable, $rows);
        }
    }
}
