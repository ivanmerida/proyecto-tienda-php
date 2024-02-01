<?php
class Pedido
{
    private $id;
    private $usuario_id;
    private $pago_id;
    private $municipio;
    private $localidad;
    private $direccion;
    private $referencia;
    private $telefono;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    public function __construct()
    {
        $this->db = ConnectionDB::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;

        return $this;
    }

    public function getPago_id()
    {
        return $this->pago_id;
    }

    public function setPago_id($pago_id)
    {
        $this->pago_id = $pago_id;

        return $this;
    }

    public function getMunicipio()
    {
        return $this->municipio;
    }

    public function setMunicipio($municipio)
    {
        $this->municipio = $this->db->real_escape_string($municipio);

        return $this;
    }

    public function getLocalidad()
    {
        return $this->localidad;
    }

    public function setLocalidad($localidad)
    {
        $this->localidad = $this->db->real_escape_string($localidad);

        return $this;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $this->db->real_escape_string($direccion);

        return $this;
    }

    public function getCoste()
    {
        return $this->coste;
    }

    public function setCoste($coste)
    {
        $this->coste = $coste;

        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;
        return $this;
    }
    public function getReferencia()
    {
        return $this->referencia;
    }

    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;
        return $this;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
        return $this;
    }

    public function getPedido()
    {
        $sql = "SELECT p.*, concat(u.nombre, ' ', u.apellido) as nombre, u.correo FROM pedidos p
        INNER JOIN usuarios u ON p.usuario_id = u.id WHERE p.id = {$this->getId()}";
        $producto = $this->db->query($sql);
        return $producto->fetch_object();
    }
    public function getPedidos()
    {
        $sql = "SELECT * FROM pedidos ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }
    public function getPedidosByDate(){
        $sql = "SELECT * FROM pedidos WHERE fecha='{$this->getFecha()}' ORDER BY id DESC";
        $pedidos = $this->db->query($sql);
        return $pedidos;
    }
    
    public function getFechas(){
        $sql = "SELECT fecha FROM pedidos ORDER BY fecha DESC";
        $fechas = $this->db->query($sql);
        return $fechas;
    }
    public function getPedidoByUser()
    {
        $sql = "SELECT id, coste FROM pedidos WHERE usuario_id = {$this->getUsuario_id()} ORDER BY
        id DESC LIMIT 1";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }
    
    public function getPedidosByUser()
    {
        $sql = "SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";
        $pedido = $this->db->query($sql);
        return $pedido;
    }
    public function getProductosByPedido()
    {
        $sql = "SELECT p.*, lp.unidades FROM productos p INNER JOIN lineas_pedidos lp
        ON p.id = lp.producto_id WHERE lp.pedido_id = {$this->getId()}";
        $productos = $this->db->query($sql);
        return $productos;
    }
    
    public function save()
    {
        $sql = "INSERT INTO pedidos(id, usuario_id, municipio, localidad, direccion,
        referencia, telefono, coste, estado, fecha, hora) VALUES(null, {$this->getUsuario_id()}, '{$this->getMunicipio()}',
                    '{$this->getLocalidad()}', '{$this->getDireccion()}', '{$this->getReferencia()}' , '{$this->getTelefono()}', {$this->getCoste()}, 'SIN PAGAR', curdate(), curtime())";
        $save = $this->db->query($sql);
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function save_linea()
    {
        $sql = "SELECT LAST_INSERT_ID() AS 'pedido'";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        foreach ($_SESSION['carrito'] as $indice => $elemento) {
            //var_dump($_SESSION['carrito']); die();
            $producto = $elemento['producto'];
            $insert = "INSERT INTO lineas_pedidos VALUES (null, {$pedido_id}, {$producto->id}, {$elemento['unidades']})";
            $save = $this->db->query($insert);
        }
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    public function update()
    {
        $sql = "UPDATE pedidos SET estado ='{$this->getEstado()}' WHERE id = {$this->getId()}";
        $update = $this->db->query($sql);
        $result = false;
        if ($update) {
            $result = true;
        }
        return $result;
    }
    public function updatePago(){
        $sql = "UPDATE pedidos SET pago_id = {$this->getPago_id()}, estado ='{$this->getEstado()}' WHERE id = {$this->getId()}";
        $execute = $this->db->query($sql);
        $result = false;
        if ($execute) {
            $result = true;
        }
        return $result;
    }
}
