<?php
    class Usuario {

        private $nombre;     // acá está guardada la identificación del usuario
        private $roles;      // este será un vector de los posibles roles que posea el usuario
        private $estado;     // por purísima excentricidad se almacenará el estado del posible usuario
        private $unico;      // algo que se necesita para identificar las sesiones

        # function Usuario( ){
        function __construct ( ){
            include "./configuracion/sistema.php";
            $this->unico[ 'usuario' ] = $LOCALIZACION_UNICA . "USUARIO";
            $this->unico[ 'roles' ]   = $LOCALIZACION_UNICA . "ROLES";
            $this->unico[ 'estado' ]  = $LOCALIZACION_UNICA . "ESTADO";
            $this->nombre = @ $_SESSION[ $this->unico[ 'usuario' ] ];
            $this->roles  = @ $_SESSION[ $this->unico[ 'roles'   ] ];
            $this->estado = @ $_SESSION[ $this->unico[ 'estado'  ] ];
        }

        function registro(){
            include "./configuracion/sistema.php";
            $retorno = false;
            $solicitud = @ $_REQUEST[ 'acceso' ];
            if ( $solicitud == 'Salir' && isset( $_SESSION[ $this->unico[ 'usuario' ] ] ) ) {
                $_SESSION[ $this->unico[ 'usuario' ] ] = NULL;
                $_SESSION[ $this->unico[ 'roles'   ]   ] = NULL;
                $_SESSION[ $this->unico[ 'estado'  ]  ] = NULL;
                session_unset($_SESSION[ $this->unico[ 'usuario' ] ]);
                // @ session_unset($_SESSION[ $this->unico[ 'roles'   ] ]);
                // @ session_unset($_SESSION[ $this->unico[ 'estado'  ] ]);
                // session_destroy();
                $_REQUEST[ 'contenido' ] = "contenido_publico";
            }
            if ( $solicitud == 'Ingresar'  && !isset( $_SESSION[ $this->unico[ 'usuario' ] ] ) ) {
                $usuario = @ $_REQUEST[ 'usuario' ];
                $clave   = @ $_REQUEST[  'clave'  ];
                # if ( $usuario == $USUARIO_ADMINISTRADOR && md5( $clave ) == $CLAVE_DE_ADMINISTRADOR ) {
                if ( $usuario == $USUARIO_ADMINISTRADOR && password_verify( $clave , $CLAVE_DE_ADMINISTRADOR ) ) {
                    $_SESSION[ $this->unico[ 'usuario' ] ] = $usuario ;
                    $_SESSION[ $this->unico[ 'roles'   ] ] = array( "root" );
                    $_SESSION[ $this->unico[ 'estado'  ] ] = true;
                    $retorno = true;
                    $_REQUEST[ 'contenido' ] = "contenido_privado";
                }
            }
            return $retorno;
        }

        function usuario_activo() {
            $retorno  = false;
            if ( isset( $_SESSION[ $this->unico[ 'estado'  ] ] ) ) {
                $retorno = $_SESSION[ $this->unico[ 'estado'  ] ];
            }
            return $retorno;
        }

    }
?>
