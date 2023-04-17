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
$router->map('GET', '/profile', 'profile', 'profile');
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
$router->map('GET|POST', '/admin/users', 'adminUsers', 'adminUsers');



/**
 * API's
 */
$router->map('GET', '/availability/[*:q]', function ($q) {
    include "./conf/api/Reservations/getAvailability.php";
});

$router->map('GET', '/reservations/[*:date]/[*:service]', function ($date, $service) {
    include "./conf/api/Reservations/getReservations.php";
});

$router->map('GET', '/allGuests/[i:p]', function ($p) {
    include "./conf/api/Users/getAllGuests.php";
});

$router->map('GET', '/guests/[*:q]/[i:p]', function ($q, $p) {
    include "./conf/api/Users/getGuests.php";
});

$router->map('GET|POST', '/guest/[*:id]', function ($id) {
    include "./conf/api/Users/getGuestCard.php";
});

$router->map('GET|POST', '/reservation/delete/[*:id]', function ($id) {
    include "./conf/api/Reservations/deleteReservation.php";
});

$router->map('GET|POST', '/admins', function () {
    include "./conf/api/Users/getAdmins.php";
});

$router->map('GET|POST', '/user/delete/[*:id]', function ($id) {
    include "./conf/api/Users/deleteAdmin.php";
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
