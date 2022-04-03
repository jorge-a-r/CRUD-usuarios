<?php
include_once "conexion.php";

class Rol extends Conexion{
    private $rol_id;
    private $nombre_rol;

    //Setters
    public function set_rol_id($id){
        $this->rol_id = $id;
    }

    public function set_nombre_rol($nombre){
        $this->nombre_rol = $nombre;
    }

    //Getters
    public function get_rol_id(){
        return $this->rol_id;
    }

    public function get_nombre_rol(){
        return $this->nombre_rol;
    }

    //Obtener un rol por su ID
    public static function getByID($id){
        $conexion = new Conexion();
        $conexion->conectar();

        $pre = mysqli_prepare($conexion->con, "SELECT * FROM roles WHERE rol_id = ?");
        $pre->bind_param("i", $id);
        $pre->execute();

        $res = $pre->get_result();
    
        return $res->fetch_object(Rol::class);
    }

    //Create
    public function create_rol(){

        $this->conectar();
        
        $pre = mysqli_prepare($this->con, "INSERT INTO roles(rol_id,nombre_rol) VALUES (?, ?)");
        
        $pre->bind_param("is", $this->rol_id, $this->nombre_rol);

        $pre->execute();
    }

    //Read
    public static function read_roles(){
        $conexion = new Conexion();
        $conexion->conectar();
        $pre = mysqli_prepare($conexion->con, "SELECT * FROM roles WHERE 1");
        $pre->execute();
        $res = $pre->get_result();
        $roles = [];

        while ($rol = $res->fetch_object(Rol::class)) {
            array_push($roles, $rol);
        }

        return $roles;
    }

    //Update
    public function update_rol(){
        $this->conectar();

        $pre = mysqli_prepare($this->con, "UPDATE roles SET rol_id = ?, nombre_rol = ? WHERE rol_id = ?");

        $pre->bind_param("isi", $this->rol_id, $this->nombre_rol, $this->rol_id);

        $pre->execute();
    }

    //Delete
    public function delete_rol(){
        $this->conectar();

        $pre = mysqli_prepare($this->con, "DELETE * FROM roles WHERE rol_id = ?");
        $pre->bind_param("i", $this->rol_id);
        $pre->execute();
    }
}
?>