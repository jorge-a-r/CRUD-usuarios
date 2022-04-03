<?php
include 'usuarios.php';
include 'roles.php';

$roles = Rol::read_roles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    
    <title>CRUD Usuarios</title>
</head>
<body>
    <div class="jumbotron text-center">
        <h1>CRUD de usuarios y roles</h1>
        <p>Podrá ver el listado de usuarios, roles, y realizar distintas operaciones</p>
    </div>
    <section class="container">
        <div class="row">
            <div class="col-sm-2">
                <div class="btn-group-vertical">
                <a href="index.php" class="btn btn-primary">Inicio</a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Usuarios</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="vista_usuarios.php">Lista Usuarios</a>
                            <a class="dropdown-item" href="#">Buscar Uusuario</a>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Roles</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="vista_roles.php">Lista Roles</a>
                            <a class="dropdown-item" href="#">Buscar Rol</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <h2>Listado de roles</h2>
                <hr>
                <a href="#" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modal_create_rol">Nuevo Rol</a>
                <hr>
                <div class="tableresponsive">
                    <table class="table table-sm table-striped table-bordered">
                        <thead class="thead-light">
                            <th>ID</th>
                            <th>Rol</th>
                            <th>Operaciones</th>
                        </thead>
                        <tbody>
                            <?php foreach ($roles as $rol) { ?>
                                <tr>
                                    <td><?php echo $rol->get_rol_id(); ?></td>
                                    <td><?php echo $rol->get_nombre_rol(); ?></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-dark">Modificar</a>
                                        <a href="#" class="btn btn-sm btn-danger">Eliminar</a>
                                        <a href="#" class="btn btn-sm btn-warning">Baja</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_create_rol">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear nuevo Rol</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="" method="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="rol">Nuevo Rol:</label>
                                <input class="form-control" type="text" name="rol" id="rol" placeholder="Indique el nombre del nuevo rol">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Aceptar">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</body>
</html>