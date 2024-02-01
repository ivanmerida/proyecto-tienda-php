<?php
class Producto
{
    protected $id;
    protected $categoria_id;
    protected $nombre;
    protected $stock;
    protected $talla;
    protected $descripcion;
    protected $marca;
    protected $precio;
    protected $oferta;
    protected $fecha;
    protected $imagen;
    protected $db;
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

    public function getCategoria_id()
    {
        return $this->categoria_id;
    }

    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);

        return $this;
    }
    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);

        return $this;
    }
    public function getTalla()
    {
        return $this->talla;
    }

    public function setTalla($talla)
    {
        $this->talla = $this->db->real_escape_string($talla);

        return $this;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);

        return $this;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function setMarca($marca)
    {
        $this->marca = $this->db->real_escape_string($marca);

        return $this;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string($precio);

        return $this;
    }

    public function getOferta()
    {
        return $this->oferta;
    }

    public function setOferta($oferta)
    {
        $this->oferta = $this->db->real_escape_string($oferta);
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

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }
    public function getAllCategory()
    {
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p INNER JOIN  categorias c ON c.id = p.categoria_id WHERE p.categoria_id = {$this->getCategoria_id()} AND p.stock >= 1 ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getProductos()
    {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
        return $productos;
    }
    public function getProductosGestionar($categoria_seleccionada){
        $productos = $this->db->query("SELECT * FROM productos WHERE categoria_id = $categoria_seleccionada;");
        return $productos;
    }
    public function getOne()
    {
        $producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
        return $producto->fetch_object(); // devuelto siendo un objeto usable
    }

    public function getRamdom($limit)
    {
        $sql = "SELECT * FROM productos WHERE stock >=1 ORDER BY rand() LIMIT $limit";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getProductoOferta(){
        $sql = "SELECT * FROM productos WHERE oferta = 'SI'";
        $productos = $this->db->query($sql);
        return $productos;
    }
    public function buscar($buscar, $limit)
    {
        $sql = "SELECT * FROM productos ";
        if (!empty($buscar) && $buscar != null) {
            $sql .= "WHERE nombre LIKE '%$buscar%' ";
        }
        $sql .= 'ORDER BY id DESC ';
        if (!empty($limit) && $limit != null) {
            $sql .= "LIMIT $limit";
        }
        $buscar = $this->db->query($sql);
        if ($buscar->num_rows > 0) {
            return $buscar;
        }
        return false;
    }
    public function save()
    {
        $sql = "INSERT INTO productos VALUES (NULL,{$this->getCategoria_id()}, '{$this->getNombre()}',{$this->getStock()},'{$this->getTalla()}', '{$this->getDescripcion()}','{$this->getMarca()}',{$this->getPrecio()},'{$this->getOferta()}', CURDATE(), '{$this->getImagen()}');";
        $save = $this->db->query($sql);
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    public function edit()
    {
        $sql = "UPDATE productos SET nombre='{$this->getNombre()}', categoria_id={$this->getCategoria_id()}, descripcion='{$this->getDescripcion()}', precio = {$this->getPrecio()}, stock={$this->getStock()}, marca='{$this->getMarca()}', talla='{$this->getTalla()}', oferta='{$this->getOferta()}'";

        if ($this->getImagen() != null) {
            $sql .= ", imagen='{$this->getImagen()}'";
        }
        $sql .= " WHERE id={$this->id}";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    public function delete()
    {
        $sql = "DELETE FROM productos WHERE id= {$this->id}";
        $delete = $this->db->query($sql);
        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }
    public function updateStock($id, $newStock)
    {
        $sql = "UPDATE productos SET stock = $newStock WHERE id = $id";

        $update = $this->db->query($sql);

        $result = false;
        if ($update) {
            $result = true;
        }
        return $result;
    }

}
