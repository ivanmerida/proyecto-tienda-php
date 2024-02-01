<?php
require_once 'models/Usuario.php';
class UsuarioController
{
    public function signIn()
    {
        require_once 'views/usuario/signin.php';
    }
    public function logIn()
    {
        require_once 'views/usuario/login.php';
    }

    public function change()
    {
        Utils::isIdentity();
        if (isset($_GET['id'])) {
            $usuario_id = $_GET['id'];
            require_once 'views/usuario/cambiar.php';
        }
    }
    public function registrar()
    {
        if (isset($_POST)) {
            $db = ConnectionDB::connect();
            $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
            $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
            $correo = isset($_POST['correo']) ? mysqli_real_escape_string($db, $_POST['correo']) : false;
            $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;
            $telefono = isset($_POST['telefono']) ? mysqli_real_escape_string($db, $_POST['telefono']) : false;


            $errores = array();

            if (empty($nombre) || $nombre == false || is_numeric($nombre) || preg_match('/[0-9]/', $nombre)) {
                $errores['nombre'] = '¡El nombre no es valido!';
            }
            if (empty($apellido) || $apellido == false || is_numeric($apellido) || preg_match('/[0-9]/', $apellido)) {
                $errores['apellido'] = '¡Apellido no valido!';
            }
            if (empty($correo) || $correo == false || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $errores['correo'] = '¡El correo no es valido!';
            }
            if (empty($password) || $password == false) {
                $errores['password'] = '¡La contraseña no es valida!';
            }
            if (empty($telefono) || $telefono == false) {
                $errores['telefono'] = '¡El telefono no es valido!';
            }

            if (count($errores) == 0) {
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellido($apellido);
                $usuario->setcorreo($correo);
                $usuario->setPassword($password);
                $usuario->setTelefono($telefono);

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $usuario->setId($id);
                    $rol = isset($_POST['rol']) ? mysqli_real_escape_string($db, $_POST['rol']) : false;
                    $usuario->setRol($rol);
                    $registrar = $usuario->edit();
                } else {
                    $registrar = $usuario->registrar();
                }

                if ($registrar) {
                    $_SESSION['register'] = 'complete';
                } else {
                    $_SESSION['register'] = 'failed';
                }
            } else {
                $_SESSION['errores'] = $errores;
            }
        } else {
            $_SESSION['register'] = 'failed';
        }
        if ($_SESSION['register'] == 'failed' || count($errores) != 0) {
            header("Location:" . base_url . 'Usuario/signIn');
        } else {
            header("Location:" . base_url);
        }
    }

    public function loguear()
    {
        if (isset($_POST)) {
            $db = ConnectionDB::connect();
            $correo = isset($_POST['correo']) ? mysqli_real_escape_string($db, $_POST['correo']) : false;
            $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

            $errores = array();

            if (empty($correo) || $correo == false || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $errores['correo'] = '¡El correo no es valido!';
            }
            if (empty($password) || $password == false) {
                $errores['password'] = '¡La contraseña no es valida!';
            }
            if (count($errores) == 0) {
                $user = new Usuario();
                $user->setcorreo($correo);
                $user->setPassword($password);
                $identity = $user->loguear();
                if ($identity && is_object($identity)) {
                    $_SESSION['identity'] = $identity;
                    if ($identity->rol == 'administrador') {
                        $_SESSION['administrador'] = true;
                    }
                } else {
                    $_SESSION['error_login'] = 'Identificacion Fallida!';
                }
            } else {
                $_SESSION['errores'] = $errores;
            }
        }
        if (!isset($_POST) || isset($_SESSION['error_login']) || count($errores) != 0) {
            header("Location:" . base_url . 'Usuario/logIn');
        } else {
            header("Location:" . base_url);
        }
    }

    public function logOut()
    {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION['administrador'])) {
            unset($_SESSION['administrador']);
        }
        header("Location:" . base_url);
    }
    
    

    public function cambiar()
    {
        Utils::isIdentity();
        if (isset($_POST)) {
            $db = ConnectionDB::connect();
            $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;
            $errores = array();
            if (empty($password) || $password == false) {
                $errores['password'] = '¡La contraseña no es valida!';
            }
            if (count($errores) == 0) {
                $usuario = new Usuario();
                $usuario->setPassword($password);
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $usuario->setId($id);
                    $usuario->changePassword();
                }
                header("Location:" . base_url);
            }else {
                $_SESSION['errores'] = $errores;
            }
        } else {
            header("Location:" . base_url);
        }
    }
    public function gestionar()
    {
        Utils::isAdmin();
        $usuario = new Usuario();
        $usuarios = $usuario->getUsuarios();
        require_once 'views/usuario/gestionar.php';
    }

    public function update()
    {
        Utils::isIdentity();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $editar = true;

            $usuario = new Usuario();
            $usuario->setId($id);
            $usuario = $usuario->getOne();
            require_once 'views/usuario/modificar.php';
        } else {
            header('Location:' . base_url . 'usuario/gestionar');
        }
    }

    public function delete()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);

            $delete = $categoria->delete();
            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header('Location:' . base_url . 'categoria/gestionar');
    }
}
