<?php
require 'vendor/autoload.php';
require_once 'Config/Config.php';
require_once 'Config/Helpers.php';
require_once 'Config/App/Conexion.php';
require_once 'Config/App/Query.php';
require_once 'Models/VentasModel.php';

$model = new VentasModel();
try {
    $fecha = date('Y-m-d H:i:s');
    $venta = $model->registrarVenta(15.00, $fecha, null, 15.00, 1);
    echo "Venta ID: $venta\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
