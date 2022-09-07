<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('CustomerController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'CustomerController::index');

$routes->get('/home', 'CustomerController::index');

// Customer Pages
$routes->get('/about', 'CustomerController::about');
$routes->get('/blog', 'CustomerController::blog');
$routes->get('/contact', 'CustomerController::contact');
$routes->get('/services', 'CustomerController::services');
$routes->get('/product', 'CustomerController::product');


//Admin Pages
$routes->get('admin/dashboard', 'AdminController::index');

$routes->get('admin/customer', 'AdminController::customer');
$routes->get('admin/customer/search', 'CustomerController::search');
$routes->get('admin/customer/activate/(:num)', 'CustomerController::activate/$1');
$routes->get('admin/customer/deactivate/(:num)', 'CustomerController::deactivate/$1');


$routes->get('admin/product', 'ProductController::index');
$routes->get('admin/product/search', 'ProductController::search');
$routes->get('admin/add_product', 'ProductController::add');
$routes->post('admin/add_product', 'ProductController::store');
$routes->get('admin/product/deactivate/(:num)', 'ProductController::deactivate/$1');
$routes->get('admin/product/activate/(:num)', 'ProductController::activate/$1');
$routes->get('admin/product/view/(:num)', 'ProductController::view/$1');
$routes->post('admin/product/delete/(:num)', 'ProductController::delete/$1');
$routes->post('admin/edit_product/(:num)', 'ProductController::update/$1');

$routes->get('admin/outlet', 'OutletController::index');
$routes->get('admin/outlet/search', 'OutletController::search');
$routes->get('admin/add_outlet', 'OutletController::add');
$routes->post('admin/add_outlet', 'OutletController::store');
$routes->get('admin/outlet/view/(:num)', 'OutletController::view/$1');
$routes->post('admin/edit_outlet/(:num)', 'OutletController::update/$1');
$routes->get('admin/outlet/deactivate/(:num)', 'OutletController::deactivate/$1');
$routes->get('admin/outlet/activate/(:num)', 'OutletController::activate/$1');
$routes->post('admin/outlet/delete/(:num)', 'OutletController::delete/$1');





//Login and Registration
$routes->get('login/admin', 'AuthController::admin');
$routes->post('login/admin/auth', 'AuthController::loginAdmin');

$routes->get('login/customer', 'AuthController::customer');
$routes->post('login/auth', 'AuthController::loginCustomer');
$routes->get('register/customer', 'AuthController::registerCustomer');
$routes->post('register/customer/auth', 'AuthController::registerCustomerAuth');

$routes->get('logout', 'AuthController::logout');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
