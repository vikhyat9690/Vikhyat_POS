<?php

namespace Vikhyat\BlogManager\Api\Data;

interface CashierInterface
{
    public const ENTITY_ID         = 'entity_id';
    public const CASHIER_FIRSTNAME = 'firstname';
    public const CASHIER_LASTNAME  = 'lastname';
    public const EMAIL             = 'email';
    public const TELEPHONE         = 'telephone';
    public const CASHIER_IMAGE     = 'cashier_image';
    public const PASSWORD          = 'password';
    public const IS_ACTIVE         = 'is_active';
    public const OUTLET_ID         = 'outlet_id';
    public const CREATED_AT        = 'created_at';
    public const UPDATED_AT        = 'updated_at';

    /**
     * @return int|null
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    public function getFirstname();
    public function setFirstname($firstname);

    public function getLastname();
    public function setLastname($lastname);

    public function getEmail();
    public function setEmail($email);

    public function getTelephone();
    public function setTelephone($telephone);

    public function getCashierImage();
    public function setCashierImage($cashierImage);

    public function getPassword();
    public function setPassword($password);

    public function getIsActive();
    public function setIsActive($isActive);

    public function getOutletId();
    public function setOutletId($outletId);

    public function getCreatedAt();
    public function setCreatedAt($createdAt);

    public function getUpdatedAt();
    public function setUpdatedAt($updatedAt);
}
