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
$routes->get('/outlet', 'CustomerController::outlet');
$routes->get('/contact', 'CustomerController::contact');
$routes->get('/services', 'CustomerController::services');
$routes->get('/product', 'CustomerController::product');
$routes->get('/point', 'CustomerController::point');
$routes->get('/qr/(:any)', 'CustomerController::claimQR/$1');
$routes->post('/qr/claim', 'CustomerController::claimPoint');

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

$routes->get('admin/order', 'OrderController::index');
$routes->get('admin/order/request_cancel', 'OrderController::request');
$routes->get('admin/order/search', 'OrderController::search');
$routes->get('admin/order/search/customer', 'OrderController::searchCust');
$routes->get('admin/order/search/request', 'OrderController::searchRequest');
$routes->get('admin/order/print/(:num)', 'OrderController::print/$1');
$routes->get('admin/order/search_detail/(:num)', 'OrderController::searchDetail/$1');
$routes->get('admin/add_order', 'OrderController::add');
$routes->post('admin/add_order/member', 'OrderController::addMember');
$routes->get('admin/add_order/member/(:num)', 'OrderController::addMembership/$1');
$routes->post('admin/add_order', 'OrderController::store');
$routes->post('admin/order/request_cancel', 'OrderController::requestCancel');
$routes->get('admin/order/request/accept/(:num)/(:num)', 'OrderController::acceptRequest/$1/$2');
$routes->get('admin/order/request/decline/(:num)/(:num)', 'OrderController::declineRequest/$1/$2');

$routes->get('admin/vendor', 'VendorController::index');
$routes->get('admin/add_vendor', 'VendorController::add');
$routes->post('admin/add_vendor', 'VendorController::store');
$routes->get('admin/vendor/search', 'VendorController::search');
$routes->get('admin/vendor/activate/(:num)', 'VendorController::activate/$1');
$routes->get('admin/vendor/deactivate/(:num)', 'VendorController::deactivate/$1');
$routes->get('admin/vendor/view/(:num)', 'VendorController::view/$1');
$routes->post('admin/edit_vendor/(:num)', 'VendorController::update/$1');
$routes->post('admin/vendor/delete/(:num)', 'VendorController::delete/$1');

$routes->get('admin/point', 'PointController::index');
$routes->get('admin/point/config', 'PointController::config');
$routes->get('admin/point/search', 'PointController::search');
$routes->get('admin/point/config/search', 'PointController::searchConfig');
$routes->get('admin/point/config/view/(:num)', 'PointController::view/$1');
$routes->post('admin/point/edit_config/(:num)', 'PointController::update/$1');

$routes->get('admin/finance/cash', 'FinanceController::cash');
$routes->get('admin/finance/sales', 'FinanceController::sales');
$routes->get('admin/finance/sales/search', 'FinanceController::searchSales');
$routes->get('admin/finance/sales/search/total', 'FinanceController::searchSalesTotal');
$routes->get('admin/finance/cash/search', 'FinanceController::searchCash');
$routes->get('admin/finance/cash/search/first', 'FinanceController::searchFirstBalance');
$routes->get('admin/finance/add_cash/(:any)', 'FinanceController::addCash/$1');
$routes->post('admin/finance/add_cash', 'FinanceController::storeCash');
$routes->get('admin/finance/salary', 'FinanceController::salary');
$routes->get('admin/finance/salary/search', 'FinanceController::searchSalary');
$routes->get('admin/finance/salary/search/total', 'FinanceController::searchSalaryTotal');
$routes->get('admin/finance/electrical', 'FinanceController::electrical');
$routes->get('admin/finance/electrical/search', 'FinanceController::searchElectrical');
$routes->get('admin/finance/electrical/search/total', 'FinanceController::searchElectricalTotal');
$routes->get('admin/finance/rent', 'FinanceController::rent');
$routes->get('admin/finance/rent/search', 'FinanceController::searchRent');
$routes->get('admin/finance/rent/search/total', 'FinanceController::searchRentTotal');
$routes->get('admin/finance/maintenance', 'FinanceController::maintenance');
$routes->get('admin/finance/maintenance/search', 'FinanceController::searchMaintenance');
$routes->get('admin/finance/maintenance/search/total', 'FinanceController::searchMaintenanceTotal');
$routes->get('admin/finance/other', 'FinanceController::other');
$routes->get('admin/finance/other/search', 'FinanceController::searchOther');
$routes->get('admin/finance/other/search/total', 'FinanceController::searchOtherTotal');
$routes->get('admin/finance/profit_loss', 'FinanceController::profitLoss');
$routes->get('admin/finance/profit_loss/search', 'FinanceController::searchProfitLoss');
$routes->get('admin/finance/profit_loss/search/total/expenses', 'FinanceController::searchProfitLossTotalExpenses');
$routes->get('admin/finance/profit_loss/search/total/profit', 'FinanceController::searchProfitLossTotalProfit');



$routes->get('admin/customer_pages/contact_us', 'CustomerPagesController::contactUs');
$routes->get('admin/customer_pages/contact_us/search', 'CustomerPagesController::contactUsSearch');
$routes->get('admin/customer_pages/contact_us/view/(:num)', 'CustomerPagesController::contactUsView/$1');
$routes->post('admin/customer_pages/edit_contact_us/(:num)', 'CustomerPagesController::contactUsUpdate/$1');

$routes->get('admin/customer_pages/faq', 'CustomerPagesController::faq');
$routes->get('admin/customer_pages/faq/search', 'CustomerPagesController::faqSearch');
$routes->get('admin/customer_pages/faq/view/(:num)', 'CustomerPagesController::faqView/$1');
$routes->post('admin/customer_pages/faq/delete/(:num)', 'CustomerPagesController::faqDelete/$1');
$routes->post('admin/customer_pages/edit_faq/(:num)', 'CustomerPagesController::faqUpdate/$1');
$routes->get('admin/customer_pages/add_faq', 'CustomerPagesController::faqAdd');
$routes->post('admin/customer_pages/add_faq', 'CustomerPagesController::faqStore');

$routes->get('admin/user', 'UserController::index');
$routes->get('admin/user/search', 'UserController::search');
$routes->get('admin/user/view/(:num)', 'UserController::view/$1');
$routes->post('admin/edit_user/(:num)', 'UserController::update/$1');
$routes->get('admin/add_user', 'UserController::add');
$routes->post('admin/add_user', 'UserController::store');
$routes->get('admin/user/deactivate/(:num)', 'UserController::deactivate/$1');
$routes->get('admin/user/activate/(:num)', 'UserController::activate/$1');
$routes->post('admin/user/delete/(:num)', 'UserController::delete/$1');

//Login and Registration
$routes->get('login/admin', 'AuthController::admin');
$routes->post('login/admin/auth', 'AuthController::loginAdmin');

$routes->get('access/forbidden', 'AuthController::forbidden');

$routes->get('login/customer', 'AuthController::customer');
$routes->post('login/auth', 'AuthController::loginCustomer');
$routes->get('register/customer', 'AuthController::registerCustomer');
$routes->post('register/customer/email', 'AuthController::registerCustomerAuthEmail');
$routes->get('register/customer/auth/(:any)', 'AuthController::registerCustomerAuth/$1');

$routes->get('forgot_password/customer/index', 'AuthController::customerForgotPassword');
$routes->post('forgot_password/customer/auth', 'AuthController::customerForgotAuth');
$routes->get('forgot_password/customer/change_pass/(:any)', 'AuthController::customerForgotChange/$1');
$routes->post('forgot_password/customer/new_pass/(:any)', 'AuthController::customerForgotNew/$1');

$routes->get('forgot_password/admin/index', 'AuthController::adminForgotPassword');
$routes->post('forgot_password/admin/auth', 'AuthController::adminForgotAuth');
$routes->get('forgot_password/admin/change_pass/(:any)', 'AuthController::adminForgotChange/$1');
$routes->post('forgot_password/admin/new_pass/(:any)', 'AuthController::adminForgotNew/$1');


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
