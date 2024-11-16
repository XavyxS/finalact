<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('/home', 'AuthController::index');
$routes->get('/loginForm', 'AuthController::loginForm');
$routes->post('/auth', 'AuthController::login');
$routes->get('/dashboard', 'UserController::dashboard');
$routes->get('/registroForm', 'AuthController::registroForm');
$routes->post('/registro', 'AuthController::registro');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/delete/(:num)', 'UserController::delete/$1');
$routes->post('/update/(:num)', 'UserController::update/$1');
$routes->get('/edit/(:num)', 'UserController::edit/$1');
$routes->get('/users_list', 'UserController::users_list');
$routes->get('/images_list', 'ImagesController::images_list');
$routes->post('/upload_img', 'ImagesController::upload_img');
$routes->get('/delete_img/(:num)', 'ImagesController::delete_img/$1');