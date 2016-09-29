<?php
    $prueba = new Usuario();
    if ( $prueba->usuario_activo() ) {
        $contenido='mensaje';
        $VECTOR_DE_DATOS[ 'ROL_DE_MENSAJE'  ] = "alert";
        $VECTOR_DE_DATOS[ 'TIPO_DE_MENSAJE' ] = "alert-warning";
        $VECTOR_DE_DATOS[ 'MENSAJE'         ] = "
            Usted ya ha ingresado al sistema
        ";
    }
?>