<?php
    class Plantilla {

        # Propiedades y atributos
        private $archivo;        // Acá se indicará la ruta del archivo de la plantilla tpl se deberá cargar
        private $plantilla;      // Aquí se almacena la plantilla tpl  para ser procesada
        private $fd;             // Este es fichero descriptor utilizado en modo de lectura para tomar datos de la plantilla tpl
        private $datos;          // Este sirve como vector donde se almacenan las variables encontradas en el archivo tpl
        private $pila;           // En caso del loop con envolvimiento pila sirve para ir guardando los cierres pendientes de etiquetas
        private $unico;          // Es un valor para tratar de hacer únicas las sesiones
        public $html;            // Aca se almacena el contenido ya procesado de la plantilla dejando el puro HTML

        # function Plantilla( $archivo , $valores = array() ) {
        function __construct ( $archivo , $valores = array() ) {
            include "./configuracion/sistema.php";
            $this->unico = $LOCALIZACION_UNICA;
            if ( file_exists( './nucleo/vistas/' . $archivo . '.tpl' ) ) {
                $this->archivo = './nucleo/vistas/' . $archivo . '.tpl';            // Acá se fuerza a buscar las vistas en la carpeta de vistas
            } else {
                $this->archivo = './nucleo/vistas/sin_plantilla.tpl';
            }
            if ( ( $this->fd = @ fopen( $this->archivo, 'r' ) ) ) {
                $this->plantilla = fread( $this->fd, filesize( $this->archivo ) );  // Se asigna el contenido del archivo tpl en la propiedad  plantilla
                fclose( $this->fd );
                $this->html = $this->plantilla;                                     // Se precarga la propiedad plantilla en la propiedad html para ser alterada
                $this->datos = $valores;
                $this->recolectar_datos_de_configuracion( );                        // Se cargan datos globales almacenados en el archivo de configuración del sistema
                $this->datos = array_merge(
                    $this->datos,
                    [
                        "ARCHIVO_DE_PLANTILLA" => $archivo
                    ]
                );
            }
        }

        function recolectar_datos_de_configuracion( ) {
            include "./configuracion/sistema.php";                                 // Busca las variables de configuración del sistema en un archivo específico.
            $this->datos = array_merge(
                $this->datos ,
                [
                    "NOMBRE_DEL_SISTEMA" => $NOMBRE_DEL_SISTEMA,
                    "AUTOR_DEL_SISTEMA" => $AUTOR_DEL_SISTEMA
                ]
            );
        }

        /**
        Recolectar estilos:

        Éste método busca los archivos css en un directorio definido para el sistema, los cuales, previamente se han
        renombrado para su adecuada carga, este sistema no contempla definir el orden de carga de los archivos css.
        Éste método debe ser llamdo cuando la plantilla es una página principal, pues la clase tiene capacidad de
        cargar plantillas para secciones parciales de la página y por eso no automatiza la carga de estos archivos.
        */
        function recolectar_estilos ( ) {
            $directorio = new Directorio( "./recursos/estilos/" );
            $directorio->listar_directorio( array( "css" ) );
            $this->datos = array_merge( $this->datos , [ "ESTILOS_DE_LA_PLANTILLA" => $directorio->contenido ] );
        }

        /**
        Recolectar guiones:

        Éste método busca los archivos js en un directorio definido para el sistema, los cuales, previamente se han
        renombrado para su adecuada carga, este sistema no contempla definir el orden de carga de los archivos js.
        Éste método debe ser llamdo cuando la plantilla es una página principal, pues la clase tiene capacidad de
        cargar plantillas para secciones parciales de la página y por eso no automatiza la carga de estos archivos.
        */
        function recolectar_guiones ( ) {
            $directorio = new Directorio( "./recursos/guiones/" );
            $directorio->listar_directorio( array( "js" ) );
            $this->datos = array_merge( $this->datos , [ "GUIONES_DE_LA_PLANTILLA" => $directorio->contenido ] );
        }

        /**
        Asignar navegación:

        Con este procedimiento se carga la plantilla respectiva para mostrar el menú de navegación del sistema, existen
        dos menúes principales, el que tiene acceso para todo el público y el que es para los usuarios registrados en el
        sistema, el menú privado lo componen un conjunto de plantillas las cuales se denominan partes, con la idea de que
        cada rol le permite mostrar una sección de menú de acuerdo al rol identificado en cada usuario... evidentemente
        el sistema mostrará un colapso al tener muchos menúes asignados por roles, porque un usuario podría jugar muchos
        roles al mismo tiempo.

        Está función deberá ser re-analizada en un futuro para buscar un mejor método MVC para generar el menu HTML
        */
        function asignar_navegacion ( ) {
            if ( isset( $_SESSION[ $this->unico . 'ESTADO' ] ) && $_SESSION[ $this->unico . 'ESTADO'] ) {
                $partes = array();
                for ( $i = 0 ; $i < count( $_SESSION[ $this->unico . "ROLES" ] ) ; $i ++ ) {
                    $partes[$i]['PARTE'] = $this->obtener_subelemento( "navegacion_parte_" . $_SESSION[ $this->unico . "ROLES" ][ $i ] );
                }
                $navegacion = $this->obtener_subelemento( "navegacion_privada" , [ "PARTES_DE_NAVEGACION" => $partes ] );
            } else {
                $navegacion = $this->obtener_subelemento( "navegacion_publica");
            }
            $this->datos = array_merge( $this->datos , [ "NAVEGACION_DE_LA_PLANTILLA" => $navegacion ] );
        }

        function asignar_lateral ( ) {
            if ( isset( $_SESSION[ $this->unico . 'ESTADO' ] ) && $_SESSION[ $this->unico . 'ESTADO'] ) {
                $partes = array();
                for ( $i = 0 ; $i < count( $_SESSION[ $this->unico . "ROLES" ] ) ; $i ++ ) {
                    $partes[$i]['PARTE'] = $this->obtener_subelemento( "lateral_parte_" . $_SESSION[ $this->unico . "ROLES" ][ $i ] );
                }
                $lateral = $this->obtener_subelemento( "lateral_privada" , [ "PARTES_DE_LATERAL" => $partes ] );
            } else {
                $lateral = $this->obtener_subelemento( "lateral_publica");
            }
            $this->datos = array_merge( $this->datos , [ "LATERAL_DE_LA_PLANTILLA" => $lateral ] );
        }

        function asignar_contenido ( ) {
            $contenido = @ $_REQUEST[ 'contenido' ];
            if ( !$contenido ) {
                if ( isset( $_SESSION[ $this->unico . 'ESTADO' ] ) ) {
                    $contenido = "contenido_privado";
                } else {
                    $contenido = "contenido_publico";
                }
            }
            $VECTOR_DE_DATOS = array();
            if ( file_exists( './nucleo/aplicaciones/' . $contenido . '.php' ) ) {
                include './nucleo/aplicaciones/' . $contenido . '.php';
            }
            $contenido_plantilla = $this->obtener_subelemento( $contenido , $VECTOR_DE_DATOS );
            $this->datos = array_merge( $this->datos , [ "CONTENIDO_DE_LA_PLANTILLA" => $contenido_plantilla ] );
        }

        function mostrarVariable( $NOMBRE ) {
            if ( isset( $this->datos[ $NOMBRE ] ) ) {
                echo $this->datos[ $NOMBRE ];             // Cuando es llamada la función recolecta el valor del vector del atributo datos
            } else {
                echo '{' . $NOMBRE . '}';                 // En caso de no existir el valor según el índice recolectado deja el texto como se encontró en el archivo tpl
            }
        }

        function envolver( $ELEMENTO ) {
            $this->pila[] = $this->datos;                  // Prepara en una posición nueva de la matriz del atributo pila la carga del vector datos
            foreach ( $ELEMENTO as $indice => $valor ) {
                $this->datos[ $indice ] = $valor;
            }
        }

        function desenvolver( ) {
            $this->datos = array_pop( $this->pila );
        }

        function correr( ) {
            ob_start ( );
            eval ( func_get_arg( 0 ) );
            return ob_get_clean( );
        }

        function obtener_subelemento( $plantilla , $datos = array() ) {
            $subplantilla = new Plantilla( $plantilla , $datos );
            $subplantilla->procesar();
            return $subplantilla->html;
        }

        function verificar_logueo( ){
			$verificar = new Usuario();
			$verificar->registro();
        }


        function procesar( $datos = array ( 0 => "" ) ) {
            $this->datos = array_merge( $this->datos, $datos );
            $this->pila = array( );
            $this->html = str_replace( '<', '<?php echo \'<\'; ?>', $this->html );
            $this->html = preg_replace( '~\{(\w+)\}~', '<?php $this->mostrarVariable( \'$1\' ); ?>', $this->html );
            $this->html = preg_replace( '~\{LOOP:(\w+)\}~', '<?php if ( isset( $this->datos[ \'$1\' ] ) ) { foreach ( $this->datos[ \'$1\' ] as $ELEMENT ): $this->envolver( $ELEMENT ); ?>', $this->html );
            $this->html = preg_replace( '~\{ENDLOOP:(\w+)\}~', '<?php $this->desenvolver( ); endforeach; } else { } ?>', $this->html );
            $this->html = '?>' . $this->html;
            $this->html = $this->correr( $this->html );
            #$this->embellecer();
        }

        function embellecer(){
            $config = array(
                'indent'          => true,
                'output-xml'      => true,
                'input-xml'       => true,
                'char-encoding'   => 'utf8',
                'input-encoding'  => 'utf8',
                'output-encoding' => 'utf8',
                'wrap'            => '1000'
            );
            $tidy = new tidy();
            $tidy->parseString($this->html, $config, 'utf8');
            $tidy->cleanRepair();
            $this->html = tidy_get_output($tidy);
        }

        function mostrar( ) {
            # Embelleciendo el asunto
            # ... empieza embellecimiento ...
            $this->embellecer();
            # ... termina embellecimiento ...
            echo $this->html;
        }
    }
?>
