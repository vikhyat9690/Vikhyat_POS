<?php
/**
 * Copyright © Vikhyat. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Vikhyat\BlogManager\Model;

use Magento\Framework\Model\AbstractModel;
use Vikhyat\BlogManager\Api\Data\OutletInterface;

/**
 * Outlet model
 */
class Outlet extends AbstractModel implements OutletInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'vikhyat_outlet';

    /**
     * Cache tag
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'vikhyat_outlet';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'outlet';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Vikhyat\BlogManager\Model\ResourceModel\Outlet::class);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get entity ID
     *
     * @return int|null
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set entity ID
     *
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get owner name
     *
     * @return string|null
     */
    public function getOwnerName()
    {
        return $this->getData(self::OWNER_NAME);
    }

    /**
     * Set owner name
     *
     * @param string $ownerName
     * @return $this
     */
    public function setOwnerName($ownerName)
    {
        return $this->setData(self::OWNER_NAME, $ownerName);
    }

    /**
     * Get source
     *
     * @return string|null
     */
    public function getSource()
    {
        return $this->getData(self::SOURCE);
    }

    /**
     * Set source
     *
     * @param string $source
     * @return $this
     */
    public function setSource($source)
    {
        return $this->setData(self::SOURCE, $source);
    }

    /**
     * Get email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Set email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get website ID
     *
     * @return int|null
     */
    public function getWebsiteId()
    {
        return $this->getData(self::WEBSITE_ID);
    }

    /**
     * Set website ID
     *
     * @param int $websiteId
     * @return $this
     */
    public function setWebsiteId($websiteId)
    {
        return $this->setData(self::WEBSITE_ID, $websiteId);
    }

    /**
     * Get country
     *
     * @return string|null
     */
    public function getCountry()
    {
        return $this->getData(self::COUNTRY);
    }

    /**
     * Set country
     *
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY, $country);
    }

    /**
     * Get region
     *
     * @return string|null
     */
    public function getRegion()
    {
        return $this->getData(self::REGION);
    }

    /**
     * Set region
     *
     * @param string $region
     * @return $this
     */
    public function setRegion($region)
    {
        return $this->setData(self::REGION, $region);
    }

    /**
     * Get city
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->getData(self::CITY);
    }

    /**
     * Set city
     *
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        return $this->setData(self::CITY, $city);
    }

    /**
     * Get street line 1
     *
     * @return string|null
     */
    public function getStreetLine1()
    {
        return $this->getData(self::STREET_LINE_1);
    }

    /**
     * Set street line 1
     *
     * @param string $streetLine1
     * @return $this
     */
    public function setStreetLine1($streetLine1)
    {
        return $this->setData(self::STREET_LINE_1, $streetLine1);
    }

    /**
     * Get street line 2
     *
     * @return string|null
     */
    public function getStreetLine2()
    {
        return $this->getData(self::STREET_LINE_2);
    }

    /**
     * Set street line 2
     *
     * @param string $streetLine2
     * @return $this
     */
    public function setStreetLine2($streetLine2)
    {
        return $this->setData(self::STREET_LINE_2, $streetLine2);
    }

    /**
     * Get is active status
     *
     * @return bool|null
     */
    public function getIsActive()
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set is active status
     *
     * @param bool $isActive
     * @return $this
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, (bool) $isActive);
    }

    public function getOutletImage()
    {
        return $this->getData(self::OUTLET_IMAGE);
    }

    public function setOutletImage($image)
    {
        return $this->setData(self::OUTLET_IMAGE, $image);
    }
}