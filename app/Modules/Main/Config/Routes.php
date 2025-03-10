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
});