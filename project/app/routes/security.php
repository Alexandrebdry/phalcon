<?php

function secret() : string
{
    return 'FYCPHALCON' ;
}

function base64url_encode($data): string
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function generateJWT($headers, $payload): string
{
    $head = base64url_encode($headers) ;
    $payl = base64url_encode($payload) ;
    $sign = hash_hmac(
        'SHA256',
        "$head.$payl." ,
        base64url_encode(secret()) ,
        true
    ) ;
    return "$head.$payl." . base64url_encode($sign) ;
}

function verifyJWT($token) : bool
{
    $parts = explode('.',$token);
    $header = base64_decode($parts[0]) ;
    $payload = base64_decode($parts[1]) ;
    $sign = $parts[2] ;

    $date = json_decode($payload)->exp ;
    if($date - time() < 0 ) return false ;
    $h = base64url_encode($header) ;
    $p = base64url_encode($payload) ;
    $signature =  hash_hmac(
        'SHA256',
        "$h.$p",
        base64url_encode(secret()),
        true
    ) ;
    $signature_encoded = base64url_encode($signature) ;
    if($signature_encoded === $sign) return true ;
    return false ;
}


