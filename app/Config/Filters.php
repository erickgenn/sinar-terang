<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        // 'secureheaders' => SecureHeaders::class,
        'authManager' => \App\Filters\ManagerGuard::class,
        'authGuard'     => \App\Filters\AuthGuard::class,

    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'authGuard' => [
                'except' =>
                [
                    '/',
                    '/home',
                    '/contact',
                    '/services',
                    '/outlet',
                    '/product',
                    '/about',
                    'login/admin',
                    'login/admin/auth',
                    'register/admin',
                    'login/customer',
                    'register/customer',
                    'login/auth',
                    'register/customer/auth',
                    'access/forbidden',
                ],
            ],
            'authManager' => [
                'except' =>
                [
                    '/',
                    '/home',
                    '/contact',
                    '/services',
                    '/outlet',
                    '/product',
                    '/about',
                    'login/admin',
                    'login/admin/auth',
                    'register/admin',
                    'login/customer',
                    'register/customer',
                    'login/auth',
                    'logout',
                    'register/customer/auth',
                    'admin/product',
                    'admin/product/search',
                    'admin/add_product',
                    'admin/product/deactivate/*',
                    'admin/product/activate/*',
                    'admin/product/view/*',
                    'admin/product/delete/*',
                    'admin/edit_product/*',
                    'admin/order',
                    'admin/order/request_cancel',
                    'admin/order/search',
                    'admin/order/search/customer',
                    'admin/order/search/request',
                    'admin/order/print/*',
                    'admin/order/search_detail/*',
                    'admin/add_order',
                    'admin/add_order/member',
                    'admin/add_order/member/*',
                    'admin/customer_pages/contact_us',
                    'admin/customer_pages/contact_us/search',
                    'admin/customer_pages/contact_us/view/*',
                    'admin/customer_pages/edit_contact_us/*',
                    'admin/customer_pages/faq',
                    'admin/customer_pages/faq/search',
                    'admin/customer_pages/faq/view/*',
                    'admin/customer_pages/faq/delete/*',
                    'admin/customer_pages/edit_faq/*',
                    'admin/customer_pages/add_faq',
                    'access/forbidden',
                ],
            ],
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
