<?php

namespace Vikhyat\BlogManager\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Vikhyat\BlogManager\Api\CashierRepositoryInterface;

class CashierLogin implements ResolverInterface
{
    protected $cashierRepostory;

    public function __construct(
        CashierRepositoryInterface $cashierRepository
    ) {
        $this->cashierRepostory = $cashierRepository;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        ?array $value = null,
        ?array $args = null
    ) {
        if(empty($args)) {
            throw new GraphqlNoSuchEntityException(__('No data found!'));
        }
        
    }
}
