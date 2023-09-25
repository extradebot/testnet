<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));


//check or installation
// if (!file_exists(__DIR__ . '/core/app/installed.txt')) {

//     $domain =  $_SERVER['HTTP_HOST'];
    
//     if (empty($_SERVER['HTTPS'])) {
//         $pre = 'http://';
//     } else {
//         $pre = 'https://';
//     }

//     $allowed_url = [

//         '/testnet/install',
//         '/testnet/install/server',
//         '/testnet/install/permissions',
//         '/testnet/install/database',
//         '/testnet/install/database-validate',
//         '/testnet/install/database-import',
//         '/testnet/install/setting',
//         '/testnet/install/setting-validate',
//         '/testnet/install/complete',
//         '/testnet/install/complete-validate'

//     ];

//     $current_path =  $_SERVER['REQUEST_URI'];
   

//     if (!in_array($current_path, $allowed_url)) {
//         $url = $pre . $domain . '/install';
//         // var_dump($url);
//         // exit;
//         header('Location: ' . $url);
//         exit;
//     }
// }

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__ . '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
