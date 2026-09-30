<?php
// ---------- Configuración ----------
require __DIR__ . '/env.php';

// URL base (funciona en la raíz o en una subcarpeta, ej: localhost/app-estacion)
define('BASE_URL', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'));

// ---------- Autocarga de clases ----------
spl_autoload_register(function (string $clase): void {
    foreach (['core', 'controllers', 'models'] as $carpeta) {
        $archivo = __DIR__ . "/$carpeta/$clase.php";
        if (is_file($archivo)) {
            require $archivo;
            return;
        }
    }
});

// ---------- Tabla de rutas: ruta => [Controlador, método] ----------
$rutas = [
    'landing' => [LandingController::class, 'index'],
    'panel'   => [PanelController::class,   'index'],
    'detalle' => [DetalleController::class, 'index'],   // detalle/{chipid}
];

// ---------- Router ----------
$partes    = array_values(array_filter(explode('/', trim($_GET['url'] ?? '', '/')), 'strlen'));
$ruta      = $partes[0] ?? 'landing';
$parametro = $partes[1] ?? null;

if (!isset($rutas[$ruta]) || count($partes) > 2) {
    (new Controller())->noEncontrado();
    exit;
}

[$clase, $metodo] = $rutas[$ruta];
(new $clase())->$metodo($parametro);
