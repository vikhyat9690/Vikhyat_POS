<?php

namespace Vikhyat\BlogManager\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Vikhyat\BlogManager\Api\CashierRepositoryInterface;
use Vikhyat\BlogManager\Model\ResourceModel\Cashier\CollectionFactory;
use Vikhyat\BlogManager\Service\JwtTokenService;
use Vikhyat\BlogManager\Model\CashierSessionFactory;
use Vikhyat\BlogManager\Model\ResourceModel\CashierSession as CashierSessionResource;
use Magento\Framework\GraphQl\Exception\GraphQlAuthenticationException;

class CashierLogin implements ResolverInterface
{
    public function __construct(
        protected CashierRepositoryInterface $cashierRepository,
        protected CollectionFactory $cashierFactory,
        protected JwtTokenService $jwt,
        protected \Magento\Framework\Encryption\EncryptorInterface $encryptor,
        protected CashierSessionFactory $cashierSession,
        protected CashierSessionResource $cashierSessionResource,
    ) {}

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        ?array $value = null,
        ?array $args = null
    ) {
        if (empty($args) || !isset($args['email']) || !isset($args['password'])) {
            throw new GraphqlNoSuchEntityException(__('No data found!'));
        }
        $email = $args['email'];
        $password = $args['password'];
        $cashierCollection = $this->cashierFactory->create();
        $cashierCollection->addFieldToFilter('email', ['eq' => $email]);
        $responseData = [];
        foreach ($cashierCollection->getItems() as $item) {
            $isValidLogin = $this->encryptor->isValidHash($password, $item->getPassword())
                ? true : false;
            if ($isValidLogin) {
                try {
                    $cashierToken = $this->jwt->generateToken();
                    $cashier = $this->cashierSession->create();
                    $cashier->setCashierId($item->getId());
                    $cashier->setOutletId($item->getOutletId());
                    $cashier->setCashierToken($cashierToken);
                    $cashier->setIsLogin(1);
                    $cashier->setLoginAt(date('Y-m-d H:i:s'));
                    $cashier->setLogoutAt(date('Y-m-d H:i:s'));
                    $this->cashierSessionResource->save($cashier);

                    $responseData['id'] = $item->getId();
                    $responseData['email'] = $item->getEmail();
                    $responseData['firstname'] = $item->getFirstName();
                    $responseData['lastname'] = $item->getLastName();
                    $responseData['token'] = $cashierToken;
                    $responseData['telephone'] = $item->getTelephone();
                    $responseData['outlet'] = $item->getOutletId();
                    $responseData['cashier_image'] = $item->getCashierImage();
                    $responseData['is_active'] = $item->getIsActive();
                } catch (\Exception $e) {
                    throw new GraphQlAuthenticationException(__('Error in cashier login'));
                }
            }
        }
        return $responseData;
    }
}
