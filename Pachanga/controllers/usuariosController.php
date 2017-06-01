<?php

class UsuariosController extends BaseController{

    private $usuario;
    private $distrito;
    private $partido;

    public function __construct() {
        parent::__construct();
        require_once('models/usuarios.php');
        require_once('models/distritos.php');
        require_once('models/partidos.php');
        $this->usuario = new Usuarios();
        $this->distrito = new Distritos();
        $this->partido = new Partidos();
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
      $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
      $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
      $ckLogin = $this->usuario->ckLogin($username, $password);

      if ( $ckLogin == 0) {
        header('Location:index.php?controller=Partidos&action=inicio&success=' . $ckLogin );
      } else {
        header('Location:index.php?controller=View&action=login');
      }

    }

    public function register()
    {
      $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
      $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
      $distrito = filter_var($_POST['distrito'], FILTER_SANITIZE_STRING);
      $mail = filter_var($_POST['mail'], FILTER_SANITIZE_STRING);

      $salt = substr(str_replace('+','.',base64_encode(md5(mt_rand(), true))),0,16);
      $rounds = 10000;

      $password = crypt(filter_var($_POST['password'], FILTER_SANITIZE_STRING), sprintf('$5$rounds=%d$%s$', $rounds, $salt));;
      $password2 = crypt(filter_var($_POST['password2'], FILTER_SANITIZE_STRING), sprintf('$5$rounds=%d$%s$', $rounds, $salt));;


      $ckRegister = $this->usuario->ckRegister($username, $nombre, $distrito, $mail, $password, $password2);

      if ( $ckRegister == 0) {
        header('Location:index.php?controller=Partidos&action=inicio&success=' . $ckRegister );
      } else {
        header('Location:index.php?controller=View&action=register&error=' . $ckRegister);
      }

    }

    public function perfil() {
      session_start();

      $usuario = $_GET["id"];
      $data = $this->usuario->getBy("id", $_SESSION["username"]);
      $user = $this->usuario->getBy("id", $usuario);
      $partidos = $this->partido->misCreados($usuario);

      $this->view("perfil", $this->entity, array(
          "data" => $data,
          "user" => $user,
          "partidos" => $partidos
      ));
    }

    public function mejores(){
      session_start();

      $data = $this->usuario->getBy("id", $_SESSION["username"]);
      $mejores = $this->usuario->mejores($data[0]->getDistrito());
      $miDistrito = $this->distrito->getBy("id", $data[0]->getDistrito());
      $this->view("mejores", $this->entity, array(
          "data" => $data,
          "miDistrito" => $miDistrito,
          "mejores" => $mejores
      ));
    }


}

?>
