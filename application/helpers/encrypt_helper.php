<?php 
    function simple_encrypt($text,$salt = 'H3lloS3marangFingermedi4Solut1on')
    {  
        return rtrim(strtr(trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)))),'+/=', '-_='),'=');
    }
 
    function simple_decrypt($text,$salt = 'H3lloS3marangFingermedi4Solut1on')
    {  
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode(strtr($text, '-_=', '+/=')), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }
?>