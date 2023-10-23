<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class CryptRequest extends FormRequest
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

    public function decryptString(Request $request){
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
        return openssl_decrypt(base64_decode($request->email), $ciphering, $encryption_key, $options, $encryption_iv);
    }
}
