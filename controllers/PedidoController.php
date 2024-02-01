<?php
require_once 'models/pedido.php';

class pedidoController
{
    public function add()
    {
        if (isset($_SESSION['identity'])) {
            $usuario_id = $_SESSION['identity']->id;
            $municipio = isset($_POST['municipio']) ? $_POST['municipio'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $referencia = isset($_POST['referencia']) ? $_POST['referencia'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $stats = Utils::statsCarrito();
            $coste = $stats['total'];
            if ($municipio && $localidad && $direccion) {
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setMunicipio($municipio);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setReferencia($referencia);
                $pedido->setTelefono($telefono);
                $pedido->setCoste($coste);
                $insert = $pedido->save();                
                //Guardar linea de pedido
                if ($insert) {
                    $insert_linea = $pedido->save_linea();
                    if ($insert_linea) {
                        foreach ($_SESSION['carrito'] as $indice => $elemento) {
                            //var_dump($_SESSION['carrito']); die();
                            require_once 'models/Producto.php';
                            $pro = $elemento['producto'];
                            $id = $pro->id;
                            $unidades = $elemento['unidades'];

                            $producto = new Producto();
                            $producto->setId($id);
                            $details_producto = $producto->getOne();
                            $newStock = ($details_producto->stock - $unidades);
                            $updateStock = $producto->updateStock($id, $newStock);
                            if ($updateStock) {
                                $_SESSION['pedido'] = 'complete';
                            } else {
                                $_SESSION['pedido'] = 'failed';
                            }
                        }
                    } else {
                        $_SESSION['pedido'] = 'failed';
                    }
                } else {
                    $_SESSION['pedido'] = 'failed';
                }
            } else {
                $_SESSION['pedido'] = 'failed';
            }
            header('Location:' . base_url . 'Pedido/confirmado');
        } else {
            header('Location:' . base_url);
        }
    }
    public function confirmado()
    {
        if (isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];
            $pedido_obj = new Pedido();
            $pedido_obj->setUsuario_id($identity->id);
            $pedido = $pedido_obj->getPedidoByUser();
            $pedido_productos = new Pedido();
            $pedido_productos->setId($pedido->id);
            $productos = $pedido_productos->getProductosByPedido();
            require_once 'views/pedido/confirmado.php';
        }
    }
    public function hacer()
    {
        require_once 'views/pedido/hacer.php';
    }
    public function mis_pedidos()
    {
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id; // para versiones de php 5 en adelante, para acceder con flecha
        $pedido = new Pedido();
        // Sacar los pedidos del usuario
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getPedidosByUser();
        require_once 'views/pedido/mis_pedidos.php';
    }
    public function gestion()
    {
        Utils::isAdmin();
        $gestion = true;
        $pedido = new Pedido();
        if (isset($_POST['fecha'])) {
            $fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : false;
            $pedido->setFecha($fecha);
            $pedidos = $pedido->getPedidosByDate();
        } else if (isset($_POST['fecha2'])){
            $fecha2 = isset($_POST["fecha2"]) ? $_POST["fecha2"] : false;
            $pedido->setFecha($fecha2);
            $pedidos = $pedido->getPedidosByDate();
        } else{
            $pedidos = $pedido->getPedidos();
        }
        
        require_once 'views/pedido/mis_pedidos.php';
    }
    public function detalle()
    {
        Utils::isIdentity();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //Sacar pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getPedido();
            //Sacar productos
            $pedido_productos = new Pedido();
            $pedido_productos->setId($id);
            $productos = $pedido_productos->getProductosByPedido();
            require_once 'views/pedido/detalle.php';
        } else {
            header('Location:' . base_url . 'Pedido/mis_pedidos');
        }
    }
    public function estado()
    {
        Utils::isAdmin();
        if (isset($_POST) && isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            $id = $_POST['pedido_id'];
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($_POST['estado']);
            $pedido->update();
            header('Location:' . base_url . 'Pedido/detalle&id=' . $id);
        } else {
            header('Location:' . base_url);
        }
    }
}
