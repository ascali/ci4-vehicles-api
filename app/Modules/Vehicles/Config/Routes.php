<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('vehicles', ['namespace' => 'App\Modules\Vehicles\Controllers'], function($subroutes){
    $subroutes->add('', 'Main::index');
    $subroutes->add('(:any)', 'Main::$1');

    $subroutes->group('webhook', static function ($subroutes) {
        $subroutes->post('data', 'Main::webhook_data');
        $subroutes->get('hit', 'Main::hit_webhook');
    });
});
