<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::home');
$routes->get('/home', 'Home::index');
$routes->get('/bus', 'Home::bus');
$routes->get('/log_bus', 'Home::log_bus');
