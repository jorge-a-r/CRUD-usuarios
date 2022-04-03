const vista_users = document.querySelector('#vista_usuarios');
const vista_roles = document.querySelector('#vista_roles');

vista_users.addEventListener('click', function(){
    window.location.replace("vista_usuarios.php");
});

vista_roles.addEventListener('click', function(){
    window.location.replace('vista_roles.php');
});