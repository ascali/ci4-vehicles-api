<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('api', ['namespace' => 'App\Modules\Main\Controllers'], function ($subroutes) {
    // $subroutes->add('action/(:any)', 'MainAction::$1');
    // $subroutes->add('ajax/(:any)', 'MainAjax::$1');
    $subroutes->add('', 'Main::index');
    $subroutes->add('(:any)', 'Main::$1');

    $subroutes->group('vehicle', static function ($subroutes) {
        $subroutes->get('', 'Vehicle::index');
        // $subroutes->get('(:any)', 'Vehicle::$1');
        $subroutes->get('bus', 'Vehicle::bus');
        $subroutes->get('log_bus', 'Vehicle::log_bus');
        $subroutes->group('webhook', static function ($subroutes) {
            $subroutes->post('log', 'Vehicle::log_data_hooks');
            $subroutes->post('data', 'Vehicle::webhook_data');
            $subroutes->get('hit', 'Vehicle::hit_webhook');
        });
    });

});