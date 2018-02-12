<?php
    include "./configuracion/sistema.php";
    
    $accion   = @ $_REQUEST['accion'];
    $archivo  = "./configuracion/sistema.php";
    $MENSAJE  = "";
    $guardado = false;
    $VECTOR_DE_DATOS[ 'MENSAJE_DE_GUARDADO' ] = "";
    
    if ( $accion == "Guardar" ) {
        $nombre_del_sistema     = @ trim( $_REQUEST[ 'nombre_del_sistema'     ] );
        $autor_del_sistema      = @ trim( $_REQUEST[ 'autor_del_sistema'      ] );
        $usuario_administrador  = @ trim( $_REQUEST[ 'usuario_administrador'  ] );
        $clave_de_administrador = @ $_REQUEST[ 'clave_de_administrador' ];
        
        if ( is_writable($archivo) ) {
            if ( $nombre_del_sistema && $autor_del_sistema && $usuario_administrador ) {
                if ( ! $clave_de_administrador ) {
                    $clave_de_administrador_e = $CLAVE_DE_ADMINISTRADOR;
                } else {
                    $opciones = [
                        'cost' => 11
                    ];
                    $clave_de_administrador_e = password_hash( $clave_de_administrador, PASSWORD_BCRYPT, $opciones);
                }
                if ($gestor = fopen($archivo, 'w')) {
                    $contenido_de_configuracion =
"<?php
    \$NOMBRE_DEL_SISTEMA     = \"$nombre_del_sistema\";
    \$AUTOR_DEL_SISTEMA      = \"$autor_del_sistema\";
    \$LOCALIZACION_UNICA     = \"". md5( "celula" ) ."\"; // md5(\"celula\")
    \$USUARIO_ADMINISTRADOR  = \"$usuario_administrador\";
    \$CLAVE_DE_ADMINISTRADOR = '$clave_de_administrador_e';
?>"
                    ;
                    $guardado = fwrite($gestor, $contenido_de_configuracion);
                    fclose($gestor);
                    if ( $guardado ) {
                        $MENSAJE = crear_mensaje( "alert-success" , "El archivo de configuraci&oacute;n se ha modificado con &eacute;xito !!" );
                        $NOMBRE_DEL_SISTEMA    = $nombre_del_sistema;
                        $AUTOR_DEL_SISTEMA     = $autor_del_sistema;
                        $USUARIO_ADMINISTRADOR = $usuario_administrador;
                    }
                }
            } else {
                $MENSAJE = crear_mensaje( "alert-warning" , "Debe llenar los datos, los campos vac&iacute;os o con solamente espacios en blanco no son permitidos" );
            }
        } else {
            $MENSAJE = crear_mensaje( "alert-warning" , "El archivo de configuracion \"$archivo\" no es escribible" );
        }
    }
    
    
    $VECTOR_DE_DATOS[ 'MENSAJE_DE_GUARDADO'      ] = $MENSAJE ;
    $VECTOR_DE_DATOS[ 'NOMBRE_DEL_SISTEMA_C'     ] = $NOMBRE_DEL_SISTEMA;
    $VECTOR_DE_DATOS[ 'AUTOR_DEL_SISTEMA_C'      ] = $AUTOR_DEL_SISTEMA;
    $VECTOR_DE_DATOS[ 'USUARIO_ADMINISTRADOR_C'  ] = $USUARIO_ADMINISTRADOR;
    $VECTOR_DE_DATOS[ 'CLAVE_DE_ADMINISTRADOR_C' ] = $CLAVE_DE_ADMINISTRADOR;
?>
