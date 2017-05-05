<!DOCTYPE html>
<html lang='es'>
	<head>
        <meta charset='UTF-8' />
        <title>
            {NOMBRE_DEL_SISTEMA}

        </title>

        {LOOP:ESTILOS_DE_LA_PLANTILLA}
            <link rel='stylesheet' href='{ARCHIVO}' type='text/css' />
        {ENDLOOP:ESTILOS_DE_LA_PLANTILLA}

        {LOOP:GUIONES_DE_LA_PLANTILLA}
            <script type='text/javascript' src='{ARCHIVO}'></script>
        {ENDLOOP:GUIONES_DE_LA_PLANTILLA}

    </head>
    <body>
        <header class='col-xs-12 col-sm-12 col-md-12'>
            <h1>
                {NOMBRE_DEL_SISTEMA}

            </h1>
        </header>

        <nav role='navbar navbar-default' class='col-xs-12 col-sm-12 col-md-12'>
            <div class="container-fluid">
                {NAVEGACION_DE_LA_PLANTILLA}

            </div>
        </nav>

        <section class='container contenedor col-xs-12 col-sm-12 col-md-9'>
            <article class=''>
                {CONTENIDO_DE_LA_PLANTILLA}

            </article>
        </section>

        <aside class='navbar navbar-nav col-xs-12 col-sm-12 col-md-3'>
            {LATERAL_DE_LA_PLANTILLA}

        </aside>

        <footer class='col-xs-12 col-sm-12 col-md-12'>
            <p>
                Creado por {AUTOR_DEL_SISTEMA}
            </p>

        </footer>
    </body>
</html>