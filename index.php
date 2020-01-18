<?php

// lien vers le fichier index.php (page d'accueil)
$index_url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];

// suppression de index.php pour avoir l'url racine (parce qu'on utilise un .htaccess qui peut s'en passer)
define('HOME', str_replace('index.php', '', $index_url));

// Save the project root directory as a global constant.
define('ROOT_PATH', __DIR__);

/*
 * Create a global constant used to get the filesystem path to the
 * application configuration directory.
 */
define('CFG_PATH', realpath(ROOT_PATH.'/application/config'));

/*
 * Create a global constant used to get the filesystem path to the
 * application public web root directory.
 *
 * Can be used to handle file uploads for example.
 */
define('WWW_PATH', realpath(ROOT_PATH.'/application/www'));

require_once "vendor/autoload.php";
require_once 'library/Configuration.class.php';
require_once 'library/Database.class.php';
require_once 'library/FlashBag.class.php';
require_once 'library/Form.class.php';
require_once 'library/FrontController.class.php';
require_once 'library/MicroKernel.class.php';
require_once 'library/Http.class.php';
require_once 'library/InterceptingFilter.interface.php';


$microKernel = new MicroKernel();
$microKernel->bootstrap()->run(new FrontController());