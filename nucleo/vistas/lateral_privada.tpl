<p>
    <form action='./' method='post'>

        {LOOP:PARTES_DE_LATERAL}
            {PARTE}
        {ENDLOOP:PARTES_DE_LATERAL}

        <button name='acceso' value='Salir' class='square red col_12'>
            <i class='fa fa-sign-out'>
            </i>
            &nbsp;Salir del sistema.
        </button>
    </form>

</p>