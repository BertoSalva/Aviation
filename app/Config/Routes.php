<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// welcome route
$routes->get('/', 'Auth::login');
// Authentication route
$routes->get('login', 'Auth::login');
$routes->post('authenticate', 'Auth::authenticate');
$routes->post('logout', 'Auth::logout');
// Customers CRUD
$routes->get('customers', 'Customer::index');
$routes->get('customers/create', 'Customer::create');
$routes->post('customers/store', 'Customer::store');
$routes->get('customers/edit/(:num)', 'Customer::edit/$1');
$routes->post('customers/update/(:num)', 'Customer::update/$1');
$routes->get('customers/delete/(:num)', 'Customer::delete/$1');