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
$router->map('GET|POST', '/parameters/guests', 'adminGuests', 'adminGuests');



/**
 * API's
 */
$router->map('GET', '/availability/[*:q]', function ($q) {
    include "./conf/api/getAvailability.php";
});

$router->map('GET', '/reservations/[*:q]', function ($q) {
    include "./conf/api/getReservations.php";
});

$router->map('GET', '/guests/[*:q]', function ($q) {
    include "./conf/api/getGuests.php";
});

$router->map('GET|POST', '/guest/[*:id]', function ($id) {
    include "./conf/api/getGuestCard.php";
});

$router->map('GET|POST', '/reservation/update/[*:id]', function ($id) {
    include "./conf/api/updateReservation.php";
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
