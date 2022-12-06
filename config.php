<?php

define("DEBUG_MODE", '1');

//-------------------------------------------------------
// Redefinir as constantes deste bloco!
//-------------------------------------------------------

define("WEBROOT", 'http://exemplo.pdo.loc/');

// constantes para acesso a BD
define('DB_HOST', 'localhost');
define('DB_USER', 'gestpt_user');  // 'root'
define('DB_PASS', 'gestpt_pass');  // ''
define('DB_NAME', 'smm_tarefas');

// constantes para a inclusão de imagens e outros ficheiros (js, css, ...)
define("PUBLIC_URL", WEBROOT);
define("ASSETS_URL", WEBROOT . 'assets' . DIRECTORY_SEPARATOR);

// constantes para a inclusão de classes e outros ficheiros de código
define('BASE_PATH', realpath(__DIR__) . DIRECTORY_SEPARATOR);
define('APP_INCLUDES', BASE_PATH. 'includes' . DIRECTORY_SEPARATOR);
define('APP_PAGES', BASE_PATH . "pages" . DIRECTORY_SEPARATOR);
define('APP_CLASSES', APP_INCLUDES . "classes" . DIRECTORY_SEPARATOR);
define('APP_SYS', APP_INCLUDES . "sys" . DIRECTORY_SEPARATOR);

setlocale(LC_ALL, 'pt_PT');

require_once APP_SYS.'/debug.php';
require_once APP_SYS.'/utils.php';
require_once APP_SYS.'/PageServer.php';
require_once APP_SYS.'/ErrorBag.php';

//d(WEBROOT, PRJ_TITLE,
//DB_HOST,
//DB_USER,
//DB_PASS,
//DB_NAME,
//PUBLIC_URL,
//ASSETS_URL,
//BASE_PATH,
//APP_INCLUDES,
//APP_CLASSES,
//APP_SYS
//);
//die;
