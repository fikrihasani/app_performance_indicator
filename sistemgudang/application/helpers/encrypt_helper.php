<?php 
    function simple_encrypt($text,$salt = 'D3nn1sw4R4pr0Gr4MS0lUt10ntw1L1gt')
    {  
        return rtrim(strtr(trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)))),'+/=', '-_='),'=');
    }
 
    function simple_decrypt($text,$salt = 'D3nn1sw4R4pr0Gr4MS0lUt10ntw1L1gt')
    {  
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode(strtr($text, '-_=', '+/=')), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }
?>