<?php
session_start();
$SESSION = array();
setcookie('userId', '');
session_destroy();
header('location: /');

