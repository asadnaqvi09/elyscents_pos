<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Karachi');

header('Content-Type: text/html; charset=utf-8');

define('BASE_URL', 'http://localhost/elyscents/');
define('API_URL', BASE_URL . 'backend/api/');