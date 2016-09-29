<?php
    # # # # # # # # # # # # # # # # # # # # # # # #
    # Sistema de gestión de aplicaciones varias   #
    # Autor: José David Calderón Serrano          # # # # # # # #
    #        jose.david@calderonbonilla.org, neomish@gmail.com  #
    #                                                           # # # # # # # # #
    # Este programa es software libre: usted puede redistribuirlo y / o         #
    # modificarlo bajo los términos de la GNU General Public License publicada  #
    # por la Free Software Foundation, bien de la versión 3 de la Licencia, o   #
    # (a su elección) cualquier versión posterior.                              #
    #                                                                           #
    # Este programa se distribuye con la esperanza de que sea útil, pero SIN    #
    # NINGUNA GARANTÍA, incluso sin la garantía implícita de COMERCIALIZACIÓN o #
    # IDONEIDAD PARA UN PROPÓSITO PARTICULAR. Consulte la GNU General Public    #
    # License para más detalles.                                                #
    #                                                                           #
    # Debería haber recibido una copia de la Licencia Pública General GNU junto #
    # con este programa, vease el archivo licencia/gpl.v3.es.txt, Si no, vea    #
    # <http://www.viti.es/gnu/licenses/gpl.html>.                               #
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

    include "./nucleo/funciones/principales.php";
    include "./nucleo/clases/principal.php";
    include "./nucleo/clases/usuario.php";

    # Todas las plantillas se encuentran en ./nucleo/vistas/ y tienen extensión tpl
    session_start();

    $Pagina = new Plantilla("principal");
    $Pagina->recolectar_estilos( );
    $Pagina->recolectar_guiones( );
    $Pagina->verificar_logueo( );
    $Pagina->asignar_navegacion( );
    $Pagina->asignar_contenido( );
    $Pagina->asignar_lateral( );
    $Pagina->procesar( );
    $Pagina->mostrar( );

?>