
    <h2 class="titulo">GESTIONAR USUARIOS</h2>

    <table class="tabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>CORREO</th>
                <th>TELEFONO</th>
                <th>ROL</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($usuario = $usuarios->fetch_object()) : ?>
            <tr>
                <td><?=$usuario->id?></td>
                <td><?=$usuario->nombre?></td>
                <td><?=$usuario->apellido?></td>
                <td><?=$usuario->correo?></td>
                <td><?=$usuario->telefono?></td>
                <td><?=$usuario->rol?></td>
                <td>
                    <a class="tabla__btn" href="<?=base_url?>Usuario/update&id=<?=$usuario->id?>">EDITAR</a>
                    <a class="tabla__btn rojo" href="<?=base_url?>usuario/delete&id=<?=$usuario->id?>">ELIMINAR</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>