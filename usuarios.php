<?php
include_once "conexion.php";

class Usuario extends Conexion{
    private $id_user;
    private $nombre;
    private $email;
    private $username;
    private $user_password;
    private $rol_id;

    //Stters
    public function set_nombre($n_nombre){
        $this->nombre = $n_nombre;
    }

    public function set_email($n_email){
        $this->email = $n_email;
    }

    public function set_username($n_username){
        $this->username = $n_username;
    }

    public function set_user_password($n_user_password){
        $this->user_password = $n_user_password;
    }

    public function set_rol($n_rol){
        $this->rol_id = $n_rol;
    }

    //Getters
    public function get_id_user(){
        return $this->id_user;
    }

    public function get_nombre(){
        return $this->nombre;
    }

    public function get_email(){
        return $this->email;
    }

    public function get_username(){
        return $this->username;
    }

    public function get_user_password(){
        return $this->user_password;
    }

    public function get_rol(){
        return $this->rol_id;
    }

    //Obtener un objeto Usuario por su id
    public static function getByID($id){
        $conexion = new Conexion();
        $conexion->conectar();

        $pre = mysqli_prepare($conexion->con, "SELECT * FROM usuarios WHERE id_user = ?");
        $pre->bind_param("i", $id);
        $pre->execute();

        $res = $pre->get_result();
    
        return $res->fetch_object(Usuario::class);
    }

    //Create
    public function create_user(){

        $this->conectar();
        
        $pre = mysqli_prepare($this->con, "INSERT INTO usuarios(id_user,nombre,email,username,user_password,rol_id) VALUES (?, ?, ?, ?, ?, ?)");
        if ($pre){
            $pre->bind_param("issssi", $this->id_user, $this->nombre, $this->email, $this->username, $this->user_password, $this->rol_id);

            $pre->execute();
            return true;
        }
        else{
            echo("Ha ocurrido un error en el registro");
            return false;
        }
    }

    //Read
    public static function read_users(){
        $conexion = new Conexion();
        $conexion->conectar();
        $pre = mysqli_prepare($conexion->con, "SELECT * FROM usuarios INNER JOIN roles WHERE usuarios.rol_id = roles.rol_id ");
        $pre->execute();
        $res = $pre->get_result();
        $usuarios = [];

        while ($usuario = $res->fetch_object(Usuario::class)) {
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }

    //Update
    public function update_user(){
        $this->conectar();

        $pre = mysqli_prepare($this->con, "UPDATE usuarios SET nombre = ?, email = ?, username = ?, user_password = ?, rol_id = ? WHERE id_user = ?");

        $pre->bind_param("ssssii", $this->nombre, $this->email, $this->username, $this->user_password, $this->rol_id, $this->id_user);

        $pre->execute();
    }

    //Delete
    public function delete_user($id){
        $this->conectar();

        $pre = mysqli_prepare($this->con, "DELETE * FROM usuarios WHERE id_user = ?");
        $pre->bind_param("i", $id);
        $pre->execute();
    }

    //
}
?>