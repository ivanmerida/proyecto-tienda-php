<?php
require_once 'models/Categoria.php';
require_once 'models/Producto.php';
class CategoriaController
{
    public function listarCategorias()
    {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();
        require_once 'views/producto/pagina_principal.php';
    }
    public function mostrar()
    {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();
        require_once 'views/categoria/listar_categorias.php';
    }
    public function gestionar()
    {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();
        require_once 'views/categoria/gestionar.php';
    }
    public function ver()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Conseguir categoria 
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();

            // Conseguir productos
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
        }
        require_once 'views/categoria/ver.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }
    public function update()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $editar = true;

            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();
            require_once 'views/categoria/crear.php';
        } else {
            header('Location:' . base_url . 'categoria/gestionar');
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
    public function save()
    {
        Utils::isAdmin();
        if (isset($_POST)) {
            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;

            if (!$nombre == false) {
                $categoria = new Categoria();
                $categoria->setNombre($nombre);
                // Guardar la imagen
                if (isset($_FILES['imagen'])) {
                    $file = $_FILES["imagen"];
                    $filename = $file["name"];
                    $mimetype = $file["type"];

                    if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {

                        if (!is_dir('uploads/categoria-images')) {
                            mkdir('uploads/categoria-images', 0777, true);
                        }

                        move_uploaded_file($file['tmp_name'], 'uploads/categoria-images/' . $filename);
                        $categoria->setImagen($filename);
                    }
                }


                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $categoria->setId($id);
                    $save = $categoria->edit();
                } else {
                    $save = $categoria->insert();
                }

                if ($save) {
                    $_SESSION['categoria'] = 'complete';
                } else {
                    $_SESSION['categoria'] = 'failed';
                }
            } else {
                $_SESSION['categoria'] = 'failed';
            }
        } else {
            $_SESSION['categoria'] = 'failed';
        }

        header('Location: ' . base_url . 'categoria/gestionar');
    }
}
