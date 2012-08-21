<?php

/**
 * Debug mode and displaying errors
 * Set true for dev mode, false for prod mode
 */
ini_set('display_errors', true);
error_reporting(E_ALL);

/**
 * Set default charset and timezone
 */
ini_set('default_charset', 'utf-8');
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, '');
date_default_timezone_set('Europe/Prague');

/**
 * Initialize database connection
 */
require 'lib/dibi/dibi.php';
dibi::connect(array(
 'driver'   => 'MySQL',
 'host'     => 'localhost',
 'username' => 'root',
 'password' => '',
 'database' => 'brejk',
 'resultDetectTypes' => true
));

include 'helper/SmartDOMDocument.php';
include 'helper/lastConversion.php';
include 'helper/cURL.php';

?>