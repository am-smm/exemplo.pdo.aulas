<?php

define("INC", __DIR__ . "/includes/");
define("APP_CLASSES", INC . "classes/");

define("PAGE_HEADER", INC . "main/header.php");
define("PAGE_FOOTER", INC . "main/footer.php");
define("PAGE_NAVBAR", INC . "main/navbar.php");

define("WEBROOT", 'http://exemplo.pdo.loc/');
// define("WEBROOT", 'http://localhost/M17/');

define("PAGES_URL", WEBROOT . "pages/");
define("ASSETS_URL", WEBROOT . 'assets/');
define("CSS_URL", ASSETS_URL . 'css/');
define("IMG_URL", ASSETS_URL . 'imgs/');

//-------------------------------------------------------
// Redefinir as constantes deste bloco!
//-------------------------------------------------------
// constantes para acesso a BD
define('DB_HOST', 'localhost');
define('DB_USER', 'gestpt_user');  // 'root'
define('DB_PASS', 'gestpt_pass');  // ''
define('DB_NAME', 'smm_pdo');

setlocale(LC_ALL, 'pt_PT');
require_once __DIR__ . "/includes/sys/debug.php";
require_once __DIR__ . "/includes/sys/utils.php";
require_once APP_CLASSES . 'BD.php';
