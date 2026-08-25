<?php
require 'vendor/autoload.php';
require_once 'Config/Config.php';
require_once 'Config/Helpers.php';
require_once 'Config/App/Conexion.php';
require_once 'Config/App/Query.php';
require_once 'Models/VentasModel.php';

$model = new VentasModel();
try {
    $model->registraDetalle(1, 15.00, 'ACEITE OLIVA', 1, 5);
    $result = $model->getProducto(1);
    var_dump($result);
    $nuevaCantidad = $result['cantidad'] - 1;
    $nuevaVenta = $result['ventas'] + 1;
    $model->actualizarStock($nuevaCantidad, $nuevaVenta, 1);
    echo "Done.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
