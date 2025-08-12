<?php

namespace Vikhyat\BlogManager\Service;

use Magento\Store\Model\ScopeInterface;

class JwtTokenService
{
    const JWT_SECRET_PATH = 'vikhyat/jwt/secret';
    const JWT_SECRET_EXPIRY = 'vikhyat/jwt/expiry_time';

    protected $scopeConfig;
    protected $encryptor;
    protected $dataTime;
    protected $logger;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Encryption\EncryptorInterface $encryptor,
        \Magento\Framework\Stdlib\DateTime\DateTime $dataTime,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->encryptor = $encryptor;
        $this->dataTime = $dataTime;
        $this->logger = $logger;
    }

    public function generateToken()
    {
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);

        $currentTime = $this->dataTime->gmtTimestamp();
        $expriyTime = $currentTime + ($this->getDefaultExpiry());
        $payload = [];
        $payload['iss'] = 'magento2';
        $payload['at'] = $currentTime;
        $payload['exp'] = $expriyTime;

        $payload = json_encode($payload);
        $base64Header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        $signature = hash_hmac('sha256', $base64Header . '.' . $base64Payload, $this->getSecretKey(), true);
        $base64Signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        return $base64Header . "." . $base64Payload . "." . $base64Signature;
    }

    public function getDefaultExpiry()
    {
        return (int) $this->scopeConfig->getValue(
            self::JWT_SECRET_EXPIRY,
            ScopeInterface::SCOPE_STORE
        ) ?: 3600; // Default 1 hour
    }

    public function getSecretKey()
    {
        $secretKey = $this->scopeConfig->getValue(
            self::JWT_SECRET_PATH,
            ScopeInterface::SCOPE_STORE
        );

        if (!$secretKey) {
            // Generate a default secret key if not configured
            $secretKey = $this->encryptor->hash('magento2_jwt_secret_' . time());
        }

        return $secretKey;
    }
}
