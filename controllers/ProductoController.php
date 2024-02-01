<?php
require_once 'models/Producto.php';
require_once 'models/Categoria.php';
class ProductoController
{
    public function index()
    {
        $producto = new Producto();
        $productos = $producto->getRamdom(6);
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();
        require_once 'views/producto/pagina_principal.php';
    }
    public function ver()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $producto = new Producto();
            $producto->setId($id);
            $product = $producto->getOne();
        }
        require_once 'views/producto/ver.php';
    }
    public function oferta()
    {
        $producto = new Producto();
        $productos = $producto->getProductoOferta();
        require_once 'views/producto/oferta.php';
    }

    public function busqueda()
    {
        if (isset($_POST['buscar'])) {
            $buscar = $_POST['buscar'];
            $producto = new Producto();
            $limit = 6;
            $productos = $producto->buscar($buscar, $limit);
            require_once 'views/producto/busqueda.php';
        }
    }
    public function gestion()
    {
        Utils::isAdmin();
        $producto = new Producto();
        if (isset($_POST['categoria']) && $_POST['categoria'] != '') {
            $categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : false;
            $productos = $producto->getProductosGestionar($categoria);
        }else{
            $productos = $producto->getProductos();
        }
        
        require_once 'views/producto/gestionar.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }
    public function save()
    {
        Utils::isAdmin();

        if (isset($_POST)) {
            $categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : false;
            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $stock = isset($_POST["stock"]) ? $_POST["stock"] : false;
            $talla = isset($_POST["tallas"]) ? $_POST["tallas"] : false;
            $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : false;
            $marca = isset($_POST["marca"]) ? $_POST["marca"] : false;
            $precio = isset($_POST["precio"]) ? $_POST["precio"] : false;
            $oferta = isset($_POST["oferta"]) ? $_POST["oferta"] : false;

            //$imagen = isset($_POST["imagen"]) ? $_POST["imagen"] : false;

            if ($categoria && $nombre && $stock && $talla && $descripcion && $marca && $precio && $oferta) {
                $producto = new Producto();
                $producto->setCategoria_id($categoria);
                $producto->setNombre($nombre);
                $producto->setStock($stock);
                $producto->setTalla($talla);
                $producto->setDescripcion($descripcion);
                $producto->setMarca($marca);
                $producto->setPrecio($precio);
                $producto->setOferta($oferta);

                // Guardar la imagen
                if (isset($_FILES['imagen'])) {
                    $file = $_FILES["imagen"];
                    $filename = $file["name"];
                    $mimetype = $file["type"];

                    if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {

                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }

                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                        $producto->setImagen($filename);
                    }
                }

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                } else {
                    $save = $producto->save();
                }

                if ($save) {
                    $_SESSION['producto'] = 'complete';
                } else {
                    $_SESSION['producto'] = 'failed';
                }
            } else {
                $_SESSION['producto'] = 'failed';
            }
        } else {
            $_SESSION['producto'] = 'failed';
        }
        header('Location:' . base_url . 'producto/gestion');
    }
    public function editar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();
            require_once 'views/producto/crear.php';
        } else {
            header('Location:' . base_url . 'producto/gestion');
        }
    }

    public function eliminar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);

            $delete = $producto->delete();
            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header('Location:' . base_url . 'producto/gestion');
    }
}
