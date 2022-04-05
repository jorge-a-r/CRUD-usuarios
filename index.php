<?php
    include 'usuarios.php';
    include 'roles.php';

    //CREATE
   /* $usuario = new Usuario();
    $usuario->set_nombre("Juan Perez");
    $usuario->set_email("juan.perez@gmail.com");
    $usuario->set_username("j.perez");
    $usuario->set_contraseña("j.perez.user");
    $usuario->set_rol(3);
    $usuario->create_user();*/

    
    //UPDATE
    //$usuario pasa a ser una instancia de la clase Usuario     mediante el método estático getByEmail()
    //$usuario = Usuario::getByID(3);
    //$usuario->set_nombre($n_nombre);
    //$usuario->update_user();
    //var_dump($usuario);

    //DELETE
    //$usuario = Usuario::getByID(3);
    //$usuario->delete_user();

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
        </div>

    </section>
</body>
</html>