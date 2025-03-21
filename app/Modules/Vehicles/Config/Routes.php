<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('vehicles', ['namespace' => 'App\Modules\Vehicles\Controllers'], function($subroutes){
    $subroutes->add('action/(:any)','VehiclesAction::$1');
    $subroutes->add('ajax/(:any)','VehiclesAjax::$1');
    $subroutes->add('', 'Vehicles::index');
	$subroutes->add('(:any)', 'Vehicles::$1');
    
    // $subroutes->get('/polyline', 'Vehicles::getPolyline');
});
