<?php

class UsuariosController extends BaseController{

    private $usuario;

    public function __construct() {
        parent::__construct();
        require_once('models/usuarios.php');

        $this->pc = new Usuarios();
        $this->entity = "Usuarios";

    }

    public function index() {
        // we store all the posts in a variable
        $posts = $this->pc->getAll();
        $this->view("index", $this->entity, array(
            "first_name" => "Estudiante",
            "last_name" => "UCM",
            "posts" => $posts
        ));
    }

    public function login()
    {
      # code...
      $username = $_POST["username"];
      $password = md5($_POST["password"]);
      $ckLogin = $this->pc->ckLogin($username, $password);

      if ( $ckLogin == 0) {
        header('Location:index.php?controller=Partidos&action=inicio&success=' . $ckLogin );
      } else {
        header('Location:index.php?controller=View&action=login');
      }

    }

    public function register()
    {
      $username = $_POST["username"];
      $distrito = $_POST["distrito"];
      $mail = $_POST["mail"];
      $password = md5($_POST["password"]);
      $password2 = md5($_POST["password2"]);
      $ckRegister = $this->pc->ckRegister($username, $distrito, $mail, $password, $password2);

      if ( $ckRegister == 0) {
        header('Location:index.php?controller=Partidos&action=inicio&success=' . $ckRegister );
      } else {
        header('Location:index.php?controller=View&action=register&error=' . $ckRegister);
      }

    }

    public function perfil() {
      session_start();

      $data = $this->pc->getBy("id", $_SESSION["username"]);

      $this->view("perfil", $this->entity, array(
          "data" => $data
      ));


    }
}

?>