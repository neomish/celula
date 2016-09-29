<h2>
  Ingreso al sistema
</h2>
<p>
    <form action='./' method='post'>

        <input type='hidden' name='contenido' value='logueo' />

        <div class='input-group col_xs_4 col-md-4'>
            <span class='input-group-addon' id='usuario-l'>
                <i class='fa fa-user'>
                </i>
            </span>
            <input class='form-control' aria-describedby='usuario-l' type='text' name='usuario' placeholder='Usuario' />
        </div>

        <div class='input-group col_xs_4 col-md-4'>
            <span class='input-group-addon' id='clave-l'>
                <i class='fa fa-key'>
                </i>
            </span>
            <input class='form-control' aria-describedby='clave-l' type='password' name='clave' placeholder='Clave' />
        </div>

        <input type='submit' class='btn btn-success col_xs_4 col-md-4' name='acceso' value='Ingresar' />

    </form>
</p>
