<ul class='nav navbar-nav'>
    <li>
        <a href='./'>
            <i class='fa fa-home'>
            </i>
            &nbsp;
            Portada
        </a>
    </li>
    {LOOP:PARTES_DE_NAVEGACION}
        {PARTE}
    {ENDLOOP:PARTES_DE_NAVEGACION}
    <li>
        <a href='./?acceso=Salir'>
            <i class='fa fa-sign-out'>
            </i>
            &nbsp;
            Salir del sistema
        </a>
    </li>
</ul>