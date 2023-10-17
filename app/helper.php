<?php

if( ! function_exists('encode') ){
    function encode($id){
        return openssl_encrypt($id,'AES-256-CBC', 'mb6', 0, '1234567890123456');
    }
}
if( ! function_exists('decode') ){
    function decode($id){
        return openssl_decrypt($id,'AES-256-CBC', 'mb6', 0, '1234567890123456');
    }
}

?>