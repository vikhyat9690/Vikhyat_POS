<?php
// namespace Vikhyat\BlogManager\Model\Indexer\Flat;

// use Magento\Framework\Indexer\ActionInterface;
// use Magento\Framework\DB\Adapter\AdapterInterface;
// use Magento\Framework\Mview\ActionInterface as MviewInterface;
// use Magento\Framework\App\ResourceConnection;

// class FlatTableBuilder implements ActionInterface, MviewInterface
// {
    // public const FLAT_TABLE = 'vikhyat_blog_indexer';
    // protected $connection;
    // protected $resource;

    // public function __construct(
    //     ResourceConnection $resource
    // )
    // {
    //     $this->resource = $resource;
    //     $this->connection = $resource->getConnection();
    // }

    // public function executeFull()
    // {
    //     $this->reindex();
    // }

    // public function execute($ids)
    // {
    //     $this->reindex($ids);
    // }

    // public function executeList(array $ids)
    // {
    //     $this->reindex($ids);
    // }

    // public function executeRow($id)
    // {
    //     $this->reindex([$id]);
    // }

    // public function reindex(?array $ids = null) {
    //     $flatTable = $this->resource->getTableName(self::FLAT_TABLE);
    //     if($ids) {
    //         $where = 'e.entity_id IN (' . implode(',', array_map('intval', $ids)) . ')';
    //     } else {
    //         $where = '1=1';
    //     }
    //     $select = $this->connection->select()
    //     ->from(
    //         ['e' => $this->resource->getTableName('cataloginventory_stock_item')],
    //         ['website_id', 'stock_id']
    //         )
    //     ->joinLeft(
    //         ['ct' => $this->resource->getTableName('customer_grid_flat')],
    //         ''
    //     )
    // }
// }