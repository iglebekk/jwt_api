<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jwt extends Model
{
    use HasFactory;


    /**
     * Makes a JWT token based on $data and $secret.
     * $data Data should be an array of data to be included in the token.
     * $secret Secret is an unique secret for the client.
     */

    public function encodeToken($data, $secret)
    {
        $secret = $secret . env('APP_KEY');

        $header = $this->encodeToBase64UrlString(json_encode(['typ' => 'JWT', 'alg' => 'HS256']));
        $payload = $this->encodeToBase64UrlString(json_encode($data));
        $signature = $this->encodeToBase64UrlString($this->createSignaturHash($header, $payload, $secret));

        return $header . "." . $payload . "." . $signature;

    }

    /**
     * Decodes the token and returns the payload if the token is valid.
     * If token failes it returnes FALSE
     * $token The token that should be decoded.
     * $secret Secret is an unique secret for the client and needs to be the same that $token var encoded with.
     */
    public function decodeToken($token, $secret)
    {
        list($header, $payload, $signature) = explode('.', $token);

        $payload = json_decode($this->decodeFromBase64UrlString($payload));
        $newToken = $this->encodeToken($payload, $secret);

        if($token != $newToken) { return FALSE; }

        return $payload;
    }


    private function encodeToBase64UrlString($data)
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }
    private function createSignaturHash($base64UrlHeader, $base64UrlPayload, $secret)
    {
        return hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
    }
    private function decodeFromBase64UrlString($data)
    {
        return base64_decode($data);
    }

}
