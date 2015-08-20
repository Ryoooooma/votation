<?php

define('DSN', 'mysql:host=localhost;dbname=votation_dotinstall');
define('DB_USER', 'dbuser');
define('DB_PASSWORD', 'rwrwrwrw0521');

define('SITE_URL', 'http://192.168.33.10/php/votation/');

error_reporting(E_ALL & ~E_NOTICE);

session_set_cookie_params(0, '/votation/');