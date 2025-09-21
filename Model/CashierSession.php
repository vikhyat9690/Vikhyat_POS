<?php

namespace Vikhyat\BlogManager\Model;

use Magento\Framework\Model\AbstractModel;
use Vikhyat\BlogManager\Api\Data\CashierSessionInterface;
use Vikhyat\BlogManager\Model\ResourceModel\CashierSession as ResourceModelCashierSession;

class CashierSession extends AbstractModel implements CashierSessionInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModelCashierSession::class);
    }

    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    public function getCashierId()
    {
        return (int)$this->getData(self::CASHIER_ID);
    }

    public function setCashierId($cashierId)
    {
        return $this->setData(self::CASHIER_ID, $cashierId);
    }

    public function getOutletId()
    {
        return (int)$this->getData(self::OUTLET_ID);
    }

    public function setOutletId($outletId)
    {
        return $this->setData(self::OUTLET_ID, $outletId);
    }

    public function getCashierToken()
    {
        return (string)$this->getData(self::CASHIER_TOKEN);
    }

    public function setCashierToken($token)
    {
        return $this->setData(self::CASHIER_TOKEN, $token);
    }

    public function getIsLoggedIn()
    {
        return (int)$this->getData(self::IS_LOGGED_IN);
    }

    public function setIsLoggedIn($isLoggedIn)
    {
        return $this->setData(self::IS_LOGGED_IN, $isLoggedIn);
    }

    public function getLoginAt()
    {
        return (string)$this->getData(self::LOGIN_AT);
    }

    public function setLoginAt($loginAt)
    {
        return $this->setData(self::LOGIN_AT, $loginAt);
    }

    public function getLogoutAt()
    {
        return (string)$this->getData(self::LOGOUT_AT);
    }

    public function setLogoutAt($logoutAt)
    {
        return $this->setData(self::LOGOUT_AT, $logoutAt);
    }
}
