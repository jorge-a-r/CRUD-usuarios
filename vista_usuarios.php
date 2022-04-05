<?php
include 'usuarios.php';
include 'roles.php';

//READ
$usuarios = Usuario::read_users();
$roles = Rol::read_roles();

//$usuario = new Usuario();

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
                                        <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_update_usuario" data-id-user="<?php echo $usuario->get_id_user(); ?>" id="update_user_<?php echo $usuario->get_id_user(); ?>" onclick="return update_user(<?php echo $usuario->get_id_user(); ?>)">Modificar</a>
                                        
                                        <a href="#modal_delete_usuario_<?php echo $usuario->get_id_user(); ?>" class="btn btn-sm btn-danger" data-toggle="modal">Eliminar</a>
                                        
                                        <a href="#" class="btn btn-sm btn-warning">Baja</a>
                                    </td>
                                </tr>
                                <!-- Modal alerta de eliminación de usuario -->
                                <div class="modal fade" id="modal_delete_usuario_<?php echo $usuario->get_id_user(); ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Eliminar Usuario</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <div class="modal-body">
                                                <p>El usuario: <strong><?php echo $usuario->get_nombre() ?></strong> está por ser eliminado. ¿Seguro de que quiere continuar?</p>
                                            </div>

                                            <div class="modal-footer">
                                                <a href="usuarios.php/delete_user/<?php echo $usuario->get_id_user();?>" class="btn btn-success">Continuar</a>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!--Modal con formulario de alta de usuario -->
        <div class="modal fade" id="modal_create_usuario">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear nuevo Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form id="create_user_form" action="" onsubmit="return validar_formulario_create()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre del usuario">
                                        <span class="invalid-message" id="invalid_name" hidden></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail:</label>
                                        <input class="form-control" type="email" name="email" id="email" placeholder="Ingrese el e-mail del usuario">
                                        <span class="invalid-message" id="invalid_email" hidden>*Ingrese el email</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username <span class="small">(Mayor a 3 caracteres)</span>:</label>
                                        <input class="form-control" type="text" name="username" id="username">
                                        <span class="invalid-message" id="invalid_username" hidden>*Ingrese el username</span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="user_password">Contraseña <span class="small">(Entre 6 y 12 caracteres)</span>:</label>
                                        <input class="form-control" type="password" name="user_password" id="user_password">
                                        <span class="invalid-message" id="invalid_password" hidden>*Ingrese la contraseña</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_password_confirm">Confirmar Contraseña:</label>
                                        <input class="form-control" type="password" name="user_password_confirm" id="user_password_confirm">
                                        <span class="invalid-message" id="invalid_password_conf" hidden>*Confirme la contraseña</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="roles">Asignar un rol:</label>
                                        <select class="form-control" name="roles" id="roles">
                                            <option value="0" disabled selected>Seleccione un rol...</option>
                                            <?php foreach ($roles as $rol) { ?>
                                                <option value="<?php echo $rol->get_rol_id()?>"><?php echo $rol->get_nombre_rol()?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="invalid-message" id="invalid_rol" hidden></span>
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
        
        <!-- Modal de modificación de usuario -->
        <div class="modal fade" id="modal_update_usuario">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modificar Uusuario</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form id="update_user_form" action="" onsubmit="return validar_formulario_update()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="n_nombre">Nombre:</label>
                                <input type="text" name="Nombre" id="n_nombre" class="form-control" value="">
                                <span class="invalid-message" hidden></span>
                            </div>
                            <div class="form-group">
                                <label for="n_email">Email:</label>
                                <input type="text" name="Email" id="n_email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="n_username">Username:</label>
                                <input type="text" name="Username" id="n_username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="n_roles">Asignar un rol:</label>
                                <select class="form-control" name="Roles" id="n_roles">
                                    <option value="0" disabled>Seleccione un rol...</option>
                                    <?php foreach ($roles as $rol) { ?>
                                        <option value="<?php echo $rol->get_rol_id()?>"><?php echo $rol->get_nombre_rol()?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Aceptar" id="update_user_submit">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>   
            </div>
        </div>

        

    </section>
</body>

<script>
    //Función para validar formulario de alta de usuario
    function validar_formulario_create(){
        //Elementos input
        let input_nombre = document.querySelector('#nombre');
        let input_email = document.querySelector('#email');
        let input_username = document.querySelector('#username');
        let input_password = document.querySelector('#user_password');
        let input_password_confirm = document.querySelector('#user_password_confirm');
        let select_roles = document.querySelector('#roles');

        //Valores de los inputs
        let mensaje_nombre = document.querySelector('#invalid_name');
        let mensaje_email = document.querySelector('#invalid_email');
        let mensaje_username = document.querySelector('#invalid_username');
        let mensaje_password = document.querySelector('#invalid_password');
        let mensaje_password_confirm = document.querySelector('#invalid_password_conf');
        let mensaje_rol = document.querySelector('#invalid_rol');

        //Expresion regular para verificar e-mail
        const expresion = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

        //Objeto con los valores de los inputs
        let n_usuario = {
            nombre : input_nombre.value,
            email : input_email.value,
            username : input_username.value,
            user_password : input_password.value,
            user_password_confirm : input_password_confirm.value,
            rol : select_roles.value
        };

        //Retorna false si el input nombre está vacío o es muy corto
        if (n_usuario.nombre === undefined || n_usuario.nombre === "" || n_usuario.nombre.length < 6) {
            input_nombre.classList.add('invalid-input');
            mensaje_nombre.innerHTML = "*Ingrese un nombre válido";
            mensaje_nombre.removeAttribute('hidden');
            input_nombre.focus();

            return false;
        } else{
            input_nombre.classList.remove('invalid-input');
            mensaje_nombre.innerHTML = "";
            mensaje_nombre.setAttribute('hidden', 'true');
        }

        //Retorna false si el input e-mail está vacío o no tiene el formato adecuado
        if (n_usuario.email === undefined || n_usuario.email === "" || !expresion.test(n_usuario.email)) {
            input_email.classList.add('invalid-input');
            mensaje_email.innerHTML = "*Ingrese un e-mail del válido";
            mensaje_email.removeAttribute('hidden');
            input_email.focus();
            return false;
        }else{
            input_email.classList.remove('invalid-input');
            mensaje_email.innerHTML = "";
            mensaje_email.setAttribute('hidden', 'true');
        }

        //Retorna false si el input username está vacío o es muy corto
        if (n_usuario.username === undefined || n_usuario.username === "" || n_usuario.username.length < 3) {
            input_username.classList.add('invalid-input');
            mensaje_username.innerHTML = "*Ingrese un nombre de usuario válido";
            mensaje_username.removeAttribute('hidden');
            input_username.focus();
            return false;
        } else{
            input_username.classList.remove('invalid-input');
            mensaje_username.innerHTML = "";
            mensaje_username.setAttribute('hidden', 'false');
        }

        //Retorna false si el input password está vacío o no cumple con la cantidad de caracteres
        if (n_usuario.user_password === undefined || n_usuario.user_password === "" || n_usuario.user_password.length < 6 || n_usuario.user_password.length > 12) {
            input_password.classList.add('invalid-input');
            mensaje_password.innerHTML = "*Ingrese una contraseña válida";
            mensaje_password.removeAttribute('hidden');
            input_password.focus();
            return false;
        }

        //Retorna false si el input password está vacío o no cumple con la cantidad de caracteres
        if (n_usuario.user_password_confirm !== n_usuario.user_password) {
            input_password_confirm.classList.add('invalid-input');
            mensaje_password_confirm.innerHTML = "*Las contraseñas no coinciden";
            mensaje_password_confirm.removeAttribute('hidden');
            input_password_confirm.focus();
            return false;
        } else{
            input_password_confirm.classList.remove('invalid-input');
            mensaje_password_confirm.innerHTML = "";
            mensaje_password_confirm.setAttribute('hidden', 'true');
        }

        //Retorna false si el select de roles está vacío
        if (n_usuario.rol == 0) {
            select_roles.classList.add('invalid-input');
            mensaje_rol.innerHTML = "*Seleccione un rol";
            mensaje_rol.removeAttribute('hidden');
            select_roles.focus();
            return false;
        }
    }

    function borrar_usuario(){
        let usuarios = [];
        
        <?php foreach ($usuarios as $usuario) { ?>
            usuarios.push(<?php $usuario; ?>);
        <?php } ?>

        console.log(usuarios);
    }
</script>

</html>