<?php

namespace Vikhyat\BlogManager\Model\Resolver\Outlet;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Vikhyat\BlogManager\Api\OutletRepositoryInterface;

class OutletConfigData implements ResolverInterface
{
    protected $outletRepository;

    public function __construct(
        OutletRepositoryInterface $outletRepository
    ) {
        $this->outletRepository = $outletRepository;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        ?array $value = null,
        ?array $args = null
    ) {
        if (empty($args['id'])) {
            throw new GraphQlNoSuchEntityException(__('Id is mandatory!'));
        }

        $outletId = $args['id'];
        $outlet = $this->outletRepository->getById($outletId);
        $resultArray = [];

        if ($outlet->getId()) {
            $resultArray = [
                'id' => $outlet->getEntityId(),
                'name' => $outlet->getOwnerName(),
                'source' => $outlet->getSource(),
                'email' => $outlet->getEmail(),
                'city' => $outlet->getCity(),
                'region' => $outlet->getRegion(),
                'outlet_image' => $outlet->getOutletImage(),
                'country' => $outlet->getCountry(),
                'street_line_1' => $outlet->getStreetLine1(),
                'street_line_2' => $outlet->getStreetLine2(),
                'is_active' => $outlet->getIsActive(),
                'website_id' => $outlet->getWebsiteId(),
                'created_at' => $outlet->getCreatedAt(),
            ];
        }
        return $resultArray;
    }
}
