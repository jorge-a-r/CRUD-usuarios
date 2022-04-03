<?php
include 'usuarios.php';
include 'roles.php';

//READ
$usuarios = Usuario::read_users();
$roles = Rol::read_roles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
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
                <h2>Listado de usuarios</h2>
                <hr>
                <a href="#" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modal_create_usuario">Nuevo usuario</a>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-sm">
                        <thead class="thead-light">
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Nombre de usuario</th>
                            <th>Rol</th>
                            <th>Operaciones</th>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario) { ?>
                                <tr>
                                    <td><?php echo $usuario->get_id_user(); ?></td>
                                    <td><?php echo $usuario->get_nombre(); ?></td>
                                    <td><?php echo $usuario->get_email(); ?></td>
                                    <td><?php echo $usuario->get_username(); ?></td>
                                    <td><?php echo $usuario->nombre_rol; ?></td>
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

        <div class="modal fade" id="modal_create_usuario">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear nuevo Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre del usuario" required min="10">
                                        <span class="invalid_message" hidden>*Ingrese el nombre</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail:</label>
                                        <input class="form-control" type="email" name="email" id="email" placeholder="Ingrese el e-mail del usuario" required>
                                        <span class="invalid_message" hidden>*Ingrese el email</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input class="form-control" type="text" name="username" id="username" required min="3" max="12">
                                        <span class="invalid_message" hidden>*Ingrese el username</span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="user_password">Contraseña:</label>
                                        <input class="form-control" type="password" name="user_password" id="user_password" required min="6">
                                        <span class="invalid_message" hidden>*Ingrese la contraseña</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_password_confirm">Confirmar Contraseña:</label>
                                        <input class="form-control" type="password" name="user_password_confirm" id="user_password_confirm" required min="6">
                                        <span class="invalid_message" hidden>*Confirme la contraseña</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="rol_id">Asignar un rol:</label>
                                        <select class="form-control" name="roles" id="roles">
                                            <option value="0" disabled selected>Seleccione un rol...</option>
                                            <?php foreach ($roles as $rol) { ?>
                                                <option value="<?php echo $rol->get_rol_id()?>"><?php echo $rol->get_nombre_rol()?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="invalid_message" hidden>*Seleccione un rol</span>
                                    </div>
                                </div>
                            </div>     
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Aceptar" id="create_user_submit">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</body>

<script>
</script>
</html>