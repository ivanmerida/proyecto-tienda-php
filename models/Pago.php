<?php
class Pago
{
    protected $id;
    protected $id_transaccion;
    protected $fecha;
    protected $status;
    protected $email;
    protected $id_cliente;
    protected $total;

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
        $this->id = $this->db->real_escape_string($id);

        return $this;
    }

    public function getId_transaccion()
    {
        return $this->id_transaccion;
    }

    public function setId_transaccion($id_transaccion)
    {
        $this->id_transaccion = $this->db->real_escape_string($id_transaccion);

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

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $this->db->real_escape_string($status);

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);

        return $this;
    }

    public function getId_cliente()
    {
        return $this->id_cliente;
    }

    public function setId_cliente($id_cliente)
    {
        $this->id_cliente = $this->db->real_escape_string($id_cliente);

        return $this;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }
    public function guardar(){
        $sql = "INSERT INTO pagos (id, id_transaccion, fecha, status, email, id_cliente, total)
        VALUES (null, '{$this->getId_transaccion()}', '{$this->getFecha()}',
        '{$this->getStatus()}', '{$this->getEmail()}', '{$this->getId_cliente()}', {$this->getTotal()})";
        $execute = $this->db->query($sql);
        $id = false;
        if ($execute) {
            $sql2 = "SELECT LAST_INSERT_ID() AS 'id'";
            $execute2= $this->db->query($sql2);
            $id = $execute2->fetch_object()->id;
            return $id;
        }
        return false;
    }
}
