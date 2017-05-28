<?php


/**
 *
 */
class Participantes extends EntityBase
{

  private $partido;
  private $usuario;
  private $equipo;

  function __construct()
  {
    $this->table = 'participantes';
    $this->class = "Participantes";
    parent::__construct($this->table, $this->class);
  }

  public function create() {

      $insert = $this->db()->prepare("INSERT INTO partidos (partido, usuario, equipo) VALUES (?, ?, ?)");

      $insert->bindParam(1, $this->partido);
      $insert->bindParam(2, $this->usuario);
      $insert->bindParam(3, $this->equipo);

      //Ejecutar la sentencia preparada
      $insert->execute();
  }

  public function getEquipo1($id){
    $query=$this->db()->query("SELECT * FROM $this->table WHERE partido = '$id' and equipo = '1'"); //ORDER BY id DESC
    $resultSet = $query->fetchAll(PDO::FETCH_CLASS, $this->class);
    return $resultSet;
  }

  public function getEquipo2($id){
    $query=$this->db()->query("SELECT * FROM $this->table WHERE partido = '$id' and equipo = '2'"); //ORDER BY id DESC
    $resultSet = $query->fetchAll(PDO::FETCH_CLASS, $this->class);
    return $resultSet;
  }

  //GETTERS
  public function getPartido() {
    return $this->partido;
  }
  //SETTERS
  public function setPartpartidoo($partido) {
    $this->partido = $partido;
  }

  //GETTERS
  public function getUsuario() {
    return $this->usuario;
  }
  //SETTERS
  public function setUsuario($usuario) {
    $this->usuario = $usuario;
  }

  //GETTERS
  public function getEquipo() {
    return $this->equipo;
  }
  //SETTERS
  public function setEquipo($equipo) {
    $this->equipo = $equipo;
  }
}
 ?>