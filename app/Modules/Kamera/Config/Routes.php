<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('kamera', ['namespace' => 'App\Modules\Kamera\Controllers'], function($subroutes){
    $subroutes->add('action/(:any)','KameraAction::$1');
    $subroutes->add('ajax/(:any)','KameraAjax::$1');
	$subroutes->add('(:any)', 'Kamera::$1');
    $subroutes->add('', 'Kamera::index');
});
