<?php

namespace Vikhyat\BlogManager\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Vikhyat\BlogManager\Api\CashierRepositoryInterface;
use Vikhyat\BlogManager\Model\ResourceModel\Cashier\CollectionFactory;
use Vikhyat\BlogManager\Service\JwtTokenService;

class CashierLogin implements ResolverInterface
{
    public function __construct(
        protected CashierRepositoryInterface $cashierRepository,
        protected CollectionFactory $cashierFactory,
        protected JwtTokenService $jwt,
        protected \Magento\Framework\Encryption\EncryptorInterface $encryptor
    ) {
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        ?array $value = null,
        ?array $args = null
    ) {
        if(empty($args) || !isset($args['email']) || !isset($args['password'])) {
            throw new GraphqlNoSuchEntityException(__('No data found!'));
        }
        $email = $args['email'];
        $password = $args['password'];
        $cashierCollection = $this->cashierFactory->create();
        $cashierCollection->addFieldToFilter('email', ['eq' => $email]);
        $responseData = [];
        foreach($cashierCollection->getItems() as $item) {
            $isValidLogin = $this->encryptor->isValidHash($password, $item->getPassword())
            ? true : false;
            if($isValidLogin) {
                $responseData['id'] = $item->getId();
                $responseData['email'] = $item->getEmail();
                $responseData['firstname'] = $item->getFirstName();
                $responseData['lastname'] = $item->getLastName();
                $responseData['token'] = $this->jwt->generateToken();
                $responseData['telephone'] = $item->getTelephone();
                $responseData['outlet'] = $item->getOutletId();
                $responseData['cashier_image'] = $item->getCashierImage();
                $responseData['is_active'] = $item->getIsActive();
            }
        }
        return $responseData;
    }
}
