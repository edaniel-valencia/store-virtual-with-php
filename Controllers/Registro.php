<?php
class Registro extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function save()
    {
        if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['clave'])) {
            if (empty($_POST['email']) || empty($_POST['email']) || empty($_POST['clave'])) {
                $respuesta = array('msg' => 'todo los campos son requeridos', 'icono' => 'warning');
            } else {
                $email = strClean($_POST['email']);
                $nombre = strClean($_POST['nombre']);
                $tipo = 2;
                $clave = password_hash(strClean($_POST['clave']), PASSWORD_DEFAULT);
                $consulta = $this->model->getUsuario($email);
                if (empty($consulta)) {
                    $data = $this->model->registrar($email, $nombre, $clave, $tipo);
                    if ($data > 0) {
                        $_SESSION['id_usuario'] = $data;
                        $_SESSION['email'] = $email;
                        $_SESSION['nombre_usuario'] = $nombre;
                        $respuesta = array('msg' => 'Usuario registrado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al registrarse', 'icono' => 'error');
                    }
                } else {
                    $respuesta = array('msg' => 'El correo ya existe', 'icono' => 'warning');
                }
            }
        } else {
            $respuesta = array('msg' => 'error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        die();
    }
    //registrar pedidos
    public function registrarPedido()
    {
        if (!empty($_SESSION['address'])) {
            $datos = file_get_contents('php://input');
            $json = json_decode($datos, true);
            $productos = $json['productos'];
            $pedidos = $json['pedidos'];
            if (is_array($productos)) {
                $transaccion = $pedidos['id'];
                $monto = $pedidos['purchase_units'][0]['amount']['value'];
                $cliente = $_SESSION['address'];
                $envio = 0;
                $data = $this->model->registrarPedido(
                    $transaccion,
                    $monto,
                    $cliente['nombre'],
                    $cliente['apellido'],
                    $cliente['direccion'],
                    $cliente['ciudad'],
                    $cliente['cod'],
                    $cliente['pais'],
                    $cliente['telefono'],
                    $envio,
                    $_SESSION['id_usuario'],
                );
                if ($data > 0) {
                    foreach ($productos as $producto) {
                        $temp = $this->model->getProducto($producto['id']);
                        $this->model->registrarDetalle($temp['nombre'], $temp['precio'], $producto['cantidad'], $producto['id'], $data);
                        //actualizar stock
                        $nuevaCantidad = $temp['cantidad'] - $producto['cantidad'];
                        $nuevaVenta = $temp['ventas'] + $producto['cantidad'];
                        $this->model->actualizarStock($nuevaCantidad, $nuevaVenta, $temp['id']);
                    }
                    $mensaje = array('msg' => 'Pedido registrado', 'icono' => 'success');
                    unset($_SESSION['address']);
                } else {
                    $mensaje = array('msg' => 'Error al registrar el pedido', 'icono' => 'error');
                }
            } else {
                $mensaje = array('msg' => 'Error fatal con los datos', 'icono' => 'error');
            }
        } else {
            $mensaje = array('msg' => 'Datos de envio no encontrado', 'icono' => 'error');
        }
        echo json_encode($mensaje);
        die();
    }

    //registrar pedido con comprobante de pago (transferencia/deposito)
    public function registrarPedidoManual()
    {
        if (empty($_SESSION['address'])) {
            echo json_encode(array('msg' => 'Datos de envio no encontrado', 'icono' => 'error'));
            die();
        }
        if (empty($_FILES['comprobante']['name'])) {
            echo json_encode(array('msg' => 'Debe subir el comprobante de pago', 'icono' => 'error'));
            die();
        }
        $productos = json_decode($_POST['productos'] ?? '', true);
        if (!is_array($productos) || empty($productos)) {
            echo json_encode(array('msg' => 'Error fatal con los datos', 'icono' => 'error'));
            die();
        }

        $imagen = $_FILES['comprobante'];
        $extension = strtolower(pathinfo($imagen['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png'];
        if ($imagen['error'] !== UPLOAD_ERR_OK || !in_array($extension, $permitidas) || getimagesize($imagen['tmp_name']) === false) {
            echo json_encode(array('msg' => 'El comprobante debe ser una imagen valida (jpg, jpeg o png)', 'icono' => 'error'));
            die();
        }

        $detalle = array();
        $total = 0;
        foreach ($productos as $producto) {
            $temp = $this->model->getProducto($producto['id']);
            if (!empty($temp)) {
                $total += $temp['precio'] * $producto['cantidad'];
                $detalle[] = array('info' => $temp, 'cantidad' => $producto['cantidad']);
            }
        }

        $cliente = $_SESSION['address'];
        $nombreComprobante = date('YmdHis') . '_' . uniqid() . '.' . $extension;
        $venta = $this->model->registrarPedido(
            'COMPROBANTE',
            $total,
            $cliente['nombre'],
            $cliente['apellido'],
            $cliente['direccion'],
            $cliente['ciudad'],
            $cliente['cod'],
            $cliente['pais'],
            $cliente['telefono'],
            0,
            $_SESSION['id_usuario'],
            $nombreComprobante
        );

        if ($venta > 0) {
            move_uploaded_file($imagen['tmp_name'], 'public/img/comprobantes/' . $nombreComprobante);
            foreach ($detalle as $item) {
                $this->model->registrarDetalle($item['info']['nombre'], $item['info']['precio'], $item['cantidad'], $item['info']['id'], $venta);
                //actualizar stock
                $nuevaCantidad = $item['info']['cantidad'] - $item['cantidad'];
                $nuevaVenta = $item['info']['ventas'] + $item['cantidad'];
                $this->model->actualizarStock($nuevaCantidad, $nuevaVenta, $item['info']['id']);
            }
            unset($_SESSION['address']);
            $mensaje = array('msg' => 'Pedido registrado, verificaremos tu comprobante de pago pronto', 'icono' => 'success');
        } else {
            $mensaje = array('msg' => 'Error al registrar el pedido', 'icono' => 'error');
        }
        echo json_encode($mensaje);
        die();
    }
}
