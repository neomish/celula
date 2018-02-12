<?php

  class Directorio {

    # Propiedades y atributos

    private $ruta;
    public  $contenido;

    # Métodos

    #function Directorio ( $ruta ) {
    function __construct ( $ruta ) {
      $this->ruta = $ruta;
    }

    function listar_directorio ( $tipo = array("*") ) {
      $archivos = array();
      $directorio = opendir( $this->ruta );
      while ( ( $archivo = readdir( $directorio ) ) !== false ) {
        $extension = substr( strrchr( $archivo, '.' ), 1 );
        for ( $i = 0 ; $i < count ( $tipo ) ; $i ++ ) {
          if ( $extension == $tipo[$i] || $tipo == "*" ) {
            //$nombre_de_archivo = substr( $archivo , 0 , -4 );
            $archivos[][ 'ARCHIVO' ] = $this->ruta . $archivo;
          }
        }
      }
      closedir($directorio);
      sort($archivos);
      $this->contenido = $archivos;
    }
  }

?>
