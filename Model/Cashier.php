<?php
/**
 * Copyright © Vikhyat. 
 * See COPYING.txt for license details.
 */

namespace Vikhyat\BlogManager\Model;

use Magento\Framework\Model\AbstractModel;
use Vikhyat\BlogManager\Api\Data\CashierInterface;

class Cashier extends AbstractModel implements CashierInterface
{
    protected function _construct()
    {
        $this->_init(\Vikhyat\BlogManager\Model\ResourceModel\Cashier::class);
    }

    public function getId()
    {
        return (int) $this->getData(self::ENTITY_ID);
    }

    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    public function getFirstname()
    {
        return $this->getData(self::CASHIER_FIRSTNAME);
    }

    public function setFirstname($firstname)
    {
        return $this->setData(self::CASHIER_FIRSTNAME, $firstname);
    }

    public function getLastname()
    {
        return $this->getData(self::CASHIER_LASTNAME);
    }

    public function setLastname($lastname)
    {
        return $this->setData(self::CASHIER_LASTNAME, $lastname);
    }

    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    public function getTelephone()
    {
        return $this->getData(self::TELEPHONE);
    }

    public function setTelephone($telephone)
    {
        return $this->setData(self::TELEPHONE, $telephone);
    }

    public function getCashierImage()
    {
        return $this->getData(self::CASHIER_IMAGE);
    }

    public function setCashierImage($cashierImage)
    {
        return $this->setData(self::CASHIER_IMAGE, $cashierImage);
    }

    public function getPassword()
    {
        return $this->getData(self::PASSWORD);
    }

    public function setPassword($password)
    {
        return $this->setData(self::PASSWORD, $password);
    }

    public function getIsActive()
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    public function getOutletId()
    {
        return (int) $this->getData(self::OUTLET_ID);
    }

    public function setOutletId($outletId)
    {
        return $this->setData(self::OUTLET_ID, $outletId);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
