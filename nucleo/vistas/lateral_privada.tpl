<p>
    <form action='./' method='post'>

        {LOOP:PARTES_DE_LATERAL}
            {PARTE}
        {ENDLOOP:PARTES_DE_LATERAL}

        <div class="panel panel-default">
            <div class="panel-body">
                <button class='btn btn-danger btn-lg col-xs-12 col-sm-12 col-md-12' name='acceso' value='Salir' >
                    <i class='fa fa-sign-out'>
                    </i>
                    &nbsp;Salir del sistema.
                </button>
            </div>
        </div>
    </form>

</p>