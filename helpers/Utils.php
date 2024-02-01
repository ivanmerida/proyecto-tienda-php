<?php
    class Utils{
        public static function deleteSession($name){
            if(isset($_SESSION[$name])){
                $_SESSION[$name] = null;
                unset($_SESSION[$name]);
            }
        }
        public static function isAdmin(){
            if(isset($_SESSION['administrador'])){ 
                return true;
            }else{
                header('Location:' . base_url);
                return false;
            }
        }
        public static function isIdentity(){
            if(!isset($_SESSION['identity'])){
                header('Location:'.base_url);
            }else{
                return true;
            }
        }
        public static function showCategorias(){
            require_once 'models/Categoria.php';
            $categoria = new Categoria();
            $categorias = $categoria->getCategorias();
            return $categorias;
        }
        public static function showFechas(){
            require_once 'models/Pedido.php';
            $pedido = new Pedido();
            $fechas = $pedido->getFechas();
            return $fechas;
        }
        public static function statsCarrito(){
            $stats = array(
                'count' => 0, 
                'total' => 0
            );
            if(isset($_SESSION['carrito'])){
                $stats['count'] = count($_SESSION['carrito']);
                foreach($_SESSION['carrito'] as $indice => $producto){
                    $stats['total'] += $producto['precio'] * $producto['unidades'];
                }
            }
            return $stats;
        }
        public static function showStatus($status){
            $value = 'Pendiente';
            if($status == 'SIN PAGAR'){
                $value = 'SIN PAGAR';
            }elseif($status == 'PAGADO'){
                $value = 'PAGADO';
            }elseif($status == 'preparation'){
                $value = 'En preparacion';
            }elseif($status == 'ready'){
                $value = 'Preparado';
            }elseif($status == 'sended'){
                $value = 'Enviado';
            }
            return $value;
        }
    }
?>