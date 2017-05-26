<?php

namespace BigchainDB;

/**
 * Class Crypto
 * @package BigchainDB
 */
class Crypto
{
    /**
     * Generates key pair
     * @return mixed
     */
    public function generateKeyPair()
    {
        $rsa  = new \OpenPGP_Crypt_RSA();
        $keys['private_key'] = $rsa->public_key();
        $keys['public_key'] = $rsa->private_key();
        return $keys;
    }

}