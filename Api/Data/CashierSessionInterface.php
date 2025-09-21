<?php

namespace Vikhyat\BlogManager\Api\Data;

interface CashierSessionInterface
{
    public const ENTITY_ID      = 'entity_id';
    public const CASHIER_ID     = 'cashier_id';
    public const OUTLET_ID      = 'outlet_id';
    public const CASHIER_TOKEN  = 'cashier_token';
    public const IS_LOGGED_IN   = 'isLoggedIn';
    public const LOGIN_AT       = 'login_at';
    public const LOGOUT_AT      = 'logout_at';

    public function getEntityId();
    
    public function setEntityId(int $entityId);

    public function getCashierId();

    public function setCashierId(int $cashierId);

    public function getOutletId();

    public function setOutletId(int $outletId);

    public function getCashierToken();

    public function setCashierToken(string $token);

    public function getIsLoggedIn();

    public function setIsLoggedIn(int $isLoggedIn);

    public function getLoginAt();

    public function setLoginAt(string $loginAt);

    public function getLogoutAt();

    public function setLogoutAt(string $logoutAt);
}
