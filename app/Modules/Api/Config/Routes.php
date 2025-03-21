<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('api', ['namespace' => 'App\Modules\Api\Controllers'], function ($subroutes) {
    $subroutes->add('action/(:any)', 'ApiAction::$1');
    $subroutes->add('ajax/(:any)', 'ApiAjax::$1');
    $subroutes->add('', 'Api::index');
    $subroutes->add('(:any)', 'Api::$1');

    $subroutes->get('data_eksekutif', 'Api::data_eksekutif', ['filter' => 'generate_token']);
    $subroutes->get('data_aduan', 'Api::data_aduan', ['filter' => 'generate_token']);
    $subroutes->get('data_aduan_detail', 'Api::data_aduan_detail', ['filter' => 'generate_token']);
    $subroutes->post('balas_aduan', 'Api::balas_aduan', ['filter' => 'generate_token']);
    $subroutes->get('data-terminal', 'Api::data_terminal', ['filter' => 'generate_token']);
    $subroutes->get('data_perlintasan_kai', 'Api::data_perlintasan_kai', ['filter' => 'generate_token']);
    $subroutes->post('data_traffic_google', 'Api::data_traffic_google', ['filter' => 'generate_token']);
    $subroutes->group('gps', static function ($subroutes) {
        $subroutes->post('all-bus', 'Api::data_all_bus', ['filter' => 'generate_token']);
        $subroutes->get('list-routes', 'Api::dataRoutes', ['filter' => 'generate_token']);
    });

    $subroutes->get('find-address', 'Api::data_nominatim_query');
    $subroutes->get('data_json_road_traffic', 'Api::dataJsonRoadTraffic');
    
    $subroutes->post('upload_file_minio', 'Api::upload_file_minio');
    $subroutes->post('upload_kml', 'Api::upload_kml');

    $subroutes->group('street', static function ($subroutes) {
        $subroutes->get('list', 'Street::list');
    });

    $subroutes->group('ews', static function ($subroutes) {
        $subroutes->get('geojson', 'Ews::list_geojson');
    });

    $subroutes->group('public-facilities', static function ($subroutes) {
        $subroutes->get('list', 'PublicFacility::list');
    });
    
    $subroutes->group('traffic', static function ($subroutes) {
        $subroutes->get('graph/today', 'Traffic::graph_today');
        $subroutes->post('add', 'Traffic::add');
        $subroutes->get('list/all', 'Traffic::list_all');
        $subroutes->get('current', 'Traffic::current');
    });

    // $subroutes->group('webhook', static function ($subroutes) {
    //     $subroutes->post('data', 'Api::webhook_data');
    //     $subroutes->get('hit', 'Api::hit_webhook');
    // });
    
    $subroutes->group('vehicle', static function ($subroutes) {
        $subroutes->get('', 'Vehicle::index');
        // $subroutes->get('(:any)', 'Vehicle::$1');
        $subroutes->get('bus', 'Vehicle::bus');
        $subroutes->get('log_bus', 'Vehicle::log_bus');
        $subroutes->group('webhook', static function ($subroutes) {
            $subroutes->get('log', 'Vehicle::log_data_hooks');
            $subroutes->get('hit', 'Vehicle::hit_webhook');
            // $subroutes->post('data', 'Vehicle::webhook_data');
            $subroutes->post('data', 'Vehicle::webhook_data');
        });
    });
});