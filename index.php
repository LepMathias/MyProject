<?php
require 'vendor/autoload.php';
require 'vendor/altorouter/altorouter/AltoRouter.php';

require './conf/db/confDB.php';

$router = new AltoRouter();

/**
 * Guests routes
 */
$router->map('GET|POST', '/', 'index', 'home');
$router->map('GET|POST', '/menus', 'menus', 'menus');
$router->map('GET', '/logout', 'logout', 'logout');

/**
 * Admin routes
 */
$router->map('GET|POST', '/parameters/reservations', 'adminReservations', 'adminReservations');
$router->map('GET|POST', '/parameters/gallery', 'adminGallery', 'adminGallery');
$router->map('GET|POST', '/parameters/carte', 'adminCarte', 'adminCarte');
$router->map('GET|POST', '/parameters/menus', 'adminMenus', 'adminMenus');
$router->map('GET|POST', '/parameters/schedules', 'adminSchedules', 'adminSchedules');


/**
 * API's
 */
$router->map('GET|POST', '/availability/[*:q]', function ($q) {
    include "./conf/api/getAvailability.php";
});

$router->map('GET|POST', '/parameters/reservations/[*:q]', function ($q) {
    include "./conf/api/getReservations.php";
});



$match = $router->match();

if ($match !== null) {
    if (is_callable($match['target'])) {
        call_user_func_array( $match['target'], $match['params'] );
    } else {
        require './src/controller/indexController.php';
        require "./public/pages/{$match['target']}.php";
    }
}
