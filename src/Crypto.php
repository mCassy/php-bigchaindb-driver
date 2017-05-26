<?php

namespace BigchainDB;

/**
 * Class Crypto
 * @package BigchainDB
 */
class Crypto
{
    /**
     * Returns key pair
     * @return mixed
     */
    public static function generateKeyPair()
    {
        $keys = [];
        $res = openssl_pkey_new();
        openssl_pkey_export($res, $keys['private_key']);
        $publicKey = openssl_pkey_get_details($res);
        $keys['public_key'] = $publicKey["key"];
        return $keys;
    }

}