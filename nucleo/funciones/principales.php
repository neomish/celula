<?php
    #Acá irán funciones que pueden resultar útiles para probar o utilizar, y en algunos casos simplemente por comodidad 
    
    function crear_mensaje ( $tipo_de_mensaje , $mensaje ) {
        $mensaje_p = new Plantilla(
            "mensaje",
            [
                "ROL_DE_MENSAJE"  => "alert" ,
                "TIPO_DE_MENSAJE" => "$tipo_de_mensaje" ,
                "MENSAJE"         => "$mensaje"
            ]
        );
        $mensaje_p->procesar();
        $mensaje_p->embellecer();
        return $mensaje_p->html;
    }
?>
