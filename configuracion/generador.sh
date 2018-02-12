#!/usr/bin/php
<?php
    $clave = @ $argv[1];
    if ( $clave ) {
        $opciones = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        $clave_e = password_hash( $clave, PASSWORD_BCRYPT, $opciones);
        echo "$clave_e";
        echo "\n";
    } else {
       echo "Tiene que sugerir una clave";
    }
?>
