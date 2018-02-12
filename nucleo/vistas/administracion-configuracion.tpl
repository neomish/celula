<h2>
    Configuraci&oacute;n de {NOMBRE_DEL_SISTEMA_C}
</h2>
<form action='./' method='post'>

    <input type='hidden' name='contenido' value='administracion-configuracion' />

    <div class='input-group'>
        <span class='input-group-addon'>
            NOMBRE DEL SISTEMA
        </span>
        <input class='form-control' type='text' name='nombre_del_sistema' placeholder='Asigne un nombre a su sistema' value='{NOMBRE_DEL_SISTEMA_C}' />
    </div>

    <div class='input-group'>
        <span class='input-group-addon'>
            AUTOR DEL SISTEMA
        </span>
        <input class='form-control' type='text' name='autor_del_sistema' placeholder='Creador(es) del sistema' value='{AUTOR_DEL_SISTEMA_C}' />
    </div>

    <hr/>

    <div class='input-group'>
        <span class='input-group-addon'>
            USUARIO ADMINISTRADOR
        </span>
        <input class='form-control' type='text' name='usuario_administrador' placeholder='Cuenta para la administraci&oacute;n' value='{USUARIO_ADMINISTRADOR_C}' />
    </div>

    <div class='input-group'>
        <span class='input-group-addon'>
            CLAVE DE ADMINISTRADOR
        </span>
        <input class='form-control' type='password' name='clave_de_administrador' placeholder='contrase&ntilde;a para la administraci&oacute;n' value='' />
    </div>

    <hr/>

    <input type='submit' class='btn btn-success col-xs-12 col-sm-12 col-md-12' name='accion' value='Guardar' />

</form>
{MENSAJE_DE_GUARDADO}
