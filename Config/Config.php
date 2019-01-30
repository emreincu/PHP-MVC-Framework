<?php

/* Debug configuration */
define('DEBUG', true);
define('DEBUG_DATABASE', false);
define('DEBUG_CLASSES', false);

/* Database configuration */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "e");
define("DB_NAME", "mvc");

/* Mailer configuration */

define("SMTP_SERVER", "localhost");
define("SMTP_USER", "root");
define("SMTP_PASSWORD", "e");
define("SMTP_PORT", "");
define("SMTP_CHARSET", "UTF-8");

/* Default configuration */
define('DEFAULT_CONTROLLER', "Home");
define('DEFAULT_ACTION', "index");
define('DEFAULT_TEMPLATE', "default");
define('DEFAULT_LAYOUT', 'default');
define('SITE_TITLE', "MVC Framework Title");

/* DIR configuration */
define("DIR_CONTROLLERS", DIR_ROOT . DS . "App" . DS . "Controllers");

/* URL configuration */
define("URL_ASSETS", URL_ROOT . DS . "Assets");
define("URL_CSS", URL_ASSETS . DS . "css");
define("URL_JS", URL_ASSETS . DS . "js");
define("URL_IMG", URL_ASSETS . DS . "images");

define("URL_UPLOADS", URL_ROOT . DS . "uploads");
define("DIR_UPLOADS", DIR_ROOT . DS . "uploads");
define("URL_CSS_BOOTSTRAP", URL_ASSETS . DS . "vendor" . DS . "bootstrap" . DS . "css" . DS . "bootstrap.min.css");

/* LOCAL configuration */
define("DEFAULT_LANGUAGE", "tr");
