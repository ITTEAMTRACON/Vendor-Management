<?php

namespace App\Http\Controllers;




class CryptController extends Controller
{
    public function cryptString($string){
        // Store the cipher method
        $ciphering = "AES-128-CTR";
        
        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        
        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '1234567891011121';
        
        // Store the encryption key
        $encryption_key = "TraconIndustri";
        
        // Use openssl_encrypt() function to encrypt the data
        $encrypted = openssl_encrypt($string, $ciphering, $encryption_key, $options, $encryption_iv);
        return base64_encode($encrypted);
    }

    public function decryptString($string){
        // Store the cipher method
        $ciphering = "AES-128-CTR";
        
        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        
        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '1234567891011121';
        
        // Store the encryption key
        $encryption_key = "TraconIndustri";
        
        // Use openssl_encrypt() function to encrypt the data
        return openssl_decrypt(base64_decode($string), $ciphering, $encryption_key, $options, $encryption_iv);
    }
}