<?php

  /**
   * Clase para registrar
   */
  class UsuariosModel {

    public function registrarUsuario($cedula,$usuario,$contrasena,$tipo,$registro){
      $conexion = new Conexion;
      $conectar = $conexion->obtenerConexionMy();
      $sql = "INSERT INTO usuarios (Cedula, Usuario, contrasena, Tipo, Nivel, Registro, Fecha) VALUES (:Cedula,:Usuario,:contrasena,:Tipo,:Nivel,:Registro,now())";


      $preparar = $conectar->prepare($sql);
      $preparar->bindValue(':Cedula',$cedula);
      $preparar->bindValue(':Usuario',$usuario);
      $preparar->bindValue(':contrasena',$contrasena);
      $preparar->bindValue(':Tipo',$tipo);
      $preparar->bindValue(':Nivel','2');
      $preparar->bindValue(':Registro','1');

      if (!$preparar) {
        return "Error no pudo registrar el usuario";
      }else{
        $preparar->execute();
        return "Usuario registrado exitosamente";
      }
    }

    public function comprobarCedulaUsu($cedula){
      $conexion = new Conexion;
      $conectar = $conexion->obtenerConexionMy();
      $sql = "SELECT * FROM usuarios WHERE Cedula = '$cedula'";
      $preparar = $conectar->prepare($sql);
      $preparar->execute();
      $num_row = $preparar->fetchAll();
      if (count($num_row) > 0){
        return true;
      }else {
        return false;
      }
    }

    public function comprobarCedulaAsoc($cedula){
      $conexion = new Conexion;
      $conectar = $conexion->obtenerConexionMy();
       $sql = "SELECT * FROM asoc WHERE CEDULA = '$cedula'";

      $preparar = $conectar->prepare($sql);
      $preparar->execute();

      $num_row = $preparar->fetchAll();

      if (count($num_row) > 0) {
        return true;
      }else {
        return false;
      }
    }

    public function validaUsu($usuario){
      $conexion = new Conexion;
      $conectar = $conexion->obtenerConexionMy();
      $sql = "SELECT * FROM usuarios WHERE Usuario = '$usuario'";

      $preparar = $conectar->prepare($sql);
      $preparar->execute();
      $num_row = $preparar->fetchAll();

      if (count($num_row) > 0) {
        return true;
      }else {
        return false;
      }
    }

    /**
    * Metodo para mostrar los datos personales de la persona que
    * inicio sesion
    */
    public function datosUsuario($cedula){
      $conexion = new Conexion;
      $conectar = $conexion->obtenerConexionMy();
      $sql = "SELECT * FROM asoc WHERE CEDULA = '$cedula'";
      $preparar = $conectar->prepare($sql);
      $preparar->execute();
      $array = $preparar->fetch(PDO::FETCH_ASSOC);
      return $array;
    }
  }
 ?>
