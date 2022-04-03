<?php
class Conexion{

    public $con; //Atributo $con, almacena la conexión

    //Método para conectar a la base de datos
    public function conectar(){
        $this->con = mysqli_connect("localhost", "root", "", "crud_usuarios");
    }
}
?>