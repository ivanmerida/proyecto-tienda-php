<?php
class Usuario
{
    protected $id;
    protected $nombre;
    protected $apellido;
    protected $correo;
    protected $password;
    protected $telefono;
    protected $rol;
    protected $db;

    public function __construct()
    {
        $this->db = ConnectionDB::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido): self
    {
        $this->apellido = $apellido;
        return $this;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo): self
    {
        $this->correo = $correo;
        return $this;
    }

    public function getPassword()
    {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $this->db->real_escape_string($telefono);

        return $this;
    }

    public function setRol($rol): self
    {
        $this->rol = $rol;
        return $this;
    }

    public function registrar()
    {
        $sql = "INSERT INTO usuarios VALUES(null, '{$this->getNombre()}', '{$this->getApellido()}',
        '{$this->getCorreo()}', '{$this->getPassword()}', '{$this->getTelefono()}','usuario')";
        $execute = $this->db->query($sql);
        $result = false;
        if ($execute) {
            $result = true;
        }
        return $result;
    }
    public function edit()
    {
        $sql = "UPDATE usuarios SET nombre='{$this->getNombre()}', apellido='{$this->getApellido()}', correo='{$this->getCorreo()}', telefono={$this->getTelefono()}, rol='{$this->getRol()}' WHERE id={$this->getId()}";
        $save = $this->db->query($sql);
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    public function loguear()
    {
        $result = false;
        $correo = $this->correo;
        $password = $this->password;
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
        $execute = $this->db->query($sql);
        if ($execute && $execute->num_rows == 1) {
            $user = $execute->fetch_object();
            $verify = password_verify($password, $user->password);
            if ($verify) {
                $result = $user;
            }
        }
        return $result;
    }
    public function getUsuarios(){
        $sql = "SELECT * FROM usuarios ORDER BY id DESC";
        $execute = $this->db->query($sql);
        return $execute;
    }
    public function getOne(){
        $usuario = $this->db->query("SELECT * FROM usuarios WHERE id={$this->getId()}");
        return $usuario->fetch_object();
    }
    public function changePassword(){
        $sql = "UPDATE usuarios SET password='{$this->getPassword()}' WHERE id={$this->getId()}";
        $save = $this->db->query($sql);
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    
}
