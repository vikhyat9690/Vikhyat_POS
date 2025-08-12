<?php
/**
 * Copyright © Vikhyat. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Vikhyat\BlogManager\Api\Data;

/**
 * Outlet interface
 */
interface OutletInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    public const ENTITY_ID = 'entity_id';
    public const OWNER_NAME = 'owner_name';
    public const SOURCE = 'source';
    public const EMAIL = 'email';
    public const WEBSITE_ID = 'website_id';
    public const COUNTRY = 'country';
    public const REGION = 'region';
    public const CITY = 'city';
    public const STREET_LINE_1 = 'street_line_1';
    public const STREET_LINE_2 = 'street_line_2';
    public const IS_ACTIVE = 'is_active';
    public const OUTLET_IMAGE = "outlet_image";

    /**
     * Get entity ID
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Set entity ID
     *
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId);

    /**
     * Get owner name
     *
     * @return string|null
     */
    public function getOwnerName();

    /**
     * Set owner name
     *
     * @param string $ownerName
     * @return $this
     */
    public function setOwnerName($ownerName);

    /**
     * Get source
     *
     * @return string|null
     */
    public function getSource();

    /**
     * Set source
     *
     * @param string $source
     * @return $this
     */
    public function setSource($source);

    /**
     * Get email
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email);

    /**
     * Get website ID
     *
     * @return int|null
     */
    public function getWebsiteId();

    /**
     * Set website ID
     *
     * @param int $websiteId
     * @return $this
     */
    public function setWebsiteId($websiteId);

    /**
     * Get country
     *
     * @return string|null
     */
    public function getCountry();

    /**
     * Set country
     *
     * @param string $country
     * @return $this
     */
    public function setCountry($country);

    /**
     * Get region
     *
     * @return string|null
     */
    public function getRegion();

    /**
     * Set region
     *
     * @param string $region
     * @return $this
     */
    public function setRegion($region);

    /**
     * Get city
     *
     * @return string|null
     */
    public function getCity();

    /**
     * Set city
     *
     * @param string $city
     * @return $this
     */
    public function setCity($city);

    /**
     * Get street line 1
     *
     * @return string|null
     */
    public function getStreetLine1();

    /**
     * Set street line 1
     *
     * @param string $streetLine1
     * @return $this
     */
    public function setStreetLine1($streetLine1);

    /**
     * Get street line 2
     *
     * @return string|null
     */
    public function getStreetLine2();

    /**
     * Set street line 2
     *
     * @param string $streetLine2
     * @return $this
     */
    public function setStreetLine2($streetLine2);

    /**
     * Get is active status
     *
     * @return bool|null
     */
    public function getIsActive();

    /**
     * Set is active status
     *
     * @param bool $isActive
     * @return $this
     */
    public function setIsActive($isActive);

    public function getOutletImage();

    public function setOutletImage($image);
}