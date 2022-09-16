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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/wisata', 'Home::wisata');
$routes->get('/lahan', 'Home::lahan');
$routes->get('/desa', 'Home::desa');
$routes->get('/detail/(:any)/(:any)', 'Home::detail/$1/$2');
$routes->post('/tambah-komentar', 'Home::addKomentar');

$routes->match(['get', 'post'] ,'/admin/login', 'Admin\Auth::login');
$routes->get('/admin/logout', 'Admin\Auth::logout');
$routes->get('/tes', 'Admin\InfoDesa::tes');

$routes->group('admin', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('/', 'Admin\Home::index');
    $routes->get('tentang', 'Admin\Home::tentang');
    $routes->post('tentang/ubah', 'Admin\Home::ubah');

    $routes->group('pengguna', function ($routes) {
        $routes->get('/', 'Admin\Pengguna::index');
        $routes->get('ambil/(:any)', 'Admin\Pengguna::ambil/$1');
        $routes->post('tambah', 'Admin\Pengguna::tambah');
        $routes->post('ubah', 'Admin\Pengguna::ubah');
        $routes->get('hapus/(:any)', 'Admin\Pengguna::hapus/$1');
    });

    $routes->group('infodesa', function ($routes) {
        $routes->get('/', 'Admin\InfoDesa::index');
        $routes->get('ambil/(:any)', 'Admin\InfoDesa::ambil/$1');
        $routes->post('tambah', 'Admin\InfoDesa::tambah');
        $routes->post('ubah', 'Admin\InfoDesa::ubah');
        $routes->get('hapus/(:any)', 'Admin\InfoDesa::hapus/$1');
    });

    $routes->group('wisata', function ($routes) {
        $routes->get('/', 'Admin\Wisata::index');
        $routes->get('ambil/(:any)', 'Admin\Wisata::ambil/$1');
        $routes->post('tambah', 'Admin\Wisata::tambah');
        $routes->post('ubah', 'Admin\Wisata::ubah');
        $routes->get('hapus/(:any)', 'Admin\Wisata::hapus/$1');
    });

    $routes->group('lahan', function ($routes) {
        $routes->get('/', 'Admin\Lahan::index');
        $routes->get('ambil/(:any)', 'Admin\Lahan::ambil/$1');
        $routes->post('tambah', 'Admin\Lahan::tambah');
        $routes->post('ubah', 'Admin\Lahan::ubah');
        $routes->get('hapus/(:any)', 'Admin\Lahan::hapus/$1');
    });

    $routes->group('petani', function ($routes) {
        $routes->get('/', 'Admin\Petani::index');
        $routes->get('ambil/(:any)', 'Admin\Petani::ambil/$1');
        $routes->post('tambah', 'Admin\Petani::tambah');
        $routes->post('ubah', 'Admin\Petani::ubah');
        $routes->get('hapus/(:any)', 'Admin\Petani::hapus/$1');
    });

    $routes->group('komentar', function ($routes) {
        $routes->get('/', 'Admin\Komentar::index');
        $routes->get('hapus/(:any)', 'Admin\Komentar::hapus/$1');
    });

});

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
