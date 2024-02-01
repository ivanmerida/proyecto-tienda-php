<?php
require_once 'models/pago.php';
require_once 'models/pedido.php';    
class PagoController{
    public function guardar(){
        Utils::isIdentity();
        if(isset($_GET['status']) && $_GET["status"] == "COMPLETED"){
            $pedido_id = isset($_GET['pedido_id']) ? $_GET['pedido_id'] : false;
            $id_transaccion = isset($_GET["id_transaccion"]) ? $_GET["id_transaccion"] : false;
            $fecha = isset($_GET["fecha"]) ? date("Y-m-d H:i:s", strtotime($_GET["fecha"])) : false;
            $status = isset($_GET["status"]) ? $_GET["status"] : false;
            $email = isset($_GET["email"]) ? $_GET["email"] : false;
            $id_cliente = isset($_GET["id_cliente"]) ? $_GET["id_cliente"] : false;
            $deposito = isset($_GET["deposito"]) ? $_GET["deposito"] : false;
            $pedido_coste = isset($_GET["pedido_coste"]) ? $_GET["pedido_coste"] : false;
            if($pedido_id && $id_transaccion && $fecha && 
            $status && $email && $id_cliente && $deposito && ($deposito >= $pedido_coste)){
                $pago = new Pago();
                $pago->setId_transaccion($id_transaccion);
                $pago->setFecha($fecha);
                $pago->setStatus($status);
                $pago->setEmail($email);
                $pago->setId_cliente($id_cliente);
                $pago->setTotal($deposito);  
                $pago_id = $pago->guardar();
                if($pago_id != false){
                    $pedido = new Pedido();
                    $pedido->setId($pedido_id);
                    $pedido->setPago_id($pago_id);
                    $pedido->setEstado('PAGADO');
                    $update = $pedido->updatePago();
                    if($update){
                        header('Location:' . base_url . 'Pedido/mis_pedidos');
                    }
                }
            }
            
        }
    }
}
?>