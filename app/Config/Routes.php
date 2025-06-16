<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home redirects to product catalog
$routes->get('/', 'ProdukController::index');
// Product routes
$routes->get('products', 'ProdukController::index');
$routes->get('products/(:num)', 'ProdukController::view/$1');
// Cart routes
$routes->get('cart', 'KeranjangController::index');
$routes->post('cart/add/(:num)', 'KeranjangController::add/$1');
$routes->post('cart/update', 'KeranjangController::update');

