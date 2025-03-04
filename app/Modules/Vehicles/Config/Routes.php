<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('vehicles', ['namespace' => 'App\Modules\Vehicles\Controllers'], function($subroutes){
    $subroutes->add('', 'Main::index');
    $subroutes->add('(:any)', 'Main::$1');
});
